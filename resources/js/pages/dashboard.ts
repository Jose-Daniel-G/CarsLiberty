// Archivo: resources/js/pages/dashboard.ts
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

export { };

declare const Swal: any;
declare const $: any;

declare global {
    interface Window {
        Laravel: {
            isAdmin: boolean;
            routes: {
                horariosShowReservaProfesores: string;
            };
        };
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const horaFinInput = document.getElementById('tiempo') as HTMLInputElement | null;
    const horaInicioInput = document.getElementById('hora_inicio') as HTMLInputElement | null;
    const profesorSelect = document.getElementById('profesor_id') as HTMLSelectElement | null;
    const fechaReserva = document.getElementById('fecha_reserva') as HTMLInputElement | null;
    const isAdmin = window.Laravel?.isAdmin ?? false;

    const calendarEl = document.getElementById('calendar');
    let disponibilidades: any[] = []; // Variable global para almacenar disponibilidades (eventos de fondo)
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        events: window.Laravel.routes.horariosShowReservaProfesores,
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        locale: esLocale,
        slotMinTime: '06:00:00',
        slotMaxTime: '21:00:00',
        allDaySlot: false,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        // Esto permite que los eventos se vean correctamente
        eventDisplay: 'block',

        displayEventTime: true,          // Muestra la hora (ej: 06:00)
        dayMaxEvents: false,             // No colapsar eventos
        eventTimeFormat: { hour: '2-digit', minute: '2-digit', meridiem: false, hour12: true }, // Formato de hora (ej: 06:00)
        // Forzar que se vean los títulos en eventos de fondo (Disponibilidad)
        eventContent: function (arg) {
            // 1. Lógica para los espacios disponibles (VERDES)
            if (arg.event.display === 'background') {
                let container = document.createElement('div');
                container.innerText = arg.event.title || '';
                return { domNodes: [container] };
            }

            // Creamos un contenedor para el título y la hora
            let mainContainer = document.createElement('div');
            mainContainer.style.padding = '2px';
            mainContainer.style.color = '#fff'; // Texto blanco

            // Div para la hora (ej: 11:00 - 13:00)
            let timeEl = document.createElement('div');
            timeEl.innerText = arg.timeText; // FullCalendar genera esto automáticamente

            // Div para el título (ej: A1)
            let titleEl = document.createElement('div');
            titleEl.style.fontWeight = 'bold';
            titleEl.innerText = arg.event.title;

            mainContainer.appendChild(timeEl);
            mainContainer.appendChild(titleEl);

            return { domNodes: [mainContainer] };
        },

        eventClick: function (info: any) {
            const agenda = info.event;
            const start = agenda.start as Date;
            const end = agenda.end as Date;
            const tipo = agenda.extendedProps?.tipo;
            const now = new Date();

            // ✅ Si la fecha ya pasó, no hacer nada
            if (start < now) {
                return;
            }

            // ✅ Si es un evento de disponibilidad (verde), abrir formulario de nueva reserva
            if (tipo === 'disponibilidad') {
                // Formatear fecha y hora para pre-llenar el formulario
                const fechaStr = `${start.getFullYear()}-${String(start.getMonth() + 1).padStart(2, '0')}-${String(start.getDate()).padStart(2, '0')}`;
                const horaStr = `${String(start.getHours()).padStart(2, '0')}:00`;

                // Pre-llenar los campos del formulario si existen
                const fechaInput = document.getElementById('fecha_reserva') as HTMLInputElement | null;
                const horaInput = document.getElementById('hora_inicio') as HTMLInputElement | null;

                if (fechaInput) fechaInput.value = fechaStr;
                if (horaInput) horaInput.value = horaStr;

                // Aquí abres tu modal de agendamiento, ajusta el ID según tu HTML
                ($("#mdalAgendar") as any).modal("show");
                return;
            }

            // ✅ Si es una reserva confirmada (rojo), mostrar info
            if (tipo === 'reserva') {
                const prof = agenda.extendedProps.profesor || {};
                const cliente = agenda.extendedProps.cliente || {};

                (document.getElementById('nombres_cliente') as HTMLElement).textContent = `${cliente.nombres || 'No disponible'} ${cliente.apellidos || ''}`;
                (document.getElementById('nombres_teacher') as HTMLElement).textContent = `${prof.nombres || 'No disponible'} ${prof.apellidos || ''}`;
                (document.getElementById('fecha_reserva1') as HTMLElement).textContent = start.toISOString().split('T')[0];
                (document.getElementById('hora_inicio1') as HTMLElement).textContent = start.toLocaleTimeString();
                (document.getElementById('hora_fin1') as HTMLElement).textContent = end ? end.toLocaleTimeString() : '';

                ($("#mdalSelected") as any).modal("show");
            }
        },
        eventDidMount: function (info) {
            if (info.event.extendedProps.curso) {
                info.el.title = info.event.extendedProps.curso;
            }
        },

        dateClick: function (info) {
            const now = new Date();
            const hoy = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;
            const fechaSeleccionada = info.dateStr.split('T')[0];

            // ✅ Solo bloquear días anteriores, NO horas pasadas de hoy
            if (fechaSeleccionada < hoy) return;

            const clickedDate = info.date;
            const diaSemana = clickedDate.getDay(); // 0=Dom, 1=Lun...
            const horaClick = clickedDate.getHours();

            // En vista mensual (dayGridMonth) el click no trae hora,
            // solo verificamos el día de la semana
            const esVistaMensual = calendar.view.type === 'dayGridMonth';

            const hayDisponibilidad = disponibilidades.some((d: any) => {
                const diasEvento: number[] = d.daysOfWeek ?? [];
                if (!diasEvento.includes(diaSemana)) return false;

                // En vista semanal/diaria también verificamos la hora
                if (!esVistaMensual) {
                    const [hIni] = (d.startTime as string).split(':').map(Number);
                    const [hFin] = (d.endTime as string).split(':').map(Number);
                    return horaClick >= hIni && horaClick < hFin;
                }

                return true; // En vista mensual, con el día es suficiente
            });

            if (!hayDisponibilidad) return; // ❌ Sin disponibilidad, no abrir modal

            // ✅ Hay disponibilidad, pre-llenar y abrir modal
            if (fechaReserva) fechaReserva.value = fechaSeleccionada;
            if (horaInicioInput && info.dateStr.includes('T')) {
                horaInicioInput.value = info.dateStr.split('T')[1].substring(0, 5);
            }

            ($("#claseModal") as any).modal("show");
        }
    });

    calendar.render();

    if (profesorSelect) {
        $(profesorSelect).on('change', function (e: any) {
            const selectedId = e.target.value;

            // 1. Limpiar fuentes previas
            calendar.removeAllEventSources();

            if (selectedId) {
                // 2. Cargar nuevos datos
                calendar.addEventSource({
                    url: window.Laravel.routes.horariosShowReservaProfesores,
                    method: 'GET',
                    extraParams: {
                        profesor_id: selectedId
                    },
                    success: function (data: any) {
                        disponibilidades = data.filter((e: any) => e.extendedProps?.tipo === 'disponibilidad');
                        console.log('Disponibilidades cargadas:', disponibilidades.length);
                        console.log("Eventos cargados con éxito");
                        return data;
                    },
                    failure: function (error: any) {
                        console.error("Error de carga:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudieron cargar los horarios. Verifica la consola del navegador (F12).'
                        });
                    }
                });
            }
        });
    }
    // VALIDACIONES DE HORA DE RESERVA
    // ---------------------------------------
    // Validación de cantidad de horas
    // --------------------------------------- 
    if (!isAdmin && horaFinInput) {
        horaFinInput.addEventListener('input', function (this: HTMLInputElement) {
            const selected = parseInt(this.value);

            // Comprobar si es un número válido y si está fuera del rango
            if (this.value && (selected < 2 || selected > 4)) {
                // Simplemente muestra el error al usuario
                Swal.fire({
                    text: "Solo puede agendar hasta máximo 4 horas y mínimo 2",
                    icon: "error",
                    toast: true, // Sugerencia: usa toast para ser menos intrusivo
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                this.classList.add('is-invalid');   // Opcional: podrías usar una clase CSS para resaltarlo

            } else if (this.value) {

                this.classList.remove('is-invalid');// Si el valor es válido, quita la marca de error.
            }
        });
    }

    // ---------------------------------------
    // Función auxiliar: fecha local en YYYY-MM-DD
    // ---------------------------------------
    function getLocalDate(): string {
        const today = new Date();
        return `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
    }

    // ---------------------------------------
    // Validar fecha pasada
    // ---------------------------------------
    if (fechaReserva) {
        fechaReserva.addEventListener('change', function (this: HTMLInputElement) {
            if (this.value < getLocalDate()) {
                this.value = '';
                Swal.fire({
                    title: "No es posible",
                    text: "No se puede seleccionar una fecha pasada",
                    icon: "warning"
                });
            }
        });
    }

    // ---------------------------------------
    // Validar hora
    // ---------------------------------------
    if (horaInicioInput) {
        horaInicioInput.addEventListener('change', function (this: HTMLInputElement) {
            let selectedTime = this.value;
            const now = new Date();

            if (selectedTime) {
                const [hour] = selectedTime.split(':');
                selectedTime = `${hour.padStart(2, '0')}:00`;
                this.value = selectedTime;

                const [selectedHour, selectedMinutes] = selectedTime.split(':').map(Number);

                // Rango permitido (06:00 - 20:00)
                if (selectedHour < 6 || selectedHour > 20) {
                    Swal.fire({
                        title: "No es posible",
                        text: "Seleccione una hora entre las 06:00 am y las 8:00 pm.",
                        icon: "warning"
                    });
                    return;
                }

                // Verificar si es la fecha de hoy
                const selectedDate = fechaReserva?.value ?? null;
                const today = now.toISOString().slice(0, 10);

                if (selectedDate === today) {
                    const currentHour = now.getHours();
                    const currentMinutes = now.getMinutes();

                    if (
                        selectedHour < currentHour ||
                        (selectedHour === currentHour && selectedMinutes < currentMinutes)
                    ) {
                        Swal.fire({
                            text: "No puede seleccionar una hora que ya ha pasado.",
                            icon: "error"
                        });
                    }
                }
            }
        });
    }

    // --- DATATABLES (Si existe en la vista) ---
    if (document.getElementById('reservas')) {
        new (window as any).DataTable('#reservas', {
            responsive: true,
            language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' }
        });
    }
});
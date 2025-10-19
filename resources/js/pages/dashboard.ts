// Archivo: resources/js/pages/dashboard.ts
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

export { };

declare const Swal: any; // Si usas SweetAlert2 por CDN, deja esto. Si lo importas con npm, quítalo e importa arriba: import Swal from 'sweetalert2';

declare global {
    interface Window {
        Laravel: {
            isAdmin: boolean;
            routes: {
                horariosShowReservaProfesores: string;
                // showDatosCursos: string;
                // obtenerProfesores: string;
                // obtenerCursos: string;
            };
        };
    }
}

document.addEventListener('DOMContentLoaded', function () {

    const horaFinInput = document.getElementById('tiempo') as HTMLInputElement | null;
    const horaInicioInput = document.getElementById('hora_inicio') as HTMLInputElement | null;
    const fechaReserva = document.getElementById('fecha_reserva') as HTMLInputElement | null;
    const isAdmin = window.Laravel?.isAdmin ?? false;

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
                    this.value = '';
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

    // ---------------------------------------
    // FullCalendar
    // ---------------------------------------
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            locale: esLocale,
            headerToolbar: {
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: [],
            eventClick: function (info: any) {
                const agenda = info.event;
                const start = agenda.start;
                const end = agenda.end;
                const prof = agenda.extendedProps.profesor || {};
                const cliente = agenda.extendedProps.cliente || {};

                (document.getElementById('nombres_cliente') as HTMLElement).textContent = `${cliente.nombres || 'No disponible'} ${cliente.apellidos || ''}`;
                (document.getElementById('nombres_teacher') as HTMLElement).textContent = `${prof.nombres || 'No disponible'} ${prof.apellidos || ''}`;
                (document.getElementById('fecha_reserva1') as HTMLElement).textContent = start.toISOString().split('T')[0];
                (document.getElementById('hora_inicio1') as HTMLElement).textContent = start.toLocaleTimeString();
                (document.getElementById('hora_fin1') as HTMLElement).textContent = end.toLocaleTimeString();

                ($("#mdalSelected") as any).modal("show");
            }
        });

        calendar.render();

        // Cargar eventos desde Laravel
        $.ajax({
            url: window.Laravel.routes.horariosShowReservaProfesores,
            type: 'GET',
            dataType: 'json',
            success: function (data: any) {
                calendar.addEventSource(data);
            },
            error: function () {
                alert('Error al obtener datos del profesor');
            }
        });
    }

    // ---------------------------------------
    // DataTables
    // ---------------------------------------
    new (window as any).DataTable('#reservas', {
        responsive: true,
        autoWidth: false,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
        language: {
            emptyTable: "No hay datos disponibles en la tabla",
            info: "Mostrando _START_ a _END_ de _TOTAL_ reservas",
            infoEmpty: "Mostrando 0 a 0 de 0 reservas",
            infoFiltered: "(filtrado de _MAX_ reservas totales)",
            lengthMenu: "Mostrar _MENU_ reservas",
            loadingRecords: "Cargando...",
            search: "Buscar:",
            zeroRecords: "No se encontraron registros",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" }
        }
    });
    
    
}); 
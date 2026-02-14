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

    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
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
        // Esto ayuda a que los eventos de fondo no se vean "transparentes" si hay errores
        nextDayThreshold: '00:00:00',
                    // Forzar que se vean los títulos en eventos de fondo (Disponibilidad)
            eventContent: function(arg) {
                if (arg.event.display === 'background') {
                    let container = document.createElement('div');
                    container.classList.add('fc-bg-event-label');
                    container.style.fontSize = '11px';
                    container.style.padding = '4px';
                    container.style.fontWeight = 'bold';
                    container.style.color = '#555';
                    container.innerText = arg.event.title;
                    return { domNodes: [container] };
                }
                return null; // Reservas normales usan renderizado estándar
            },

            eventClick: function (info: any) {
                if (info.event.display === 'background') return;

                const agenda = info.event;
                const props = agenda.extendedProps;

                // Llenar modal de detalles
                $('#nombres_cliente').text(props.cliente?.nombres || 'N/A');
                $('#nombres_teacher').text(props.profesor?.nombres || 'N/A');
                $('#fecha_reserva1').text(agenda.startStr.split('T')[0]);
                $('#hora_inicio1').text(agenda.start?.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
                $('#hora_fin1').text(agenda.end?.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));

                $("#mdalSelected").modal("show");
            },

            dateClick: function (info) {
                const today = new Date().toISOString().split('T')[0];
                const fechaSeleccionada = info.dateStr.split('T')[0];
                
                if (fechaSeleccionada < today) return;

                if (fechaReserva) fechaReserva.value = fechaSeleccionada;
                if (horaInicioInput && info.dateStr.includes('T')) {
                    horaInicioInput.value = info.dateStr.split('T')[1].substring(0, 5);
                }

                $("#claseModal").modal("show");
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
                    success: function () {
                        console.log("Eventos cargados con éxito");
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

    // --- DATATABLES (Si existe en la vista) ---
    if (document.getElementById('reservas')) {
        new (window as any).DataTable('#reservas', {
            responsive: true,
            language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' }
        });
    }
});
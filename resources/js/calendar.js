// resources/js/calendar.js
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import '@fullcalendar/daygrid/main.css';
import '@fullcalendar/timegrid/main.css';
import '@fullcalendar/list/main.css';

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: '/admin/horarios/show_reserva_profesores', // ruta Laravel
        eventClick: function(info) {
            const evento = info.event;
            $('#mdalSelected').modal('show');
            // asignar datos a modal
        }
    });

    calendar.render();
});

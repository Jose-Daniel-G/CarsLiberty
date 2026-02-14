import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

declare const $: any;
declare const Swal: any;
declare const window: any;

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const profesorSelect = document.getElementById('profesor_id');

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
});

    // 1. Agrega (Request $request) para poder leer lo que envía JS
    public function show_reserva_profesores(Request $request, $id = null)
    {
        // Si viene de la ruta es $id, si viene de FullCalendar es profesor_id
        $profesorId = $id ?? $request->query('profesor_id');

        if (!$profesorId) return response()->json([]);

        // Disponibilidad (Fondo)
        $horarios = Horario::whereHas('profesores', function ($q) use ($profesorId) {
            $q->where('profesor_id', $profesorId);
        })->get();

        // Agendas (Eventos visibles)
        $agendas = DB::table('agendas')
            ->join('cursos', 'agendas.curso_id', '=', 'cursos.id')
            ->where('agendas.profesor_id', $profesorId)
            ->select('agendas.id', 'agendas.start', 'agendas.end', 'cursos.nombre as curso_nombre')
            ->get();

        $eventos = [];

        // Mapeo para disponibilidad
        $dias_map = ['LUNES' => [1], 'MARTES' => [2], 'MIERCOLES' => [3], 'JUEVES' => [4], 'VIERNES' => [5], 'SABADO' => [6], 'DOMINGO' => [0]];

        foreach ($horarios as $h) {
            // Usamos carbon o date para asegurar que solo enviamos "HH:mm:ss"
            $inicio = date('H:i:s', strtotime($h->hora_inicio));
            $fin = date('H:i:s', strtotime($h->tiempo));

            $eventos[] = [
                'daysOfWeek' => $dias_map[strtoupper($h->dia)] ?? [],
                'startTime' => $inicio, // Ahora enviará ej: "11:00:00"
                'endTime' => $fin,     // Ahora enviará ej: "19:00:00"
                'display' => 'background',
                'color' => '#d4edda'
            ];
        }

        foreach ($agendas as $a) {
            $eventos[] = [
                'id' => $a->id,
                'title' => $a->curso_nombre,
                'start' => $a->start,
                'end' => $a->end,
                'backgroundColor' => '#ff0000',
                'borderColor' => '#b30000',
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'tipo' => 'agenda',
                    'cliente' => $a->cliente_nombre ?? 'Estudiante'
                ]
            ];
        }

        return response()->json($eventos);
    }
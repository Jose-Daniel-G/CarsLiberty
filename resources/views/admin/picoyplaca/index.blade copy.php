@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Draggable Events</h4>
                    </div>
                    <div class="card-body">

                        <div id="external-events">
                            <div class="external-event bg-success ui-draggable ui-draggable-handle"
                                style="position: relative;">Lunch</div>
                            <div class="external-event bg-warning ui-draggable ui-draggable-handle"
                                style="position: relative;">Go home</div>
                            <div class="external-event bg-info ui-draggable ui-draggable-handle"
                                style="position: relative;">Do homework</div>
                            <div class="external-event bg-primary ui-draggable ui-draggable-handle"
                                style="position: relative;">Work on UI design</div>
                            <div class="external-event bg-danger ui-draggable ui-draggable-handle"
                                style="position: relative;">Sleep tight</div>
                            <div class="checkbox">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Event</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                            </ul>
                        </div>

                        <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                            <div class="input-group-append">
                                <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">

                    <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">

                </div>

            </div>

        </div>

    </div>

@stop

@section('js')
    {{-- Axios JS --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var currentColor = 'bg-primary'; // Color por defecto para el nuevo evento

    // Inicializa los eventos externos para arrastrar
    var containerEl = document.getElementById('external-events');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.external-event', // Selecciona los elementos que serán arrastrables
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText.trim(), // Toma el título del evento
                backgroundColor: window.getComputedStyle(eventEl).backgroundColor, // Color del fondo
                borderColor: window.getComputedStyle(eventEl).backgroundColor, // Color del borde
                textColor: 'white' // Forzamos texto blanco para mejor contraste
            };
        }
    });

    // Inicializa el calendario
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        locale: 'es',
        editable: true,
        droppable: true, // Permitir que se suelten eventos externos en el calendario
        drop: function(info) {
            if (document.getElementById('drop-remove').checked) {
                // Elimina el evento de la lista si se seleccionó la opción "remove after drop"
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        events: [] // Inicialmente vacío
    });

    calendar.render(); // Renderiza el calendario

    // Función para cambiar el color seleccionado
    document.querySelectorAll('#color-chooser li a').forEach(function(colorElement) {
        colorElement.addEventListener('click', function(e) {
            e.preventDefault();
            currentColor = this.classList[1]; // Captura la clase de color seleccionada (e.g., 'text-primary')
        });
    });

    // Añadir funcionalidad para crear nuevos eventos
    document.getElementById('add-new-event').addEventListener('click', function() {
        var eventTitle = document.getElementById('new-event').value; // Obtén el título del nuevo evento

        if (eventTitle) {
            // Crear el nuevo evento
            var newEvent = document.createElement('div');
            newEvent.className = 'external-event ' + currentColor; // Aplica la clase de color al evento
            newEvent.style.position = 'relative';
            newEvent.innerText = eventTitle;
            
            // Aquí aplicamos el color de fondo al recuadro del evento según la clase seleccionada
            if (currentColor.includes('text-')) {
                newEvent.classList.remove('text-primary', 'text-warning', 'text-success', 'text-danger', 'text-muted');
                newEvent.classList.add(currentColor.replace('text-', 'bg-')); // Cambia 'text-' por 'bg-'
            }
            
            newEvent.style.color = 'white'; // Texto en blanco para asegurar buen contraste

            // Añadir el evento al principio de la lista de eventos externos
            document.getElementById('external-events').prepend(newEvent);

            // Hacerlo arrastrable
            new FullCalendar.Draggable(newEvent, {
                eventData: {
                    title: eventTitle,
                    backgroundColor: window.getComputedStyle(newEvent).backgroundColor, // Usar el color actual del nuevo evento
                    borderColor: window.getComputedStyle(newEvent).backgroundColor,
                    textColor: 'white'
                }
            });

            // Limpiar el campo de texto
            document.getElementById('new-event').value = '';
        } else {
            alert('Por favor, escribe un título para el evento');
        }
    });
});





    </script>
@stop

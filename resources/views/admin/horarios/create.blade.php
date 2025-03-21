@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Registro de un nuevo horario</h1>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Llene los Datos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{ route('admin.horarios.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="profesor_id">Profesores </label><b>*</b>
                                <select class="form-control" name="profesor_id" id="profesor_id">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($profesores as $profesor)
                                        <option value="{{ $profesor->id }}">
                                            {{ $profesor->nombres . ' ' . $profesor->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('profesor_id')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="curso_id">Cursos </label><b>*</b>
                                <select name="curso_id" id="curso_select" class="form-control">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">
                                            {{ $curso->nombre }}
                                            {{-- {{ $curso->nombre . ' - ' . $curso->ubicacion }} --}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('curso_id')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for="dia">Dia </label><b>*</b>
                                <select class="form-control" name="dia" id="dia">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="LUNES">LUNES</option>
                                    <option value="MARTES">MARTES</option>
                                    <option value="MIERCOLES">MIERCOLES</option>
                                    <option value="JUEVES">JUEVES</option>
                                    <option value="VIERNES">VIERNES</option>
                                    <option value="SABADO">SABADO</option>
                                </select>
                                @error('dia')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hora_inicio">Hora Inicio </label><b>*</b>
                                <input type="time" class="form-control" name="hora_inicio" id="hora_inicio"
                                    value="{{ old('hora_inicio') }}" required>
                                @error('hora_inicio')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hora_fin">Hora Final </label><b>*</b>
                                <input type="time" class="form-control" name="hora_fin" id="hora_fin"
                                    value="{{ old('hora_fin') }}" required>
                                @error('hora_fin')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">Regresar</a>
                                <button type="submit" class="btn btn-primary">Registrar horario</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <hr>
                        <div id="curso_info"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        // carga contenido de tabla en  curso_info
        $('#profesor_id').on('change', function() {
            var profesor_id = $('#profesor_id').val();
            var url = "{{ route('admin.horarios.show_datos_cursos', ':id') }}";
            url = url.replace(':id', profesor_id);
            // alert(profesor_id);

            if (profesor_id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        // console.log(data);
                        $('#curso_info').html(data);
                    },
                    error: function() {
                        alert('Error al obtener datos del curso');
                    }
                });
            } else {
                $('#curso_info').html('');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const HoraIncioInput = document.getElementById('hora_inicio');
            const HoraFinInput = document.getElementById('hora_fin');

            // Escuchar el evento de cambio en el campo de hora de reserva
            HoraIncioInput.addEventListener('change', function() {
                let selectedTime = this.value; //Obtener fecha seleccionada
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime) {
                    selectedTime = selectedTime.split(':'); //Dividir la cadena en horas y minutos
                    selectedTime = selectedTime[0] + ':00'; //conservar la hora, ignorar los minutos
                    this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
                }
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime < '06:00' || selectedTime > '20:00') {
                    // si es asi, establecer la hora seleccionada en null
                    this.value = null;
                    alert('');
                    Swal.fire({
                        title: "No fue posible",
                        text: "Por favor seleccione una fecha entre 08:00 y las 20:00",
                        icon: "info"
                    });
                }
            })

            // Agregar un evento de cambio al input
            HoraFinInput.addEventListener('change', function() {
                let selectedTime = this.value;
                // Conservar solo la hora, ignorar los minutos
                selectedTime = selectedTime.split(':')[0] + ':00'; // "14:00"
                this.value = selectedTime;
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime < '06:00' || selectedTime > '20:00') {
                    // si es asi, establecer la hora seleccionada en null
                    this.value = null;
                    Swal.fire({
                        title: "No fue posible",
                        text: "Por favor seleccione una fecha entre 08:00 y las 20:00",
                        icon: "info"
                    });
                }
            });
        });
    </script>
    @if (session('info') && session('icono') && session('title'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif
@stop

@extends('adminlte::page')

@section('title', 'CarsLiberty')

@section('content_header')
    <h1>Registro de un nuevo horario</h1>
@stop

@section('content')
    <div class="container-fluid"> 
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
                                <label for="profesor_id">Profesores </label><b class="text-danger">*</b>
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
                                <label for="cursos">Cursos</label><b class="text-danger">*</b>
                                <div id="curso_checkboxes" class="d-flex flex-wrap">
                                    @foreach ($cursos as $curso)
                                        <div class="form-check me-3"> {{-- Espaciado entre checkboxes --}}
                                            <input type="checkbox" name="cursos[]" id="curso_{{ $curso->id }}"
                                                value="{{ $curso->id }}" class="form-check-input">
                                            {{ $curso->nombre }}
                                            <label class="form-check-label" for="curso_{{ $curso->id }}"></label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('cursos')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="dia">Dia </label><b class="text-danger">*</b>
                                <select class="form-control" name="dia" id="dia">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="LUNES">LUNES</option>
                                    <option value="MARTES">MARTES</option>
                                    <option value="MIERCOLES">MIERCOLES</option>
                                    <option value="JUEVES">JUEVES</option>
                                    <option value="VIERNES">VIERNES</option>
                                    <option value="SABADO">SABADO</option>
                                    <option value="DOMINGO">DOMINGO</option>
                                </select>
                                @error('dia')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hora_inicio">Hora Inicio </label><b class="text-danger">*</b>
                                <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" required>
                                @error('hora_inicio')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tiempo">Hora Final </label><b class="text-danger">*</b>
                                <input type="time" class="form-control" name="tiempo" id="tiempo"  required>
                                @error('tiempo')
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

@section('js')
    <script>
        // carga contenido de tabla en  curso_info
        $('#profesor_id').on('change', function() {
            var profesor_id = $('#profesor_id').val();
            var url = "{{ route('admin.horarios.show_datos_cursos', ':id') }}";
            url = url.replace(':id', profesor_id);

            if (profesor_id) {
                $.ajax({url: url,type: 'GET',success: function(data) {
                        $('#curso_info').html(data);// console.log("Respuesta del servidor:", data);
                    },
                    error: function(xhr) {alert('Error al obtener datos del curso');}
                });
            } else {
                $('#curso_info').html('');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const HoraIncio = document.getElementById('hora_inicio');
            const Tiempo = document.getElementById('tiempo');
 
            HoraIncio.addEventListener('change', function() {
                let selectedTime = this.value;  
                
                if (selectedTime) {                        
                    selectedTime = selectedTime.split(':'); //Dividir la cadena en horas y minutos
                    selectedTime = selectedTime[0] + ':00'; //conservar la hora, ignorar los minutos
                    this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
                } 

                if (selectedTime < '06:00' || selectedTime > '20:00') { 
                    this.value = null;
                    Swal.fire({
                        title: "No fue posible",
                        text: "Por favor seleccione una fecha entre 06:00 am y las 8:00 pm",
                        icon: "info"
                    });
                }
            })

          
            Tiempo.addEventListener('change', function() {
                let selectedTime = this.value;
                
                selectedTime = selectedTime.split(':')[0] + ':00';     // Conservar solo la hora, ignorar los minutos
                this.value = selectedTime;
                
                if (selectedTime < '06:00' || selectedTime > '20:00') {// verificar si la fecha selecionada es anterior a la fecha actual

                    this.value = null;                                 // si es asi, establecer la hora seleccionada en null
                    Swal.fire({
                        title: "No fue posible",
                        text: "Por favor seleccione una fecha entre 06:00 am y las 8:00 pm",
                        icon: "info"
                    });
                }
            });
        });
    </script> 
@stop

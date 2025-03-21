@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <h2>Marcar Asistencia</h2> --}}
    <h2>Asistencia a Clase de Conducción</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista</h3>
                    <div class="card-tools">{{-- <i class="fa-solid fa-plus"></i> --}}
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.asistencias.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="cliente">Seleccionar Cliente:</label>
                                <select name="cliente_id" class="form-control">
                                    <option value="" selected disabled>Seleccione..</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombres }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="evento">Seleccionar Clase:</label>
                                <select name="evento_id" class="form-control">
                                    @foreach ($eventos as $evento)
                                        <option value="{{ $evento->id }}">{{ $evento->title }} - {{ $evento->start }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Asistió:</label><br>
                                <input type="radio" name="asistio" value="1" checked> Sí
                                <input type="radio" name="asistio" value="0"> No
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="form-control btn btn-primary"
                                    style="margin-top: 28px;">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Aquí puedes agregar estilos adicionales si lo deseas -->
@endsection

@section('js')
    @if (session('info') && session('icono') && session('title'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif
    {{-- <script>
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
                    alert('Por favor seleccione una fecha entre 08:00 y las 20:00');
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
                    alert('Por favor seleccione una fecha entre 08:00 y las 20:00');
                }
            });
        });
    </script> --}}
@endsection

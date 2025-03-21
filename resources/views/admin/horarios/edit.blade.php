    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row">
            <h1>Actualizacion curso: {{ $curso->nombre }} {{ $curso->ubicacion }}</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.horarios.update', $horario->id)  }}" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profesor_id">Profesores </label><b>*</b>
                                        <select class="form-control" name="profesor_id" id="profesor_id">
                                            @foreach ($profesores as $profesor)
                                                <option value="{{ $profesor->id }}" 
                                                    {{ (old('profesor_id') == $profesor->id || $horario->profesor_id == $profesor->id) ? 'selected' : '' }}>
                                                    {{ $profesor->nombres . ' ' . $profesor->apellidos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('profesor_id')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="curso_id">Cursos </label><b>*</b>
                                        <select class="form-control" name="curso_id" id="curso_id">
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            @foreach ($cursos as $curso)
                                                <option value="{{ $curso->id }}"
                                                    {{ (old('curso_id') == $curso->id || $horario->curso_id == $curso->id) ? 'selected' : '' }}>

                                                    {{ $curso->nombres  .'  '. $curso->ubicacion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('curso_id')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dia">Día </label><b>*</b>
                                        <select class="form-control" name="dia" id="dia">
                                            <option value="" disabled {{ old('dia', $horario->dia) == null ? 'selected' : '' }}>Seleccione una opción</option>
                                            @foreach (['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'] as $dia)
                                                <option value="{{ $dia }}" {{ old('dia', $horario->dia) == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                                            @endforeach
                                        </select>
                                        @error('dia')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hora_inicio">Hora Inicio </label><b>*</b>
                                        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio"
                                            value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>
                                        @error('hora_inicio')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hora_fin">Hora Final </label><b>*</b>
                                        <input type="time" class="form-control" name="hora_fin" id="hora_fin"
                                            value="{{ old('hora_fin', $horario->hora_fin) }}" required>
                                        @error('hora_fin')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.horarios.index') }}"
                                            class="btn btn-secondary">Regresar</a>
                                        <button type="submit" class="btn btn-primary">Actualizar horario</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    @stop

    @section('css')

    @stop

    @section('js')

    @stop

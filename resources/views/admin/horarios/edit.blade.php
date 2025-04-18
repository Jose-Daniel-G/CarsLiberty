    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row"> <h1>Actualizacion curso: {{  $horario->cursos->pluck('nombre')->join(', ') }}</h1></div>
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
                                        <label for="profesor_id">Profesores </label><b class="text-danger">*</b>
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
                                
                                <div class="form-group">
                                    <label for="cursos">Cursos</label><b class="text-danger">*</b>
                                    <div id="curso_checkboxes" class="d-flex flex-wrap">
                                        @foreach ($cursos as $curso)
                                            <div class="form-check me-3"> {{-- Espaciado entre checkboxes --}}
                                                <input type="checkbox" name="cursos[]" id="curso_{{ $curso->id }}" value="{{ $curso->id }}" class="form-check-input">
                                                <label class="form-check-label" for="curso_{{ $curso->id }}">
                                                    {{ $curso->nombre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('cursos')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dia">Día </label><b class="text-danger">*</b>
                                        <select class="form-control" name="dia" id="dia">
                                            <option value="" disabled {{ old('dia', $horario->dia) == null ? 'selected' : '' }}>Seleccione una opción</option>
                                            @foreach (['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'] as $dia)
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
                                        <label for="hora_inicio">Hora Inicio </label><b class="text-danger">*</b>
                                        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio"
                                            value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>
                                        @error('hora_inicio')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hora_fin">Hora Final </label><b class="text-danger">*</b>
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

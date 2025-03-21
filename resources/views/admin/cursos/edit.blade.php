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
                        <form action="{{ route('admin.cursos.update', $curso->id) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del curso </label><b>*</b>
                                        <input type="text" class="form-control" name="nombre"
                                            value="{{ $curso->nombre }}" required>
                                        @error('nombre')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="descripcion">Descripcion </label><b>*</b>
                                        <input type="text" class="form-control" name="descripcion"
                                            value="{{ $curso->descripcion }}" required>
                                        @error('descripcion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="horas_requeridas">horas requeridas </label><b>*</b>
                                        <input type="number" class="form-control" name="horas_requeridas"
                                            value="{{ $curso->horas_requeridas }}" required>
                                        @error('horas_requeridas')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado">Estado </label><b>*</b>
                                        <select name="estado" id="" class="form-control" name="estado">
                                            <!-- Opción por defecto -->
                                            <option value="" selected disabled>{{ $curso->estado == 'A' ? 'Activo' : 'Inactivo' }}</option>
                                            <option value="A">Activo</option>
                                            <option value="I">Inactivo</option>
                                        </select>
                                        @error('estado')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Actualizar curso</button>
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

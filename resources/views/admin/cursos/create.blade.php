@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Registro de un nuevo curso</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.cursos.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del curso </label><b>*</b>
                                        <input type="text" class="form-control" name="nombre"
                                            value="{{ old('nombre') }}" required>
                                        @error('nombre')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="descripcion">Descripcion </label><b>*</b>
                                        <input type="text" class="form-control" name="descripcion"
                                            value="{{ old('descripcion') }}" required>
                                        @error('descripcion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="horas_requeridas">horas requeridas </label><b>*</b>
                                        <input type="number" class="form-control" name="horas_requeridas"
                                            value="{{ old('horas_requeridas') }}" required>
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
                                            <option value="" selected disabled>Seleccione una opción</option>
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
                                    <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">
                                        Cancelar
                                        {{-- <i class="fa-solid fa-plus"></i> --}}
                                    </a>
                                    <button type="submit" class="btn btn-primary">Registrar curso</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop

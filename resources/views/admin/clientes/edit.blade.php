    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h3>Sistema de reservas </h3>
    @stop

    @section('content')

        <div class="row">
            <h2>Modificar cliente: <b>{{ $cliente->nombres }} {{ $cliente->apellidos }}</b></h2>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombres">Nombres </label><b>*</b>
                                        <input type="text" class="form-control" name="nombres"
                                            value="{{ $cliente->nombres }}" required>
                                        @error('nombres')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label><b>*</b>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="{{ $cliente->apellidos }}" required>
                                        @error('apellidos')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cc">Cc </label><b>*</b>
                                        <input type="text" class="form-control" name="cc"
                                            value="{{ $cliente->cc }}" required>
                                        @error('cc')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular </label><b>*</b>
                                        <input type="number" class="form-control" name="celular"
                                            value="{{ $cliente->celular }}" required>
                                        @error('celular')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="genero">Sexo </label><b>*</b>
                                        <select name="genero" id="" class="form-control" name="genero">
                                            <!-- Opción por defecto -->
                                            @if ($cliente->genero == 'M')
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            @else
                                                <option value="F">Femenino</option>
                                                <option value="M">Masculino</option>
                                            @endif
                                        </select>
                                        @error('genero')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo </label><b>*</b>
                                        <input type="email" class="form-control" name="correo"
                                            value="{{ $cliente->correo }}" required>
                                        @error('correo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Direccion </label><b>*</b>
                                        <input type="address" class="form-control" name="direccion"
                                            value="{{ $cliente->direccion }}" required>
                                        @error('direccion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contacto_emergencia">Contacto Emergencia</label><b>*</b>
                                        <input type="number" class="form-control" name="contacto_emergencia"
                                            value="{{ $cliente->contacto_emergencia }}" required>
                                    </div>
                                    @error('contacto_emergencia')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Cursos que tomará:</label>
                                    <div class="row">
                                        @foreach ($cursos as $curso)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" 
                                                           name="cursos[]" 
                                                           value="{{ $curso->id }}" 
                                                           class="form-check-input" 
                                                           id="curso{{ $curso->id }}"
                                                           {{ in_array($curso->id, $cursosSeleccionados) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="curso{{ $curso->id }}">
                                                        {{ $curso->nombre }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones">{{ $cliente->observaciones }}</textarea>
                                    </div>
                                </div>
                            
                                <div class="col-md-4 d-flex align-items-center">
                                    <div class="form-group mb-0">
                                        <input type="checkbox" id="reset-password" name="reset_password">
                                        <label for="reset-password" class="ml-2">Restablecer contraseña a la cédula</label>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
                                        Cancelar
                                        {{-- <i class="fa-solid fa-plus"></i> --}}
                                    </a>
                                    <button type="submit" class="btn btn-success">Actualizar cliente</button>

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

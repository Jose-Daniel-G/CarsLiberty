@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil Configuraciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuario Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <!-- Main content -->
    <div class="container-fluid">
        <form action="{{ route('admin.user-profile-information.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <!-- Perfil Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <label for="photo">Foto</label>

                            <div class="form-group text-center">
                                <!-- Foto de Perfil Actual -->
                                <img id="current-photo" src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                    alt="{{ $user->name }}" class="profile-user-img img-fluid img-circle"
                                    style="width: 100px; height: 100px; object-fit: cover" />

                                {{-- @if ($user->profile_photo_path)
                                    <button class="btn btn-secondary mt-2" type="button" wire:click="deletePerfilPhoto">
                                        {{ __('Remove Photo') }}
                                    </button>
                                @endif

                                @error('photo')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <div class="form-group">
                                <input type="file" name="photo" id="file" class="form-control-file"
                                    accept=".jpg, .jpeg, .png" accept="image/*" style="display: none;">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->email }}</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    @if ($info = Session::get('success'))
                                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>

        <div class="row">
            <div class="col">

                <div class="row">
                    <div class="col">
                        @can('admin.config.index')
                            <form action="{{ route('admin.user-profile-password.updatePassword') }}" method="POST">
                                @csrf @method('PUT')
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="current_password"
                                                class="col-sm-2 col-form-label">{{ __('Contrasena Actual') }}</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="current_password"
                                                    name="current_password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation"
                                                class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">{{ __('Save') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        // Obtén los elementos
        const picture = document.getElementById('current-photo');
        const fileInput = document.getElementById('file');

        // Al hacer clic en la imagen, simula un clic en el input file
        picture.addEventListener('click', () => {
            fileInput.click();
        });
        // Cambiar la imagen mostrada cuando se selecciona un archivo
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = (event) => {
                // Actualiza la imagen con la nueva seleccionada
                picture.src = event.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@stop

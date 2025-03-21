@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 80%;
            height: 80%;
        }

        .image-wrapper img:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
            /* Sombra más oscura al pasar el cursor */
            transform: scale(1.05);
            /* Efecto de zoom al hacer hover */
        }
    </style>
@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Registro de una nueva configuración</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.config.store') }}" method="POST" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="logo">Logo</label>

                                    <div class="form-group">

                                        <div class="image-wrapper">

                                            @isset($post->image)
                                                <img src="{{ asset($post->image->url) }}" alt="" id="picture"
                                                    accept="image/*">
                                            @else
                                                <img id="picture"
                                                    src="https://cdn.pixabay.com/photo/2020/03/27/13/02/venice-4973502_1280.jpg"
                                                    alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="logo" id="file" class="form-control-file"  accept=".jpg, .jpeg, .png" 
                                                accept="image/*" style="display: none;">
                                        </div>
                                        @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site_name">Nombre del sitio</label>
                                            <input type="text" class="form-control" name="site_name"
                                                value="{{ old('site_name') }}" required>
                                            @error('site_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Dirección</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address') }}" required>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <input type="number" class="form-control" name="phone"
                                                value="{{ old('telefono') }}" required>
                                            @error('telefono')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email_contact">Correo de contacto</label>
                                            <input type="email" class="form-control" name="email_contact"
                                                value="{{ old('email_contact') }}" required>
                                            @error('email_contact')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('admin.config.index') }}" class="btn btn-secondary">
                                                Cancelar
                                            </a>
                                            <button type="submit" class="btn btn-primary">Registrar configuracion</button>
                                        </div>
                                    </div>
                                </div>
                            </form>



                            {{-- <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col">

                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae, officiis
                                                incidunt commodi numquam quas
                                                esse alias, dolor ipsum dignissimos eius hic a. Aliquam eveniet minima incidunt
                                                amet temporibus, commodi
                                                quisquam?</p>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- <div class="form-group">
                                <label for="logo">Logo</label><b>*</b>
                                <input type="file" id="file" class="form-control" name="logo" required>
                                <div class="text-center"><output id="list"></output></div>
                                @error('logo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                /div> --}}


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
        // Obtén los elementos
        const picture = document.getElementById('picture');
        const fileInput = document.getElementById('file');

        // Al hacer clic en la imagen, simula un clic en el input file
        picture.addEventListener('click', () => {
            fileInput.click(); // Activa el input file
        });
        // Cambiar imagen
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
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.getElementById('file').addEventListener('change', function(evt) {
        //         var files = evt.target.files; // FileList object
        //         if (files.length > 0) {
        //             var file = files[0]; // Tomamos el primer archivo seleccionado
        //             if (!file.type.match('image.*')) {
        //                 alert("Solo se permiten archivos de imagen.");
        //                 return;
        //             }

        //             var reader = new FileReader();
        //             reader.onload = function(e) {
        //                 document.getElementById("list").innerHTML =
        //                     `<img class="thumb thumbnail" src="${e.target.result}" width="100%" title="${file.name}"/>`;
        //             };
        //             reader.readAsDataURL(file);
        //         }
        //     });
        // });
    </script>
@stop

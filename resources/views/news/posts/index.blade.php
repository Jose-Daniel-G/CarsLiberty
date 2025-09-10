@extends('adminlte::page')

@section('title', 'Dashboard')
{{-- @section('plugins.Sweetalert2', true) --}}
@section('css')

@stop
@section('content_header')
    <h1>Springfield News</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg mt-2">
                <div class="card-header headerRegister">
                    <h5 class="card-title" id="titleModal">Nueva Noticia</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <h6 class="alert alert-success">{{ session('success') }}</h6>
                        @endif
                        <p class="text-primary">Los campos con asterisco (<span class="required text-danger">*</span>)sonobligatorios.</p>
                        <div class="row page-titles">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Detalles de la noticia</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-xlg-5 col-md-5">
                                <label for="foto">
                                    <img class="card-img border" id="img_preview"
                                        src="{{ asset('images/portada_noticia.png') }}" alt="Card image">
                                </label>
                                <input id="foto" name="foto" type="file" accept="image/*"
                                    style="display: none;" />
                                @error('foto')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="text-muted p-t-30 db">Social Profile</small>

                                <br>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                            </div>
                            <div class="col-lg-7 col-xlg-7 col-md-7">
                                <div class="form-group">
                                    <label class="control-label" for="titulo">Notice<span
                                            class="required">*</span></label>
                                    <input class="form-control" id="txtTitulo" name="txtTitulo" type="text"
                                        placeholder="Titulo" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Descripción <span class="required">*</span></label>
                                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2"
                                        placeholder="Descripción de la Noticia" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category<span class="required">*</span></label>
                                    <select name="category_id" class="form-control selectpicker" id="categoria"
                                        name="categoria">
                                        <option value="">Seleccione ...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <button id="btnActionForm" class="btn btn-primary mt-3" type="submit"><i
                                            class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText"
                                            title="Crear Noticia">Guardar</span></button>
                                </div>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        // Obtener referencia al input y a la imagen
        window.onload = function() {
            const $seleccionArchivos = document.querySelector("#foto"),
                $imagenPrevisualizacion = document.querySelector("#img_preview");

            // Escuchar cuando cambie
            $seleccionArchivos.addEventListener("change", () => {
                // Los archivos seleccionados, pueden ser muchos o uno
                const archivos = $seleccionArchivos.files;
                // Si no hay archivos salimos de la función y quitamos la imagen
                if (!archivos || !archivos.length) {
                    $imagenPrevisualizacion.src = "";
                    return;
                }
                // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                const primerArchivo = archivos[0];
                // Lo convertimos a un objeto de tipo objectURL
                const objectURL = URL.createObjectURL(primerArchivo);
                // Y a la fuente de la imagen le ponemos el objectURL
                $imagenPrevisualizacion.src = objectURL;
            });
        }
    </script>
@stop

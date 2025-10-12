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
                    <div class="card-tools">
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-message></x-message>{{-- JD  resources/views/components --}}
                        <div class="row">
                            <div class="col">
                                <table id="posts" class="table table-hover table-bordered table-striped table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Titulo</th>
                                            <th>Creación</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->created_at->format('d M, Y') }}</td>
                                                <td class="text-center">
                                                    {{-- @can('posts.edit') --}}
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="btn btn-sm btn-outline-dark me-2">Editar</a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('posts.delete') --}}

                                                    <form id="delete-form-{{ $post->id }}"
                                                        action="{{ route('posts.destroy', $post->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            title="Eliminar" onclick="confirmDelete({{ $post->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    {{-- @endcan --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No hay permisos registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                @include('news.posts.create')
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
                const archivos = $seleccionArchivos.files;// Los archivos seleccionados, pueden ser muchos o uno
                
                if (!archivos || !archivos.length) {      // Si no hay archivos salimos de la función y quitamos la imagen
                    $imagenPrevisualizacion.src = "";
                    return;
                }
               
                const primerArchivo = archivos[0];        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                const objectURL = URL.createObjectURL(primerArchivo); // Lo convertimos a un objeto de tipo objectURL
                $imagenPrevisualizacion.src = objectURL;   // Y a la fuente de la imagen le ponemos el objectURL
            });
        }
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estás seguro de que deseas eliminar esta publicacion?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();// Si el usuario confirma, se envía el formulario.
                }
            });
        }
        new DataTable('#posts', {
            responsive: true,scrollX: true,
            autoWidth: false,  
            dom: 'Bfrtip',                                              // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{extend: 'copyHtml5',text: '<i class="bi bi-clipboard-check"></i> Copiar'}, // Added btn-sm for better consistency
                          {extend: 'csvHtml5',text: '<i class="bi bi-filetype-csv"></i> CSV'},
                          {extend: 'excelHtml5',text: '<i class="bi bi-file-earmark-excel"></i> Excel'},
                          {extend: 'pdfHtml5',text: '<i class="bi bi-filetype-pdf"></i> PDF'},
                          {extend: 'print',text: '<i class="bi bi-printer"></i> Imprimir' },
                          {extend: 'colvis'}],
            }, ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ cursos",
                "infoEmpty": "Mostrando 0 a 0 de 0 cursos",
                "infoFiltered": "(filtrado de _MAX_ cursos totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ cursos",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            }

        }); 
    </script>
@stop

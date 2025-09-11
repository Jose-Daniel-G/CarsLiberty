@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <style>
        .color-container {
            width: 16px;
            height: 16px;
            display: inline-block;
            border-radius: 4px;
        }
    </style>
@stop

@section('content_header')
    <h1>Springfield News</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

            {{-- Formulario para nueva categoría --}}
            <div class="card shadow-lg mt-2">
                <div class="card-header">
                    <label for="name" class="form-label">Nueva categoría</label>
                </div>
                <div class="card-body">
                    <x-message></x-message>

                    <form action="{{ route('categories.index') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nombre de la categoría">
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>

            {{-- Lista de categorías --}}
            <div class="card shadow mt-3">
                <div class="card-body">
                    @foreach ($categories as $category)
                        <div class="row py-2 align-items-center">
                            <div class="col-md-9 d-flex align-items-center gap-2">
                                <span class="color-container" style="background-color: {{ $category->color }}"></span>
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-decoration-none">
                                    {{ $category->name }}
                                </a>
                            </div>
                            <div class="col-md-3 text-end">
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#modal-{{ $category->id }}">Delete
                                </button> 
                            </div>
                        </div>
                        {{-- Modal de eliminación --}}
                        {{-- @include('news.categories.delete_modal', $category) --}}
                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $category->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Al eliminar la categoria <strong> {{ $category->name }}</strong> se eliminan todas
                                        las tareas asignadas a la misma. Está seguro que desea eliminar la categoria
                                        <strong>{{ $category->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @method('DELETE') @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@stop

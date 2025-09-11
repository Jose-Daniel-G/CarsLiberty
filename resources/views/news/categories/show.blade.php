@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container w-25 border p-4 mt-4">

        <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST">
            {{-- <form action="{{ route('categories.update') }}" method="POST"> --}}
            @method('PATCH')
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            @error('category')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Edit category </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Edit color category</label>
                <input type="color" class="form-control" id="color" name="color" value="{{ $category->color }}">
            </div>
            <button type="submit" class="btn btn-primary">Update category</button>
        </form>
        @if ($category->todos->count() > 0)
            @foreach ($categories->todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('categories.edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <form action="{{ route('categories.destroy', ['id' => $todo->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <h6 class="alert alert-danger">No hay tareas para esta categoria</h6>

            </ul>
        @endif
    @stop

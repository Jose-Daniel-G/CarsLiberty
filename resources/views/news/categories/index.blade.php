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
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('categories.index') }}" method="POST">
                    @csrf
                    @if (session('success'))
                        <h6 class="alert alert-success">{{ session('success') }}</h6>
                    @endif
                    @error('name')
                        <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror

                    <div class="card shadow-lg mt-2">
                        <div class="card-header">
                            <label for="name" class="form-label">Nueva categoria </label>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-2">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Crear categoria</button> --}}
                </form>
                @foreach ($categories as $category)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a class="d-flex align-items-center gap-2"
                                href="{{ route('categories.edit', $category->id) }}">
                                <span class="color-container" style="background-color: {{ $category->color }}"></span>
                            </a>
                            {{ $category->name }}
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <!-- Button trigger modal -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $category->id }}">Delete</button>
                        </div>
                    </div>
                    @include('news.categories.modals.delete_modal', ['category' => $category])
                @endforeach
        </div>
@stop
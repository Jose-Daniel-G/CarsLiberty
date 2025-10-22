@extends('adminlte::page')

@section('title', 'CarsLiberty')
@section('css')
@stop
@section('content_header')
    <h1>Panel principal</h1>
@stop
@section('content')
<div class="container mt-4">
    <h2>Agendar clase de conducción 🚗</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('citas.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="form-group">
            <label>Nombre del estudiante</label>
            <input type="text" name="nombre_estudiante" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Email</label>
            <input type="email" name="email_estudiante" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Teléfono (WhatsApp)</label>
            <input type="text" name="telefono_estudiante" class="form-control" placeholder="Ej: 3001234567" required>
        </div>

        <div class="form-group mt-2">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Hora</label>
            <input type="time" name="hora" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Instructor</label>
            <input type="text" name="instructor" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Agendar</button>
    </form>
</div>
@stop

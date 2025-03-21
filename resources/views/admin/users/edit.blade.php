@extends('adminlte::page')

@section('title', 'JDeveloper')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success"><strong>{{session('info')}}</strong></div>
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{ $user->name }}</p>
            <h2 class="h5">Listado de Roles</h2>

            <!-- Formulario para actualizar roles -->
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($roles as $role)
                    <div>
                        <label>
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                   {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-2">Asignar rol</button>
            </form>
        </div>
    </div>
@stop

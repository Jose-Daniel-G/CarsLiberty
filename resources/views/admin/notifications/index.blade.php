@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1>Notificaciones</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notification)
                    <tr @if(is_null($notification->read_at)) class="table-warning" @endif>
                        <td>{{ $notification->data['title'] ?? 'Sin título' }}</td>
                        <td>{{ $notification->data['description'] ?? '-' }}</td>
                        <td>{{ $notification->created_at->diffForHumans() }}</td>
                        <td>
                            @if($notification->read_at)
                                <span class="badge badge-success">Leída</span>
                            @else
                                <span class="badge badge-warning">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Marcar como leída
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tienes notificaciones</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $notifications->links() }}
    </div>
</div>
@stop

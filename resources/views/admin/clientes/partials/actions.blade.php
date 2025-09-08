<div class="btn-group" role="group" aria-label="Acciones">
    <a href="#" class="btn btn-warning btn-sm mr-1"
       data-id="{{ $cliente->id }}" 
       data-toggle="modal" 
       data-target="#editClienteModal" 
       title="Editar">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('admin.clientes.toggleStatus', $cliente->user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" 
            class="btn {{ $cliente->user->status ? 'btn-success' : 'btn-danger' }}">
            {!! $cliente->user->status
                ? '<i class="fa-solid fa-square-check"></i>'
                : '<i class="fa-solid fa-circle-xmark"></i>' !!}
        </button>
    </form>
</div>

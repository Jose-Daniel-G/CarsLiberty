{{-- button create --}}
<a class="btn btn-secondary" data-toggle="modal" data-target="#createClienteModal">Registrar
    <i class="bi bi-plus-circle-fill"></i>
</a>
{{-- button SHOW --}}
<a href="#" class="btn btn-primary" data-id="{{ $cliente->id }}" data-toggle="modal"
    data-target="#showClienteModal">
    <i class="fas fa-eye"></i>
</a>
{{-- button EDIT --}}
<a href="#" class="btn btn-warning btn-sm mr-1" data-id="{{ $cliente->id }}" data-toggle="modal"
    data-target="#editClienteModal" title="Editar">
    <i class="fas fa-edit"></i>
</a>

{{-- INCLUDE --}}
</table>
@include('admin.clientes.create')
@include('admin.clientes.edit')
@include('admin.clientes.show')

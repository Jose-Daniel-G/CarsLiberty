{{-- button create --}}
<a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar<i class="bi bi-plus-circle-fill"></i></a>
                                            {{-- button SHOW --}}
                                            <a href="#" class="btn btn-primary" data-id="{{ $cliente->id }}" data-toggle="modal" data-target="#showModal"> <i class="fas fa-eye"></i></a>
                                            {{-- button EDIT --}}
                                            <a href="#" class="btn btn-warning btn-sm mr-1" data-id="{{ $cliente->id }}" data-toggle="modal" data-target="#editModal" title="Editar"> <i class="fas fa-edit"></i></a>

{{-- INCLUDE --}}
</table>
@include('admin.clientes.create')
@include('admin.clientes.edit')
@include('admin.clientes.show')

dame esta modal con sus id="edit- y el jquery:
{{-- JAVASCRIPT --}}
$('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // botón que abre el modal
        var id = button.data('id'); // ID del curso
        var modal = $(this);

        var url = "{{ route('admin.cursos.edit', ':id') }}".replace(':id', id);
        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                // Cambiar la URL del form
                var formAction = "{{ route('admin.cursos.update', ':id') }}".replace(':id', data.id);
                modal.find('#editForm').attr('action', formAction);

                // Llenar los campos
                modal.find('#edit-nombre').val(data.nombre);
                //...
                //...
                //...
            },
            error: function(xhr) {
                console.error('Error al cargar los datos del curso:', xhr);
                       }
        });
    });
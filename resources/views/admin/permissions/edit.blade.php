<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="edit-nombre" class="form-label">Nombre</label>
                        <input type="text" id="edit-name" name="name"
                            class="form-control @error('edit-name') is-invalid @enderror"
                            value="{{ old('name', $permission->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

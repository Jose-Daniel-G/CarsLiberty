<!-- Modal de Edición -->
<div class="modal fade" id="editProfesorModal" tabindex="-1" role="dialog" aria-labelledby="editProfesorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfesorModalLabel">Editar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProfesorForm" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-nombres">Nombre del profesor </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="nombres" id="edit-nombres" required>
                                @error('nombres')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-apellidos">Apellidos </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="apellidos" id="edit-apellidos" required>
                                @error('apellidos')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-telefono">Telefono </label><b class="text-danger">*</b>
                                <input type="number" class="form-control" name="telefono" id="edit-telefono" required>
                                @error('telefono')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-email">Email </label><b class="text-danger">*</b>
                                <input type="email" class="form-control" name="email" id="edit-email" required>
                                @error('email')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-password">Contrasena </label><b class="text-danger">*</b>
                                <input type="password" class="form-control" name="password" id="edit-password" autocomplete="new-password" 
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-password_confirmation">Verificacion de contrasena </label><b
                                    class="text-danger">*</b>
                                <input type="password" class="form-control" name="password_confirmation" autocomplete="new-password" 
                                    id="edit-password_confirmation" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.profesores.index') }}" class="btn btn-secondary">
                                Cancelar<i class="fa-solid fa-plus"></i></a>
                            <button type="submit" class="btn btn-primary">Actualizar profesor</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
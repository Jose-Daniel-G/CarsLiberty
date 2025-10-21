<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Programador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-nombres">Nombres </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" id="edit-nombres" name="nombres" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-apellidos">Apellidos </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" id="edit-apellidos" name="apellidos" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-cc">CC </label><b class="text-danger">*</b>
                                <input type="number" class="form-control" id="edit-cc" name="cc" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-celular">Celular </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" id="edit-celular" name="celular" required>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit-fecha_nacimiento">Fecha de Nacimiento </label><b class="text-danger">*</b>
                                <input type="date" class="form-control" id="edit-fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="edit-direccion">Dirección </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" id="edit-direccion" name="direccion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit-email">Email</label><b class="text-danger">*</b>
                                <input type="email" class="form-control" id="edit-email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit-password">Contraseña</label>
                                <input type="password" class="form-control" id="edit-password" name="password">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit-password_confirmation">Verificación de contraseña</label>
                                <input type="password" class="form-control" id="edit-password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



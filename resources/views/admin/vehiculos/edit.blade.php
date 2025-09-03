<!-- Modal de Edición -->
<div class="modal fade" id="editVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="editVehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehiculoModalLabel">Editar Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- NOTA: el form no tiene action fija -->
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" required oninput="formatearPlaca(this)" maxlength="7">
                    </div>

                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>

                    <div class="form-group">
                        <label for="disponible">Disponible</label>
                        <select class="form-control" id="disponible" name="disponible">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo_selected">Tipo</label>
                        <select class="form-control" id="tipo_selected" name="tipo_selected"></select>
                    </div>

                    <div class="form-group">
                        <label for="profesor_select_edit">Profesor</label>
                        <select class="form-control" id="profesor_select_edit" name="profesor_id"></select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar vehículo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

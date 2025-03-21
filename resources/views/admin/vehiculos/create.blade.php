<!-- Modal de Edición -->
<div class="modal fade" id="createVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="createVehiculoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVehiculoModalLabel">Crear Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.vehiculos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" required
                            oninput="formatearPlaca(this)" maxlength="7">

                    </div>
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                    <div class="form-group">
                        <label for="disponible">Disponible</label>
                        <select class="form-control" id="disponible" name="disponible">
                            <option value="1" {{ $vehiculo->disponible ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$vehiculo->disponible ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipo_select">Tipo</label>
                        <select class="form-control" id="tipo_select" name="tipo" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="pickup">Pickup</option>
                            <option value="hatchback">Hatchback</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="profesor_select">Profesor</label>
                        <select class="form-control" id="profesor_select" name="profesor_id" required>
                            <option value="">Seleccione un profesor</option>
                            <!-- Opciones de profesores se llenarán mediante AJAX -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear vehículo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Detalle -->
<div class="modal fade" id="showVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="showVehiculoModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- un poco más ancho -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showVehiculoModalLabel">Detalles del Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Placa:</label>
                    <p id="show-placa"></p>
                </div>
                <div class="form-group">
                    <label>Modelo:</label>
                    <p id="show-modelo"></p>
                </div>
                <div class="form-group">
                    <label>Disponible:</label>
                    <p id="show-disponible"></p>
                </div>
                <div class="form-group">
                    <label>Tipo:</label>
                    <p id="show-tipo"></p>
                </div>
                <div class="form-group">
                    <label>Profesor:</label>
                    <p id="show-profesor"></p>
                </div>
                <!-- Agrega otros campos si los necesitas -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
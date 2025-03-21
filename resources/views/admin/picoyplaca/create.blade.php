<!-- Modal de Detalle -->
<div class="modal fade" id="createVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="createVehiculoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVehiculoModalLabel">Detalles del Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Crear Horario de Pico y Placa</h1>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.picoyplaca.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="dia">Día</label>
                        <input type="text" class="form-control" name="dia" required>
                    </div>
                    <div class="form-group">
                        <label for="horario">Horario</label>
                        <input type="text" class="form-control" name="horario" required>
                    </div>
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" name="placa" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
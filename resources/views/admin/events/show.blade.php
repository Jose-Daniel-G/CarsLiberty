<div class="modal fade" id="mdalSelected" tabindex="-1" aria-labelledby="mdalSelectedTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdalSelectedTitle">Detalles de la Reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- Usamos 'data-dismiss' para compatibilidad con Bootstrap 4 -->
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Agregué un formulario si en algún momento se necesita enviar datos, aunque por ahora parece solo mostrar información -->
                <form action="" method="POST" id="eventoForm">
                    <!-- Si se requiere token CSRF, incluirlo aquí -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Profesor</label>
                                <p id="nombres_teacher"> 
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cliente</label>
                                <p id="nombres_cliente"> 
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fecha_reserva1">Fecha de reserva</label>
                                <p id="fecha_reserva1"> 
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_inicio1">Hora de inicio</label>
                                <p id="hora_inicio1"> 
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_fin1">Hora fin</label>
                                <p id="hora_fin1"> 
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

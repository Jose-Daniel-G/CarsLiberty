<!-- Modal de Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <!-- Profesores -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-profesor">Profesor</label>
                                <select id="edit-profesor" name="profesor_id" class="form-control"></select>
                            </div>
                        </div>

                        <!-- Cursos -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-curso">Curso</label>
                                <select id="edit-curso" name="curso_id" class="form-control"></select>
                            </div>
                        </div>
                                                <!-- Día -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-dia">Día</label>
                                <input type="text" id="edit-dia" name="dia" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <!-- Hora inicio -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-hora_inicio">Hora Inicio</label>
                                <input type="time" id="edit-hora_inicio" name="hora_inicio" class="form-control">
                            </div>
                        </div>

                        <!-- Hora fin -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit-hora_fin">Hora Fin</label>
                                <input type="time" id="edit-hora_fin" name="hora_fin" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

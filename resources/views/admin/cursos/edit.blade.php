<!-- Modal de Edición -->
<div class="modal fade" id="editCursoModal" tabindex="-1" role="dialog" aria-labelledby="editCursoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCursoModalLabel">Editar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Le agregamos id="editForm" para que el ajax lo modifique -->
                <form id="editForm" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="edit-nombre">Nombre del curso </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                                @error('nombre')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit-descripcion">Descripción </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" id="edit-descripcion" name="descripcion"
                                    required>
                                @error('descripcion')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="edit-horas">Horas </label><b class="text-danger">*</b>
                                <input type="number" class="form-control" id="edit-horas" name="horas_requeridas"
                                    required>
                                @error('horas_requeridas')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="edit-estado">Estado </label>
                                <p id="edit-estado" name="estado" ></p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar curso</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

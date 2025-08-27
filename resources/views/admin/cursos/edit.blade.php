<!-- Modal de Edición -->
<div class="modal fade" id="editCursoModal" tabindex="-1" role="dialog" aria-labelledby="editCursoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCursoModalLabel">Crear Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cursos.update', $curso->id) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Nombre del curso </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="nombre"
                                    value="{{ $curso->nombre }}" required>
                                @error('nombre')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Descripcion </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="descripcion"
                                    value="{{ $curso->descripcion }}" required>
                                @error('descripcion')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="horas_requeridas">horas requeridas </label><b class="text-danger">*</b>
                                <input type="number" class="form-control" name="horas_requeridas"
                                    value="{{ $curso->horas_requeridas }}" required>
                                @error('horas_requeridas')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Estado </label><b class="text-danger">*</b>
                                <select name="estado" id="" class="form-control" name="estado">
                                    <!-- Opción por defecto -->
                                    <option value="" selected disabled>{{ $curso->estado == 'A' ? 'Activo' : 'Inactivo' }}</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                </select>
                                @error('estado')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar curso</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


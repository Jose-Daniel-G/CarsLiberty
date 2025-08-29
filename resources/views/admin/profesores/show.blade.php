<div class="modal fade" id="showProfesorModal" tabindex="-1" role="dialog" aria-labelledby="showProfesorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showProfesorModalLabel">Crear Profesor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.profesores.update', $profesor->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Nombre del profesor </label>
                                <p>{{ $profesor->nombres . ' ' . $profesor->apellidos }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono">Telefono </label>
                                <p>{{ $profesor->telefono }}</p>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Estado </label>
                                <!-- Opción por defecto -->
                                <p>{{ $profesor->estado == 'A' ? 'Activo' : 'Inactivo' }}</p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.profesores.index') }}" class="btn btn-secondary">
                                    Regresar
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

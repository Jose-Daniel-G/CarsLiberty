<!-- Modal de Show -->
<div class="modal fade" id="showClienteModal" tabindex="-1" role="dialog" aria-labelledby="showClienteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showClienteModalLabel">Mostrar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="h2">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Nombres </label>
                                        <p>{{ $cliente->nombres }}</p>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label>
                                        <p>{{ $cliente->apellidos }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cc">CC </label>
                                        <p>{{ $cliente->cc }}</p>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="celular">Celular </label>
                                        <p>{{ $cliente->celular }}</p>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="genero">Sexo </label>
                                        @if ($cliente->genero == 'M')
                                            'Masculino'
                                        @else
                                            'Femenino'
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="correo">Correo </label>
                                        <p>{{ $cliente->correo }}</p>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="direccion">Direccion </label>
                                        <p>{{ $cliente->direccion }}</p>

                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contacto_emergencia">Contacto Emergencia</label>
                                        <p>{{ $cliente->contacto_emergencia }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <p>{{ $cliente->observaciones }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

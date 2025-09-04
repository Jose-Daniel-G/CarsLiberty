<!-- Modal de Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Programador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('admin.secretarias.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombres">Nombres </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="nombres"  required>
                                @error('nombres')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellidos">Apellidos </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="apellidos" required>
                                @error('apellidos')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cc">CC </label><b class="text-danger">*</b>
                                <input type="number" class="form-control" name="cc"  required>
                                @error('cc')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular">Celular </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="celular"  required>
                                @error('celular')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento </label><b class="text-danger">*</b>
                                <input type="date" class="form-control" name="fecha_nacimiento" required>
                                @error('fecha_nacimiento')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="direccion">Direccion </label><b class="text-danger">*</b>
                                <input type="address" class="form-control" name="direccion" required>
                                @error('direccion')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="correo">Email</label><b class="text-danger">*</b>
                                <input type="email" class="form-control" name="correo" autocomplete="new-email" required>
                            </div>
                            @error('correo')
                                <small class="bg-danger text-white p-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Contrasena</label><b class="text-danger">*</b>
                                <input type="password" class="form-control" name="password" autocomplete="new-password" required>
                            </div>
                            @error('password')
                                <small class="bg-danger text-white p-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation">Verificacion de contrasena</label><b
                                    class="text-danger">*</b>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            @error('password_confirmation')
                                <small class="bg-danger text-white p-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <a class="btn btn-secondary">Cancelar{{-- <i class="fa-solid fa-plus"></i> --}}</a>
                            <button type="submit" class="btn btn-primary">Registrar usuario</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

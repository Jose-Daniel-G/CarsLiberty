<!-- Modal de Create -->
<div class="modal fade" id="createProfesorModal" tabindex="-1" role="dialog" aria-labelledby="createProfesorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProfesorModalLabel">Crear Profesor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.profesores.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombres">Nombre del profesor </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="nombres"
                                    value="{{ old('nombres') }}" required>
                                @error('nombres')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellidos">Apellidos </label><b class="text-danger">*</b>
                                <input type="text" class="form-control" name="apellidos"
                                    value="{{ old('apellidos') }}" required>
                                @error('apellidos')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Telefono </label><b class="text-danger">*</b>
                                <input type="number" class="form-control" name="telefono"
                                    value="{{ old('telefono') }}" required>
                                @error('telefono')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email </label><b class="text-danger">*</b>
                                <input type="email" class="form-control" name="email" autocomplete="new-email" required>
                                @error('email')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Contrasena </label><b class="text-danger">*</b>
                                <input type="password" class="form-control" name="password" autocomplete="new-password" required>
                                @error('password')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation">Verificacion de contrasena </label><b
                                    class="text-danger">*</b>
                                <input type="password" class="form-control" name="password_confirmation"  required>
                                @error('password_confirmation')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div class="row">
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-primary">Registrar profesores</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

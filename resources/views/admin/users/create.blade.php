<!-- Modal de Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="createModalLabel">Crear Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre del usuario </label><b>*</b>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <small class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label><b>*</b>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required>
                            </div>
                            @error('email')
                                <small class="bg-danger text-white p-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Contrasena</label><b>*</b>
                                <input type="password" class="form-control" name="password"
                                    value="{{ old('password') }}" required>
                            </div>
                            @error('password')
                                <small class="bg-danger text-white p-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_confirmation">Verificacion de contrasena</label><b>*</b>
                                <input type="password" class="form-control" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" required>
                            </div>
                            @error('password_confirmation')
                                <small class="bg-danger text-white p-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    Cancelar
                                    {{-- <i class="fa-solid fa-plus"></i> --}}
                                </a>
                                <button type="submit" class="btn btn-primary">Registrar usuario</button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

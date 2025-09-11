<!-- Modal de Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
               <h5 class="modal-title" id="createModalLabel">Crear {{ __('Role') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body"> 

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 row align-items-end">
                        <div class="col">
                            <label for="name" class="form-label">Nombre</label>
                            <input value="{{ old('name') }}" type="text" placeholder="Ingresa el nombre"
                                name="name" id="name" class="form-control">

                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Enviar
                            </button>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                        @foreach ($permissions as $permission)
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]"
                                        id="permission-{{ $permission->id }}"
                                        class="form-check-input"
                                        value="{{ $permission->name }}">
                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

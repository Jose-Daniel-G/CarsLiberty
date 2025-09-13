<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>¡Oops!</strong> Hubo algunos problemas con tus datos.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Nombre del rol</label>
                                <input type="text" name="name" id="edit-name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre del rol">
                               
                                @error('name')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            <label class="form-label">Permisos</label>

                            <div id="rolesContainer"></div>
                            {{-- <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="permission[]"
                                                id="permission-{{ $permission->id }}" class="form-check-input"
                                                value="{{ $permission->name }}"
                                                {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}

                            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                        </form>

            </div>
        </div>
    </div>
</div>

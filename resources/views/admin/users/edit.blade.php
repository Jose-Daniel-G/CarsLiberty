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
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>{{ session('info') }}</strong>
                    </div>
                @endif

                <h2 class="h5">Listado de Roles</h2>

                <!-- Formulario para actualizar roles -->
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <p class="h5">Nombre Completo:</p>
                    <input type="text" id="edit-name" class="form-control" name="name">
                    <p class="h5">Email:</p>
                    <input type="text" id="edit-email" class="form-control" name="email">
                    <div id="rolesContainer"></div>

                    {{-- @foreach ($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="roles[]"
                                        value="{{ $role->id }}" id="role_{{ $role->id }}"
                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach --}}
                    <button type="submit" class="btn btn-primary mt-3">Asignar rol</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal de Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Configuracion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.config.store') }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <div class="image-wrapper">

                                    <img id="picture"
                                        src="{{ isset($config->logo) ? asset('storage/' . $config->logo) : 'https://cdn.pixabay.com/photo/2020/03/27/13/02/venice-4973502_1280.jpg' }}"
                                        alt="" style="cursor:pointer; max-width:90%; height:auto;">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="file" name="logo" id="file" class="form-control-file"
                                    accept=".jpg, .jpeg, .png" accept="image/*" style="display: none;">
                            </div>
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">Nombre del sitio</label>
                                <input type="text" class="form-control" name="site_name"
                                    value="{{ old('site_name') }}" required>
                                @error('site_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                    required>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="number" class="form-control" name="phone" value="{{ old('telefono') }}"
                                    required>
                                @error('telefono')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_contact">Correo de contacto</label>
                                <input type="email" class="form-control" name="email_contact"
                                    value="{{ old('email_contact') }}" required>
                                @error('email_contact')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.config.index') }}" class="btn btn-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">Registrar configuracion</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@section('js')
    <script>
        // Obtén los elementos
        const picture = document.getElementById('picture');
        const fileInput = document.getElementById('file');

        // Al hacer clic en la imagen, simula un clic en el input file
        picture.addEventListener('click', () => {
            fileInput.click();
        });
        // Cambiar la imagen mostrada cuando se selecciona un archivo
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = (event) => {
                // Actualiza la imagen con la nueva seleccionada
                picture.src = event.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@stop

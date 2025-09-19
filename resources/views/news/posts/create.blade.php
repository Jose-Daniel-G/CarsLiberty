<!-- Modal de Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nueva Noticia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-message></x-message>{{-- JD  resources/views/components --}}
                    <div class="row">
                        <div class="col-lg-5 col-xlg-5 col-md-5">
                            <label for="foto">
                                <img class="card-img border" id="img_preview" src="{{ asset('images/portada_noticia.png') }}" alt="Card image">
                            </label>
                            <input id="foto" name="foto" type="file" accept="image/*" style="display: none;" />
                            @error('foto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="text-muted p-t-30 db">Social Profile</small>

                            <br>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                        </div>
                        <div class="col-lg-7 col-xlg-7 col-md-7">
                            <div class="form-group">
                                <label class="control-label" for="title">Notice<span class="required">*</span></label>
                                <input class="form-control" id="title" name="title" type="text" placeholder="Titulo" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripción <span class="required">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Descripción de la Noticia" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Category<span class="required">*</span></label>
                                <select name="category" class="form-control selectpicker" id="categoria"
                                    name="categoria">
                                    <option value="">Seleccione ...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <button id="btnActionForm" class="btn btn-primary mt-3" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                    <span id="btnText" title="Crear Noticia">Guardar</span></button>
                            </div>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

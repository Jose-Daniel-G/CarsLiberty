<div class="modal fade" id="modal-{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Noticia</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 border">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset($post->image->url) }}" class="mt-2 rounded img-fluid" />
                                <p>
                                    <input type="checkbox" name="option" id="me_gusta">
                                    <label for="me_gusta">
                                        <span class="fa-stack">
                                            <i class="fa fa-thumbs-up fa-stack-1x"></i>
                                        </span>
                                    </label>
                                    <b id="n_likes">0</b> Me gusta
                                </p>
                            </div>
                            <div class="col-md-7">
                                <h4>{{ $post->title }}</h4>
                                <p>{{ $post->body }}</p>
                                <div class="rating" id="rating_number">
                                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form id="form_comment">
                            <div class="input-group">
                                <input type="text" class="form-control" name="comentario" id="comentario"
                                       placeholder="Realice un comentario">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="far fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="border rounded mt-3" id="comentar">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
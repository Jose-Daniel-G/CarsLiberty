<!-- Modal BUSCAR -->
<div class="modal fade" id="modal-{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document" style="max-width: 80%;">

        <div class="modal-content">
            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Noticia</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 border">
                        <div class="row">
                            <div class="col-5">
                                <img src="{{ asset($post->image->url) }}" class="mt-2 rounded" width="178"
                                    height="178" />
                                <p><input type="checkbox" name="option" id="me_gusta">
                                    <label for="check1">
                                        <span class="fa-stack">
                                            <i class="fa fa-thumbs-up fa-stack-1x"></i>
                                        </span>
                                    </label>
                                    <b id="n_likes"> 0</b> Me gusta
                                </p>
                            </div>
                            <div class="col-7">
                                <div class="row" style="height: 80%;">
                                    <div class="col">
                                        <h4 id="titulo_notice">{{ $post->title }}</h4>
                                        <p class="">{{ $post->body }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="rating" id="rating_number">
                                            <input type="radio" name="rating" value="5" id="5"><label
                                                for="5">☆</label>
                                            <input type="radio" name="rating" value="4" id="4"><label
                                                for="4">☆</label>
                                            <input type="radio" name="rating" value="3" id="3"><label
                                                for="3">☆</label>
                                            <input type="radio" name="rating" value="2" id="2"><label
                                                for="2">☆</label>
                                            <input type="radio" name="rating" value="1" id="1"><label
                                                for="1">☆</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col">
                                <form id="form_comment">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="comentario" id="comentario"
                                            placeholder="Realice un comentario">
                                        <div class="input-group-prepend ">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="far fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="border rounded" id="comentar">
                                    <!-- <p><b>${res.usuario} : </b>${res.comentarios}</b> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

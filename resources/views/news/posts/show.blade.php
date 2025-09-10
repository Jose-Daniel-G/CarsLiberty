@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>

    <div class="container-fluid">

        <div class="border flex-md-row mb-4 box-shadow h-md-250 pb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-2 bg-body-tertiary justify-content-end border-bottom">
                    <li class="breadcrumb-item">
                        <a class="link-body-emphasis" href="/">
                            <i class="fa-solid fa-house"></i>
                            <span class="visually-hidden">Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="link-body-emphasis fw-semibold text-decoration-none" href="#">Noticia</a>
                    </li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">
                        Data
                    </li> --}}
                </ol>
            </nav>
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Detalles de la noticia</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-xlg-5 col-md-5">
                        <img class="card-img" src="{{ asset($post->image->url) }}" height="456" alt="Card image">
                        <small class="text-muted p-t-30 db">Social Profile</small>

                        <br>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                    </div>
                    <div class="col-lg-3 col-xlg-3 col-md-3">
                        <h3>{{ $post->title }}</h3>

                        <p>{{ $post->body }}</p>
                        <br>

                    </div>
                    <div class="col-lg-4 col-xlg-4 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-inline">
                                    <li class="list-inline-item">Elemento 1</li>
                                    <li class="list-inline-item">Elemento 2</li>
                                    <li class="list-inline-item">Elemento 3</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        @if (Route::has('login'))
                                            @auth
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="comentario" id="comentario"
                                                        placeholder="Realice un comentario" aria-label="Input group example"
                                                        aria-describedby="btnGroupAddon">
                                                    <div class="input-group-prepend ">
                                                        <button class="btn btn-primary" id="btnGroupAddon" type="submit">
                                                            <i class="far fa-paper-plane"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>
                                            @else
                                                <h2>Comentarios</h2>
                                            @endauth
                                        @endif

                                        <div class="sl-item">
                                            <div class="sl-left">
                                                <img src="{{ asset($post->image->url) }}" width="50" alt="user"
                                                    class="rounded-circle">
                                                <a href="javascript:void(0)" class="link">John Doe</a>
                                                {{-- <span class="sl-date">5 minutes ago</span> --}}

                                            </div>
                                            <div class="sl-right">


                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 m-b-20">
                                                        <p>Type your note, and hit enter to add it </p>

                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-1 m-b-20">
                                                        <div class="" id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <h3 class="accordion-header" id="flush-headingOne">
                                                                    <a class="accordion-button collapsed" type="button"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseOne"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapseOne">
                                                                        2 comment
                                                                    </a>

                                                                </h3>


                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 m-b-20">
                                                        <a href="javascript:void(0)" class="link m-r-10"><i
                                                                class="fa fa-heart text-danger"></i> 5 Love</a>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                            aria-labelledby="flush-headingOne"
                                                            data-bs-parent="#accordionFlushExample">
                                                            {{-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block "> --}}
                                                            @auth
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="comentario"
                                                                        id="comentario" placeholder="Realice un comentario"
                                                                        aria-label="Input group example"
                                                                        aria-describedby="btnGroupAddon">
                                                                    <div class="input-group-prepend ">
                                                                        <button class="btn btn-primary" id="btnGroupAddon"
                                                                            type="submit">
                                                                            <i class="far fa-paper-plane"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                            @else
                                                                <div class="accordion-body">Placeholder content for this
                                                                    accordion, which is intended to demonstrate the
                                                                    <code>.accordion-flush</code> class. This is the
                                                                    first item's accordion body.
                                                                </div>
                                                            @endauth
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="vr"></div> --}}
                                            <hr>
                                            <div class="sl-item">

                                                <div class="sl-left">
                                                    <img src="{{ asset('images/users/2.jpg') }}" width="50"
                                                        alt="user" class="rounded-circle">
                                                    <a href="javascript:void(0)" class="link">John Doe</a>
                                                    <span class="sl-date">5 minutes ago</span>
                                                </div>
                                                <div class="sl-right">
                                                    <div>
                                                        <p>Ando desarrollando</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Dashboard')
{{-- @section('plugins.Sweetalert2', true) --}}
@section('css')
    <style>
        .rating {
            display: flex;
            margin-top: -10px;
            flex-direction: row-reverse;
            margin-left: -4px;
            float: left;
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 19px;
            font-size: 25px;
            color: #ff0000;
            cursor: pointer;
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>
@stop
@section('content_header')
    <h1>Springfield News</h1>
@stop
@section('content')
    <div class="container-fluid">

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-sm-2 mx-auto">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group border border-primary" style="height: 170px;">
                                <img src="{{ $post->image->url }}" class="card-img-top mx-auto d-block" alt="..."
                                    style="height: 200px; object-fit: cover;" alt="...">
                            </li>
                            <li class="list-group-item" style="height: 70px;">
                                <h6 class="card-title">{{ $post->title }}</h6>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-{{ $post->id }}">Ver Noticia</button>
                            </li>
                        </ul>
                    </div>
                </div>
                @include('news.posts.show') <!-- Modal BUSCAR -->
            @endforeach
        </div>
    </div>
@stop

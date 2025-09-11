@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Detalles de la noticia</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Contact Details</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>
                        Create New</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <img class="card-img" src="{{ asset('images/background/socialbg.jpg') }}" height="456"
                        alt="Card image">
                    <div
                        class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center text-center">
                        <div class="align-self-center">
                            <img src="{{ asset('images/users/1.jpg') }}" class="bd-placeholder-img rounded-circle"
                                width="100">
                            <h4 class="card-title">James Anderson</h4>
                            <h6 class="card-subtitle">@jamesandre</h6>
                            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <small class="text-muted">Email address</small>
                        <h6>hannagover@gmail.com</h6>
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6>+91 654 784 547</h6>
                        <small class="text-muted p-t-30 db">Address</small>
                        <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                        <div class="map-box">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                                width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                        </div>
                        <small class="text-muted p-t-30 db">Social Profile</small>
                        <br>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>


                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card-body">
                                <div class="profiletimeline">
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('images/users/1.jpg') }}" width="50" alt="user"
                                                class="rounded-circle">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="javascript:void(0)" class="link">John Doe</a>
                                                <span class="sl-date">5 minutes ago</span>
                                                <p>assign a new task <a href="javascript:void(0)"> Design
                                                        weblayout</a></p>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="{{ asset('images/big/img1.jpg') }}"
                                                            class="img-responsive rounded-1" width="200">
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="{{ asset('images/big/img2.jpg') }}"
                                                            class="img-responsive rounded-1" width="200">
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="{{ asset('images/big/img3.jpg') }}"
                                                            class="img-responsive rounded-1" width="200">
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="{{ asset('images/big/img4.jpg') }}"
                                                            class="img-responsive rounded-1" width="200">
                                                    </div>
                                                </div>
                                                <div class="like-comm">
                                                    <a href="javascript:void(0)" class="link m-r-10">2
                                                        comment</a>
                                                    <a href="javascript:void(0)" class="link m-r-10"><i
                                                            class="fa fa-heart text-danger"></i> 5 Love</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('images/users/2.jpg') }}" width="50" alt="user"
                                                class="rounded-circle">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="javascript:void(0)" class="link">John Doe</a>
                                                <span class="sl-date">5 minutes ago</span>

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

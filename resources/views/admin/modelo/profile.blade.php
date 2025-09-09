@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Col izquierda con imagen -->
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                alt="{{ Auth::user()->name }}">
                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                            <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Col derecha con formulario -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Settings -->
                                <div class="active tab-pane" id="settings">
                                    <form action="{{ route('user.profile.update') }}" method="POST"
                                        enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        @method('PUT')

                                        <!-- Photo -->
                                        <div class="form-group row">
                                            <label for="photo" class="col-sm-2 col-form-label">Profile Photo</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="photo" id="photo" class="form-control">
                                                @error('photo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Name -->
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name', Auth::user()->name) }}" class="form-control"
                                                    required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" id="email"
                                                    value="{{ old('email', Auth::user()->email) }}" class="form-control"
                                                    required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @if (!Auth::user()->hasVerifiedEmail())
                                                    <small class="text-warning">Your email is unverified. <a
                                                            href="{{ route('verification.send') }}">Resend verification
                                                            email</a></small>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop

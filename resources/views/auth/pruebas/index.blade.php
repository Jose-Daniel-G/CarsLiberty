@extends('adminlte::page')

@section('title', 'DeveloTech')

@section('content_header')
    <h1>Crear Nueva Categoría</h1>
@stop

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card card-outline card-primary">
                    <img class="card-img" src="{{ asset('img/socialbg.jpg') }}" alt="Card image" width="50px">
                    <div class="card-img-overlay card-inverse social-profile d-flex">
                        <div class="align-self-center">
                            <img src="{{ asset('img/1.jpg') }}" class="img-circle" width="100" alt="users">
                            <h4 class="card-title">James Anderson</h4>
                            <h6 class="card-subtitle">@jamesandre</h6>
                            <p class="text-white">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <small class="text-muted">Email address </small>
                        <h6>hannagover@gmail.com</h6>
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6>+91 654 784 547</h6>
                        <small class="text-muted p-t-30 db">Address</small>
                        <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                        <div class="map-box">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                                width="100%" height="150" style="border: 0" allowfullscreen=""></iframe>
                        </div>
                        <small class="text-muted p-t-30 db">Social Profile</small>
                        <br>
                        <button class="btn btn-circle btn-secondary">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-circle btn-secondary">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-circle btn-secondary">
                            <i class="fab fa-youtube"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card-body">
                                <div class="profiletimeline">
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('img/juan.jpg') }}" alt="user" class="img-circle"
                                                width="50px">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="#" class="link">John Doe</a>
                                                <span class="sl-date">5 minutes ago</span>
                                                <p>
                                                    assign a new task
                                                    <a href="#"> Design weblayout</a>
                                                </p>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="" class="img-responsive radius" alt="big">
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="" class="img-responsive radius" alt="big">
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="" class="img-responsive radius" alt="big">
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 m-b-20">
                                                        <img src="" class="img-responsive radius" alt="big">
                                                    </div>
                                                </div>
                                                <div class="like-comm">
                                                    <a href="javascript:void(0)" class="link m-r-10">2
                                                        comment</a>
                                                    <a href="javascript:void(0)" class="link m-r-10"><i
                                                            class="fa fa-heart text-danger"></i> 5
                                                        Love</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('img/jose.jpg') }}" alt="user" class="img-circle"
                                                width="50px">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="#" class="link">John Doe</a>
                                                <span class="sl-date">5 minutes ago</span>
                                                <div class="m-t-20 row">
                                                    <div class="col-md-3 col-xs-12">
                                                        <img src="" alt="user" class="img-responsive radius">
                                                    </div>
                                                    <div class="col-md-9 col-xs-12">
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Integer nec odio. Praesent
                                                            libero. Sed cursus ante dapibus diam.
                                                        </p>
                                                        <a href="#" class="btn btn-success">
                                                            Design weblayout</a>
                                                    </div>
                                                </div>
                                                <div class="like-comm m-t-20">
                                                    <a href="javascript:void(0)" class="link m-r-10">2
                                                        comment</a>
                                                    <a href="javascript:void(0)" class="link m-r-10"><i
                                                            class="fa fa-heart text-danger"></i> 5
                                                        Love</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('img/team-1.jpg') }}" alt="user" class="img-circle" width="50px">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="#" class="link">John Doe</a>
                                                <span class="sl-date">5 minutes ago</span>
                                                <p class="m-t-10">
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Integer nec odio. Praesent
                                                    libero. Sed cursus ante dapibus diam. Sed nisi.
                                                    Nulla quis sem at nibh elementum imperdiet. Duis
                                                    sagittis ipsum. Praesent mauris. Fusce nec
                                                    tellus sed augue semper
                                                </p>
                                            </div>
                                            <div class="like-comm m-t-20">
                                                <a href="javascript:void(0)" class="link m-r-10">2
                                                    comment</a>
                                                <a href="javascript:void(0)" class="link m-r-10"><i
                                                        class="fa fa-heart text-danger"></i> 5
                                                    Love</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('img/team-2.jpg') }}" alt="user" class="img-circle" width="50px">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="#" class="link">John Doe</a>
                                                <span class="sl-date">5 minutes ago</span>
                                                <blockquote class="m-t-10">
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit, sed do eiusmod tempor
                                                    incididunt
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--second tab-->
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">Johnathan Deo</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">(123) 456 7890</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">johnathan@admin.com</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <strong>Location</strong>
                                        <br>
                                        <p class="text-muted">London</p>
                                    </div>
                                </div>
                                <hr>
                                <p class="m-t-30">
                                    Donec pede justo, fringilla vel, aliquet nec, vulputate
                                    eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                                    venenatis vitae, justo. Nullam dictum felis eu pede
                                    mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                    elementum semper nisi. Aenean vulputate eleifend tellus.
                                    Aenean leo ligula, porttitor eu, consequat vitae,
                                    eleifend ac, enim.
                                </p>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book. It has
                                    survived not only five centuries
                                </p>
                                <p>
                                    It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and
                                    more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                                <h4 class="font-medium m-t-30">Skill Set</h4>
                                <hr>
                                <h5 class="m-t-30">
                                    Wordpress <span class="pull-right">80%</span>
                                </h5>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 80%; height: 6px">
                                        <span class="sr-only">50% Complete</span>
                                    </div>
                                </div>
                                <h5 class="m-t-30">
                                    HTML 5 <span class="pull-right">90%</span>
                                </h5>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 90%; height: 6px">
                                        <span class="sr-only">50% Complete</span>
                                    </div>
                                </div>
                                <h5 class="m-t-30">
                                    jQuery <span class="pull-right">50%</span>
                                </h5>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 50%; height: 6px">
                                        <span class="sr-only">50% Complete</span>
                                    </div>
                                </div>
                                <h5 class="m-t-30">
                                    Photoshop <span class="pull-right">70%</span>
                                </h5>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 70%; height: 6px">
                                        <span class="sr-only">50% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Johnathan Doe"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="johnathan@admin.com"
                                                class="form-control form-control-line" name="example-email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="password"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="123 456 7890"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Message</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line">
                                                <option>London</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Canada</option>
                                                <option>Thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">
                                                Update Profile
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    {{-- <div class="right-sidebar ps-container ps-theme-default" data-ps-id="625e7055-e728-8a61-a8ae-d4c559e94f37">
                <div class="slimscrollright">
                    <div class="rpanel-title">
                        Service Panel
                        <span><i class="ti-close right-side-toggle"></i></span>
                    </div>
                    <div class="r-panel-body">
                        <ul id="themecolors" class="m-t-20">
                            <li><b>With Light sidebar</b></li>
                            <li>
                                <a href="javascript:void(0)" data-theme="default" class="default-theme">1</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="green" class="green-theme">2</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="red" class="red-theme">3</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a>
                            </li>
                            <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                            <li>
                                <a href="javascript:void(0)" data-theme="default-dark"
                                    class="default-dark-theme working">7</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme">12</a>
                            </li>
                        </ul>
                        <ul class="m-t-20 chatonline">
                            <li><b>Chat option</b></li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Varun Dhavan
                                        <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Genelia Deshmukh
                                        <small class="text-warning">Away</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Ritesh Deshmukh
                                        <small class="text-danger">Busy</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Arijit Sinh
                                        <small class="text-muted">Offline</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Govinda Star
                                        <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>John Abraham<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Hritik Roshan<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="" alt="user-img"
                                        class="img-circle">
                                    <span>Pwandeep rajan
                                        <small class="text-success">online</small></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                    <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                    <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            --}}
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->



@stop

@section('js')

    </script>
@endsection

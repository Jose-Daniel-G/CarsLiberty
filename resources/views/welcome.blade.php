
<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" height="50" width="200" alt="{{ config('app.name', 'Laravel') }}">
                </span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 ms-auto mb-2 ">
                        @auth
                        <a href="{{ url('/home') }}" class="btn btn-outline-success">Home</a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-success">Log in</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main>

        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                @foreach ($posts as $post)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <img src="{{ $post->url }}" class="d-block w-100" alt="Post Image">

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <p><a class="btn btn-lg btn-primary" href="{{ route('posts.show', $post) }}">Ver Noticia</a></p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>

        <div class="ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96714.68291250926!2d-74.05953969406828!3d40.75468158321536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2588f046ee661%3A0xa0b3281fcecc08c!2sManhattan%2C%20Nowy%20Jork%2C%20Stany%20Zjednoczone!5e0!3m2!1spl!2spl!4v1672242259543!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

<!-- FOOTER -->
<footer class="mt-auto bg-dark text-white-50 text-center py-3">
    <div class="row footer-info">
        <div class="col-md-4 col-sm-12 footer-info-grid links">
            <h4>ENLACES RÁPIDOS</h4>
            <ul class="list-unstyled">
                <li><a href="#about">Acerca</a></li>
                <li><a href="#features">Características</a></li>
                <li><a href="#skills">Habilidades</a></li>
                <li><a href="#team">Equipo</a></li>
                <li><a href="#">Inicio</a></li>
            </ul>
        </div>
        <div class="col-md-4 col-sm-12 footer-info-grid address">
            <h4>Dirección</h4>
            <address>
                <ul class="list-unstyled">
                    <li>TEQUENDAMA</li>
                    <li>Cali, Valle</li>
                    <li>Colombia</li>
                    <li>Teléfono: +57 (314) 707-2792</li>
                    <li>Email: <a class="text-white" href="mailto:jose.dgo97@gmail.com">info@jose.dgo97@gmail.com</a></li>
                </ul>
            </address>
        </div>
        <div class="col-md-4 col-sm-12 footer-info-grid email">
            <h4>Boletín</h4>
            <p>Suscríbase a nuestro boletín y le informaremos sobre los proyectos y promociones más recientes.</p>
            <form class="newsletter d-flex">
                <input class="form-control form-control-sm me-2" type="email" placeholder="Tu email...">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="fas fa-envelope"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="text-center mt-4">
        <p>&copy; <?= date("Y"); ?> Empresa. Todos los derechos reservados | Diseño por Aunar Developers</p>
    </div>
</footer>

    </main>
@endsection

@section('scripts')

@endsection

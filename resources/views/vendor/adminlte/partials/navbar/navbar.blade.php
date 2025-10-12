<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')
        {{-- 🔔 Notificaciones --}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if (auth()->user()->unreadNotifications->count())
                    <span class="badge badge-warning navbar-badge">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    {{ auth()->user()->unreadNotifications->count() }} Notificaciones
                </span>
                <div class="dropdown-divider"></div>

                @foreach (auth()->user()->unreadNotifications->take(5) as $notification)
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $notification->data['title'] ?? 'Nueva notificación' }}
                        <span class="float-right text-muted text-sm">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach

                <a href="{{ route('admin.notifications.index') }}" class="dropdown-item dropdown-footer">
                    Ver todas
                </a>
            </div>
        </li>
        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>

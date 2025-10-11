<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Liberty',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Liberty</b>LTE',
    'logo_img' => 'vendor/adminlte/dist/img/HEBRON.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'JDeveloper',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Hebron.png',
            'alt' => 'Auth Logo',
            'class' => 'brand-image img-circle elevation-3', // 'class' => '',// JD
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/HEBRON.png',
            'alt' => 'HEBRON',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    // 'use_route_url' => false,
    // 'dashboard_url' => '/admin',
    // 'logout_url' => 'logout',
    // 'login_url' => 'login',
    // 'register_url' => false,//'register',
    // 'password_reset_url' => 'forgot-password',
    // 'password_email_url' => 'password/email',
    // 'profile_url' => false,

    'use_route_url' => true,
    'dashboard_url' => 'admin.index',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false, //'register',
    'password_reset_url' => 'forgot-password',
    'password_email_url' => 'password.email',
    // 'password_reset_url' => 'forgot-password',
    // 'password_email_url' => 'password/email',
    'profile_url' => false,
    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [

        [
            'text'  => 'Dashboard',
            'route' => 'admin.home',
            'icon'  => 'fas fa-home fa-fw ',
        ],
        [
            'text'        => 'Gestión de Asistencias',
            'icon' => 'fas fa-fw fa-user',
            'label' => 'waiting',
            'label_color' => 'light',
            // 'can'  => 'admin.asistencias.index',
            'submenu' => [
                [
                    'text' => 'Registrar Asistencia',
                    'icon'        => 'far fa-circle nav-icon',
                    'label' => '?',
                    'label_color' => 'light',
                    'route' => 'admin.asistencias.index',
                    'can' => 'admin.asistencias.index',
                ],
                [
                    'text' => 'Listado de Inacistencias',
                    'icon'        => 'far fa-circle nav-icon',
                    'label' => '?',
                    'label_color' => 'light',
                    'route' => 'admin.secretarias.inasistencias',
                    'can' => 'admin.asistencias.inasistencias',
                ],

            ],
        ],


        ['header' => 'ADMINISTRADOR', 'can' => 'admin.secretarias.index',],
        [
            'text' => 'Programador',
            'icon' => 'fas fa-laptop',
            // 'label_color' => 'warning',
            'can' => 'admin.secretarias.index',
            'submenu' => [
                // ['text' => 'Creacion de programador','icon' => 'far fa-circle nav-icon','route' => 'admin.secretarias.create',],
                [
                    'text' => 'Listado de programador',
                    'icon' => 'far fa-circle nav-icon',
                    'route' => 'admin.secretarias.index',
                ],

            ],
        ],
        [
            'text' => 'Clientes',
            'icon' => 'fas fa-users mr-2',
            'can' => 'admin.clientes.index',
            'submenu' => [
                // ['text' => 'Creacion de clientes','icon'=> 'far fa-circle nav-icon','route' => 'admin.clientes.create',],
                [
                    'text' => 'Listado de clientes',
                    'icon' => 'far fa-circle nav-icon',
                    'route' => 'admin.clientes.index',
                ],

            ],
        ],
        [
            'text' => 'Cursos',
            'icon' => 'fas fa-book',
            // 'label' => 'check cr activo',
            // 'label_color' => 'primary',
            'can' => 'admin.cursos.index',
            'submenu' => [
                // ['text' => 'Creacion de cursos','icon'=> 'far fa-circle nav-icon','route' => 'admin.cursos.create', ],
                [
                    'text' => 'Listado de cursos',
                    'icon'        => 'far fa-circle nav-icon',
                    'route' => 'admin.cursos.index',
                ],

            ],
        ],
        [
            'text' => 'Profesores',
            'icon' => 'fa-solid fa-chalkboard-user',
            'can' => 'admin.profesores.index',
            'submenu' => [
                // ['text' => 'Creacion de profesores','icon' => 'far fa-circle nav-icon','route' => 'admin.profesores.create', ],
                [
                    'text'  => 'Listado de profesores',
                    'icon'  => 'far fa-circle nav-icon',
                    'route' => 'admin.profesores.index',
                ],
                // [ 'text'  => 'Reportes',  'icon'  => 'far fa-circle nav-icon', 'route' => 'admin.profesores.reportes', ],
            ],
        ],
        [
            'text' => 'Horarios',
            'icon' => 'fas fa-calendar-alt',
            'can' => 'admin.horarios.index',
            'submenu' => [
                [
                    'text' => 'Creacion de horarios',
                    'icon'        => 'far fa-circle nav-icon',
                    'route' => 'admin.horarios.create',
                ],
                [
                    'text' => 'Listado de horarios',
                    'icon'        => 'far fa-circle nav-icon',
                    'route' => 'admin.horarios.index',
                ],

            ],
        ],
        [
            'text' => 'Vehiculos',
            'icon' => 'bi bi-car-front',
            'can'  => 'admin.vehiculos.index',
            'submenu' => [
                [
                    'text' => 'vehiculos',
                    'icon'        => 'far fa-circle nav-icon',
                    'route'  => 'admin.vehiculos.index',
                ],
                [
                    'text' => 'Picoyplaca',
                    'icon'        => 'far fa-circle nav-icon',
                    'route' => 'admin.picoyplaca.index',
                ],
            ],
        ],
        [
            'text' => 'Configuraciones',
            'icon' => 'bi bi-gear',
            'can'  => 'admin.config.index',
            'submenu' => [
                [
                    'text'        => 'Usuarios',
                    'route'         => 'admin.users.index',
                    'icon' => 'fas fa-users fa-fw ',
                    'permissions'  => 'admin.users.index',
                ],
                [
                    'text'        => 'permisos',
                    'route'         => 'admin.permissions.index',
                    'icon' => 'fas fa-key fa-fw ',
                    'permissions'  => 'admin.users.index',
                ],
                [
                    'text'        => 'roles',
                    'route'         => 'admin.roles.index',
                    'icon' => 'fa-solid fa-address-book',
                    'permissions'  => 'admin.roles.index',
                ],
                [
                    'text' => 'Configuracion',
                    'icon' => 'fa-solid fa-gears',
                    'route' => 'admin.config.index',
                ],
            ],

        ],
        [
            'text' => 'News-post',
            'icon' => 'fa-regular fa-circle-question',
            'can'  => 'admin.config.index',
            'submenu' => [
                [
                    'text'  => 'Categorias',
                    'route' => 'categories.index',
                    'icon'  => 'fa-solid fa-layer-group',
                ],
                [
                    'text'  => 'Posts',
                    'route' => 'posts.index',
                    'icon'  => 'nav-icon fas fa-copy',
                ],
                [
                    'text'  => 'VER NOTICIAS/POSTS',
                    'route' => 'home',
                    'icon'  => 'fa-solid fa-newspaper',
                ],
            ],
        ]
        // ['text'=> 'Agenda','route' => 'admin.users.index','icon' => 'fas fa-envelope',],
        // ['text' => 'information','icon_color' => 'cyan','url' => '#', ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'FontAwesome' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
                ],
            ],
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                // 1. CORE - DataTables base (PRIMERO)
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js'],

                // 2. LIBRERÍAS NECESARIAS (jszip, pdfmake)
                ['type' => 'js','asset' => true,'location' => '//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js'],

                // 3. BUTTONS (después de jszip y pdfmake)
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js'],

                // 4. RESPONSIVE (opcional)
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js'],
                ['type' => 'js','asset' => true,'location' => '//cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js'],

                // 5. CSS (al final)
                ['type' => 'css','asset' => true,'location' => '//cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css'],
                ['type' => 'css','asset' => true,'location' => '//cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css'],
                ['type' => 'css','asset' => true,'location' => '//cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css'],
                ['type' => 'css','asset' => true,'location' => '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'toastr' => [ //it isnt working
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];

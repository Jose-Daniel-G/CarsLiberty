<?php

use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\PostController;

use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Twilio\Rest\Client;
use App\Models\User;

// Route::post('/message', [HomeController::class, 'message_landing_page'])->name('message.landing_page');
// Route::get('/adminz', [HomeController::class, 'show'])->name('admin.home.show');

// /**  LANDING  **/Route::get('/', function () {return Auth::check() ? app(HomeController::class)->index() : view('welcome'); });

// // Cambia tu ruta '/' por esta:
// Route::get('/', function () {
//     return Auth::check() ? redirect()->route('admin.home') : view('welcome');
// });

// /** DASHBOARD **/Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');});// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});
// /** REGISTER  **/Route::get('/register', function () {return redirect('/');});

// //RUTAS HORARIOS ADMIN
// Route::resource('/admin/horarios', HorarioController::class)->names('admin.horarios');
// Route::get('/admin/horarios/curso/{id}', [HorarioController::class, 'show_datos_cursos'])->name('admin.horarios.show_datos_cursos');

// Route::resource('categories',CategoriesController::class)->names('categories');
// Route::resource('posts', PostController::class)->names('posts');
// Route::get('home', function(){  $posts = Post::with(['category', 'image'])->latest()->get(); return view('home', compact('posts'));})->name('home');

// Route::middleware(['auth'])->group(function () { // Es para leer las notificaciones de los posts creados por otros
//     Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
//     Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
// });

// Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
// Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
// // Route::post('/historial/registrar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'registrarCursoCompletado']);
// // Route::get('/historial/completar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'completarCurso']);
// // Route::get('/historial/listar/{clienteId}', [HistorialCursoController::class, 'listarCursosCompletados']);
// // Route::get('/admin/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes');


//---------------New code ---------------------------------------------------------------------

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        // Redirección inteligente: si es admin al dashboard, si no al home público o perfil
        return Auth::user()->hasRole('admin')
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
    return view('welcome');
});

Route::post('/message', [HomeController::class, 'message_landing_page'])->name('message.landing_page');

Route::get('/home', function () {
    $posts = Post::with(['category', 'image'])->latest()->get();
    return view('home', compact('posts'));
})->name('home');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Panel de Administración y Usuario)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', config('jetstream.auth_session')])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

// 1. Redirección de la raíz del prefijo (/admin)
    // Usamos una función anónima más limpia
    Route::get('/', function () {
        return Auth::user()->hasRole('admin')
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    });

    // 2. Rutas Administrativas
    // Sugerencia: Si usas Spatie, podrías añadir ->middleware('role:admin') a este dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Recursos
    Route::resource('horarios', HorarioController::class);
    Route::get('horarios/curso/{id}', [HorarioController::class, 'show_datos_cursos'])->name('horarios.show_datos_cursos');

    Route::resource('categories', CategoriesController::class);
    Route::resource('posts', PostController::class);

    // Notificaciones
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // 3. Rutas Compartidas (Ej: Citas)
    // Aquí es importante que en el CitaController filtres los datos según el rol
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

    // AQUÍ DEBES DEFINIR LA RUTA DE PERFIL SI LA VAS A USAR:
    // Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});

/*
|--------------------------------------------------------------------------
| Rutas de Utilidad
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return redirect('/');
});

// TEST: Protege esto para que solo el admin vea los usuarios
Route::get('/test-user', function () {
    return (Auth::check() && Auth::user()->hasRole('admin')) ? User::all() : abort(403);
});
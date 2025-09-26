<?php

use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\PostController;

use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\NotificationController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostNotification;

// Auth::routes(['register'=>false]); // Route::get('/', function () {return view('welcome');}); // Route::get('/', function () {return view('auth.login');});

Route::post('/message', [HomeController::class, 'message_landing_page'])->name('message.landing_page');

/** LANDPAGE  **/Route::get('/landpage', function () {return Auth::check() ? app(HomeController::class)->index() : view('template.index'); });
/** LOGIN     **/Route::get('/', function () {return Auth::check() ? app(HomeController::class)->index() : view('auth.login'); });
/** REGISTER  **/Route::get('/register', function () {return redirect('/');});
/** DASHBOARD **/Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');});// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});

//RUTAS HORARIOS ADMIN
Route::get('/admin/show/{id}', [HomeController::class, 'show'])->name('admin.reservas.show');
Route::resource('/admin/horarios', HorarioController::class)->names('admin.horarios');
Route::get('/admin/horarios/curso/{id}', [HorarioController::class, 'show_datos_cursos'])->name('admin.horarios.show_datos_cursos');

Route::resource('categories',CategoriesController::class)->names('categories');
Route::resource('posts', PostController::class)->names('posts');
Route::get('home', function(){  $posts = Post::with(['category', 'image'])->latest()->get(); return view('home', compact('posts'));})->name('home');

Route::middleware(['auth'])->group(function () { // Es para leer las notificaciones de los posts creados por otros
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});


// Route::post('/historial/registrar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'registrarCursoCompletado']);
// Route::get('/historial/completar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'completarCurso']);
// Route::get('/historial/listar/{clienteId}', [HistorialCursoController::class, 'listarCursosCompletados']);
// Route::get('/admin/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes');


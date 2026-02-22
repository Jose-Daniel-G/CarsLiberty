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

Route::post('/message', [HomeController::class, 'message_landing_page'])->name('message.landing_page');
Route::get('/adminz', [HomeController::class, 'show'])->name('admin.home.show');

// /**  LANDING  **/Route::get('/', function () {return Auth::check() ? app(HomeController::class)->index() : view('welcome'); });

// // Cambia tu ruta '/' por esta:
// Route::get('/', function () {
//     return Auth::check() ? redirect()->route('admin.home') : view('welcome');
// });

// Cambia tu ruta '/' por una simple redirección si ya están logueados
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.home');
    }
    return view('welcome');
});

Route::get('/test-user', function () {
    return User::all();
});

/** DASHBOARD **/Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');});// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});
/** REGISTER  **/Route::get('/register', function () {return redirect('/');});

//RUTAS HORARIOS ADMIN
Route::resource('/admin/horarios', HorarioController::class)->names('admin.horarios');
Route::get('/admin/horarios/curso/{id}', [HorarioController::class, 'show_datos_cursos'])->name('admin.horarios.show_datos_cursos');

Route::resource('categories',CategoriesController::class)->names('categories');
Route::resource('posts', PostController::class)->names('posts');
Route::get('home', function(){  $posts = Post::with(['category', 'image'])->latest()->get(); return view('home', compact('posts'));})->name('home');

Route::middleware(['auth'])->group(function () { // Es para leer las notificaciones de los posts creados por otros
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
// Route::post('/historial/registrar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'registrarCursoCompletado']);
// Route::get('/historial/completar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'completarCurso']);
// Route::get('/historial/listar/{clienteId}', [HistorialCursoController::class, 'listarCursosCompletados']);
// Route::get('/admin/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes');

Route::get('/test-whatsapp', function () {
    $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

    $message = $twilio->messages->create(
        'whatsapp:+573147072792', // tu número en formato internacional
        [
            'from' => env('TWILIO_WHATSAPP_FROM'),
            'body' => '🚗 Hola! Tu cita ha sido agendada para el 25 de octubre a las 3:00 PM.'
        ]
    );

    return $message;
});
Route::get('/test-whatsapp-tokens', function () {
    dd([
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from' => env('TWILIO_WHATSAPP_FROM')
    ]);
});
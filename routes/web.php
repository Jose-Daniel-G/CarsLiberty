<?php

use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\PostController;

use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\HorarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Auth::routes(['register'=>false]); // Route::get('/', function () {return view('welcome');}); // Route::get('/', function () {return view('auth.login');});

/** LOGIN     **/Route::get('/', function () {return Auth::check() ? app(HomeController::class)->index() : view('auth.login'); });
/** REGISTER  **/Route::get('/register', function () {return redirect('/');});
/** DASHBOARD **/Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');});// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});

//RUTAS HORARIOS ADMIN
Route::get('/admin/horarios/show_reserva_profesores', [HomeController::class, 'show_reserva_profesores'])->name('admin.horarios.show_reserva_profesores');
Route::get('/admin/show/{id}', [HomeController::class, 'show'])->name('admin.reservas.show');
Route::resource('/admin/horarios', HorarioController::class)->names('admin.horarios');
Route::get('/admin/horarios/curso/{id}', [HorarioController::class, 'show_datos_cursos'])->name('admin.horarios.show_datos_cursos');

Route::resource('categories',CategoriesController::class)->names('categories');
Route::resource('posts', PostController::class)->names('posts');


// Route::post('/historial/registrar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'registrarCursoCompletado']);
// Route::get('/historial/completar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'completarCurso']);
// Route::get('/historial/listar/{clienteId}', [HistorialCursoController::class, 'listarCursosCompletados']);
// Route::get('/admin/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes');


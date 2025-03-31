<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\HistorialCursoController;
use App\Http\Controllers\HorarioController;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Auth::routes(['register'=>false]);
// Route::get('/', function () {return view('welcome');});
// Route::get('/', function () {return view('auth.login');});
## 1 Rutas Públicas
Route::get('/', function () {
     return Auth::check() ? app(HomeController::class)->index() : view('auth.login');
 });
 

Route::get('/register', function () {return redirect('/');});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
     Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');
});
// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});

//RUTAS HORARIOS ADMIN
Route::get('/admin/horarios/show_reserva_profesores', [HomeController::class, 'show_reserva_profesores'])
     ->name('admin.horarios.show_reserva_profesores');
Route::resource('/admin/horarios', HorarioController::class)->names('admin.horarios')->middleware('auth', 'can:admin.horarios')->middleware('auth', 'can:show_datos_cursos');


Route::get('/admin/show/{id}', [HomeController::class, 'show'])->name('admin.reservas.show')->middleware('auth', 'can:admin.show_reservas');
Route::get('/admin/horarios/curso/{id}', [HorarioController::class, 'show_datos_cursos'])->name('admin.horarios.show_datos_cursos')->middleware('auth');
// Route::get('/admin/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes');

// CHATGPT
Route::middleware('auth')->group(function () {
     // Rutas para profesores
     Route::post('/admin/asistencia/registrar', [AsistenciaController::class, 'store'])->name('admin.asistencias.store'); //Registrar Asistencia
     Route::get('/admin/profesor/asistencia', [AsistenciaController::class, 'index'])->name('admin.asistencias.index');

     // Rutas para secretarias
     Route::get('/admin/secretaria/inasistencias', [AsistenciaController::class, 'show'])->name('admin.secretarias.inasistencias'); //Listado de Inacistencias
     Route::post('/admin/asistencia/habilitar/{id}', [AsistenciaController::class, 'habilitarCliente'])->name('asistencia.habilitar');
});

Route::post('/historial/registrar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'registrarCursoCompletado']);
Route::get('/historial/completar/{clienteId}/{cursoId}', [HistorialCursoController::class, 'completarCurso']);
Route::get('/historial/listar/{clienteId}', [HistorialCursoController::class, 'listarCursosCompletados']);

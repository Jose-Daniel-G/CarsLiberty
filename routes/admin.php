<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PicoyplacaController;

// Route::get("/", [HomeController::class, "index"])->name("admin.home")->middleware('can:admin.home');
//RUTAS TOGGLE ACTIVATE / DEACTIVATE
Route::patch('/clientes/{id}/toggle-status', [ClienteController::class, 'toggleStatus'])->name('admin.clientes.toggleStatus');
Route::patch('/programador/{id}/toggle-status', [SecretariaController::class, 'toggleStatus'])->name('admin.secretarias.toggleStatus');
Route::patch('/profesor/{id}/toggle-status', [ProfesorController::class, 'toggleStatus'])->name('admin.profesors.toggleStatus');
Route::patch('/curso/{id}/toggle-status', [CursoController::class, 'toggleStatus'])->name('admin.cursos.toggleStatus');

//RUTAS ADMIN
Route::get('/admin', [HomeController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/show_reservas/{id}', [HomeController::class, 'show_reservas'])->name('admin.show_reservas')->middleware('auth', 'can:admin.show_reservas');

//RUTAS CONFIGURACIONES
Route::resource('/config', ConfigController::class)->names('admin.config')->middleware('auth', 'can:admin.config');
/** CONFIG PROFILE  **/
Route::get('/user/profile', [UserProfileController::class, 'index'])->name('admin.profile.index');
Route::put('/user/profile-information', [UserProfileController::class, 'update'])->name('admin.user-profile-information.update');
Route::put('/user/profile-password', [UserProfileController::class, 'updatePassword'])->name('admin.user-profile-password.updatePassword');

// Rutas para profesores
Route::get('/admin/profesor/asistencia', [AsistenciaController::class, 'index'])->name('admin.asistencias.index');
Route::post('/admin/asistencia/registrar', [AsistenciaController::class, 'store'])->name('admin.asistencias.store');

// Rutas para secretarias
Route::get('/admin/secretaria/inasistencias', [AsistenciaController::class, 'show'])->name('admin.secretarias.inasistencias');
Route::post('/admin/asistencia/habilitar/{id}', [AsistenciaController::class, 'habilitarCliente'])->name('asistencia.habilitar');

//RUTAS SECRETARIAS
Route::resource('/secretarias', SecretariaController::class)->names('admin.secretarias');

// RUTAS PROFESORES (->parameters) para usar profesores en ves de profesore 
Route::resource('/profesores', ProfesorController::class)->names('admin.profesores')->parameters(['profesores' => 'profesor']);

//RUTAS CLIENTES
Route::resource('/clientes', ClienteController::class)->names('admin.clientes')->middleware('auth', 'can:admin.clientes');

//RUTAS CURSOS
Route::get('/cursos/completados', [CursoController::class, 'completados'])->name('admin.cursos.completados');
Route::resource('/cursos', CursoController::class)->names('admin.cursos')->middleware('auth', 'can:admin.cursos');

//RUTAS PARA LOS EVENTOS / CLASES
Route::resource('/eventos', EventController::class)->names('admin.events');

//RUTAS para desplegar select
Route::get('/admin/profesores/evente/{cursoId}', [ProfesorController::class, 'obtenerProfesores'])->name('obtenerProfesores');
Route::get('/admin/cursos/evente/{clienteId}', [CursoController::class, 'obtenerCursos'])->name('obtenerCursos');

//RUTAS PARA LOS VEHICULOS
Route::resource('vehiculos', VehiculoController::class)->names('admin.vehiculos');
Route::resource('picoyplaca', PicoyplacaController::class)->names('admin.picoyplaca');
Route::put('/picoyplaca', [PicoyPlacaController::class, 'update'])->name('picoyplaca.update');

Route::middleware('auth')->group(function () {
    //PERMISIONS ROUTE
    Route::get('/permissions',        [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/permissions',        [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('/permissions/{id}',  [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
    //ROLES ROUTES
    Route::resource('roles', RoleController::class)->names('admin.roles');
    //USERS ROUTES
    Route::resource('/users', UserController::class)->names('admin.users');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
});



















// //RUTAS REPORTES PROFESORES ADMIN
// /*NO INCLUDO */
// Route::get('/profesores/pdf/{id}', [ProfesorController::class, 'reportes'])->name('admin.profesores.pdf');
// /*NO INCLUDO */
// Route::get('/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes')->middleware('auth', 'can:admin.profesores.reportes');

// //RUTAS para las reservas
// /*NO INCLUDO */
// Route::get('/reservas/reportes', [EventController::class, 'reportes'])->name('admin.reservas.reportes')->middleware('auth', 'can:admin.reservas.reportes');
// /*NO INCLUDO */
// Route::get('/reservas/pdf/{id}', [EventController::class, 'pdf'])->name('admin.reservas.pdf')->middleware('auth', 'can:admin.reservas.pdf');
// /*NO INCLUDO */
// Route::get('/reservas/pdf_fechas', [EventController::class, 'pdf_fechas'])->name('admin.reservas.pdf_fechas')->middleware('auth', 'can:admin.event.pdf_fechas');

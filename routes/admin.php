<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PicoyPlacaController;

// // Route::get("/", [HomeController::class, "index"])->name("home")->middleware('can:home');
// //RUTAS TOGGLE ACTIVATE / DEACTIVATE
// Route::patch('/clientes/{id}/toggle-status', [ClienteController::class, 'toggleStatus'])->name('clientes.toggleStatus');
// Route::patch('/programador/{id}/toggle-status', [SecretariaController::class, 'toggleStatus'])->name('secretarias.toggleStatus');
// Route::patch('/profesor/{id}/toggle-status', [ProfesorController::class, 'toggleStatus'])->name('profesors.toggleStatus');
// Route::patch('/curso/{id}/toggle-status', [CursoController::class, 'toggleStatus'])->name('cursos.toggleStatus');

// //RUTAS ADMIN

// //RUTAS HOME
// Route::get('/admin', [HomeController::class, 'index'])->name('index')->middleware('auth');

// //esta ruta es para los profesore ver quien tiene una reserva con el
// Route::get('/show_reservas/{id}', [HomeController::class, 'show_reservas'])->name('show_reservas');

// Route::get('/admin/horarios/show_reserva_profesores', [HomeController::class, 'show_reserva_profesores']) //Esta ruta es para los estudiantes
//                                                         ->name('horarios.show_reserva_profesores'); //ver reservas tiene

// //RUTAS CONFIGURACIONES
// Route::resource('/config', ConfigController::class)->names('config')->middleware('auth', 'can:config');
// /** CONFIG PROFILE  **/
// Route::get('/user/profile', [UserProfileController::class, 'index'])->name('profile.index');
// Route::put('/user/profile-information', [UserProfileController::class, 'update'])->name('user-profile-information.update');
// Route::put('/user/profile-password', [UserProfileController::class, 'updatePassword'])->name('user-profile-password.updatePassword');

// // Rutas para profesores
// Route::get('/admin/profesor/asistencia', [AsistenciaController::class, 'index'])->name('asistencias.index');
// Route::post('/admin/asistencia/registrar', [AsistenciaController::class, 'store'])->name('asistencias.store');

// // Rutas para secretarias
// Route::get('/admin/secretaria/inasistencias', [AsistenciaController::class, 'show'])->name('secretarias.inasistencias');
// Route::post('/admin/asistencia/habilitar/{id}', [AsistenciaController::class, 'habilitarCliente'])->name('asistencia.habilitar');

// //RUTAS SECRETARIAS
// Route::resource('/secretarias', SecretariaController::class)->names('secretarias');

// // RUTAS PROFESORES (->parameters) para usar profesores en ves de profesore
// Route::resource('/profesores', ProfesorController::class)->names('profesores')->parameters(['profesores' => 'profesor']);

// //RUTAS CLIENTES
// Route::resource('/clientes', ClienteController::class)->names('clientes')->middleware('auth', 'can:clientes');

// //RUTAS CURSOS
// Route::get('/cursos/completados', [CursoController::class, 'completados'])->name('cursos.completados');
// Route::resource('/cursos', CursoController::class)->names('cursos')->middleware('auth', 'can:cursos');

// //RUTAS PARA LOS EVENTOS / CLASES
// Route::resource('/agendas', AgendaController::class)->names('agendas');

// //RUTAS para desplegar select
// Route::get('/admin/profesores/evente/{cursoId}', [ProfesorController::class, 'obtenerProfesores'])->name('obtenerProfesores');
// Route::get('/admin/cursos/evente/{clienteId}', [CursoController::class, 'obtenerCursos'])->name('obtenerCursos');

// //RUTAS PARA LOS VEHICULOS
// Route::resource('vehiculos', VehiculoController::class)->names('vehiculos');
// Route::resource('picoyplaca', PicoyPlacaController::class)->names('picoyplaca');
// // Route::put('/picoyplaca', [PicoyPlacaController::class, 'update'])->name('picoyplaca.update');

// Route::middleware('auth')->group(function () {
//     //PERMISIONS ROUTE
//     Route::get('/permissions',        [PermissionController::class, 'index'])->name('permissions.index');
//     Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
//     Route::post('/permissions',        [PermissionController::class, 'store'])->name('permissions.store');
//     Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
//     Route::put('/permissions/{id}',  [PermissionController::class, 'update'])->name('permissions.update');
//     Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
//     //ROLES ROUTES
//     Route::resource('roles', RoleController::class)->names('roles');
//     //USERS ROUTES
//     Route::resource('/users', UserController::class)->names('users');
//     Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
// });

// --- GRUPO PROTEGIDO POR AUTH ---
Route::middleware(['auth'])->group(function () {

    // --- HOME & DASHBOARD ---
    // Asegúrate de que el nombre coincida con tus redirecciones (admin.home)
    // Route::get('/admin', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/show_reservas/{id}', [HomeController::class, 'show_reservas'])->name('show_reservas');
    Route::get('/admin/horarios/show_reserva_profesores', [HomeController::class, 'show_reserva_profesores'])->name('horarios.show_reserva_profesores');

    // --- TOGGLE STATUS ---
    Route::patch('/clientes/{id}/toggle-status', [ClienteController::class, 'toggleStatus'])->name('clientes.toggleStatus');
    Route::patch('/programador/{id}/toggle-status', [SecretariaController::class, 'toggleStatus'])->name('secretarias.toggleStatus');
    Route::patch('/profesor/{id}/toggle-status', [ProfesorController::class, 'toggleStatus'])->name('profesors.toggleStatus');
    Route::patch('/curso/{id}/toggle-status', [CursoController::class, 'toggleStatus'])->name('cursos.toggleStatus');

    // --- RECURSOS PROTEGIDOS POR PERMISOS (Spatie) ---
    // Usamos los nombres exactos que definiste en tu RoleSeeder
    Route::resource('/config', ConfigController::class)->names('config')->middleware('can:admin.config.index');
    Route::resource('/clientes', ClienteController::class)->names('clientes')->middleware('can:admin.clientes.index');
    Route::resource('/cursos', CursoController::class)->names('cursos')->middleware('can:admin.cursos.index');

    // --- OTROS RECURSOS ---
    Route::resource('/secretarias', SecretariaController::class)->names('secretarias');
    Route::resource('/profesores', ProfesorController::class)->names('profesores')->parameters(['profesores' => 'profesor']);
    Route::resource('/agendas', AgendaController::class)->names('agendas');
    Route::resource('vehiculos', VehiculoController::class)->names('vehiculos');
    Route::resource('picoyplaca', PicoyPlacaController::class)->names('picoyplaca');

    // --- PERFIL DE USUARIO ---
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::put('/user/profile-information', [UserProfileController::class, 'update'])->name('user-profile-information.update');
    Route::put('/user/profile-password', [UserProfileController::class, 'updatePassword'])->name('user-profile-password.updatePassword');

    // --- ASISTENCIAS ---
    Route::get('/admin/profesor/asistencia', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::post('/admin/asistencia/registrar', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::get('/admin/secretaria/inasistencias', [AsistenciaController::class, 'show'])->name('secretarias.inasistencias');
    Route::post('/admin/asistencia/habilitar/{id}', [AsistenciaController::class, 'habilitarCliente'])->name('asistencia.habilitar');

    // --- SELECTS DINÁMICOS ---
    Route::get('/admin/profesores/evente/{cursoId}', [ProfesorController::class, 'obtenerProfesores'])->name('obtenerProfesores');
    Route::get('/admin/cursos/evente/{clienteId}', [CursoController::class, 'obtenerCursos'])->name('obtenerCursos');

    // --- ADMINISTRACIÓN DE ACCESOS (Roles/Permissions/Users) ---
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('/users', UserController::class)->names('users');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

    // Permissions (Manual para tener control total)
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});




// //RUTAS REPORTES PROFESORES ADMIN
// /*NO INCLUDO */
// Route::get('/profesores/pdf/{id}', [ProfesorController::class, 'reportes'])->name('profesores.pdf');
// /*NO INCLUDO */
// Route::get('/profesores/reportes', [ProfesorController::class, 'reportes'])->name('profesores.reportes')->middleware('auth', 'can:profesores.reportes');

// //RUTAS para las reservas
// /*NO INCLUDO */
// Route::get('/reservas/reportes', [AgendaController::class, 'reportes'])->name('reservas.reportes')->middleware('auth', 'can:reservas.reportes');
// /*NO INCLUDO */
// Route::get('/reservas/pdf/{id}', [AgendaController::class, 'pdf'])->name('reservas.pdf')->middleware('auth', 'can:reservas.pdf');
// /*NO INCLUDO */
// Route::get('/reservas/pdf_fechas', [AgendaController::class, 'pdf_fechas'])->name('reservas.pdf_fechas')->middleware('auth', 'can:event.pdf_fechas');

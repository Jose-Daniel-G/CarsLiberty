<?php

namespace App\Http\Controllers\Admin;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Event as CalendarEvent;  // Usa un alias para el modelo Event
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('can:admin.show_reservas')->only('show');
    }
    public function index()
    {
        $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_clientes = Cliente::count();
        // $total_cursos = Curso::count();
        $total_cursos = Curso::count();
        $total_profesores = Profesor::count();
        $total_horarios = Horario::count();
        $total_eventos = CalendarEvent::count();
        $total_configuraciones = Config::count();
        // $total_completados = Config::count();

        $profesores = Profesor::all();
        $events = CalendarEvent::all(); // dd(Auth::user()->getRoleNames());

        if (Auth::user()->hasRole('espectador')) {
            $posts = Post::with(['category', 'image'])
                ->latest()
                ->get();

                // dd($posts);
            return view('home', compact('posts'));
        }
        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria') || Auth::user()->hasRole('profesor')) {
            $cursos = Curso::all();
            $clientes = Cliente::all();


            $profesorSelect = DB::table('profesors')
                ->join('horario_profesor_curso', 'horario_profesor_curso.profesor_id', '=', 'profesors.id')
                ->join('horarios', 'horario_profesor_curso.horario_id', '=', 'horarios.id')
                ->join('cursos', 'horario_profesor_curso.curso_id', '=', 'cursos.id') // Usamos la tabla intermedia
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->join('clientes', 'cliente_curso.cliente_id', '=', 'clientes.id')
                ->join('users', 'clientes.user_id', '=', 'users.id')
                ->select(
                    'profesors.id',
                    'profesors.nombres',
                    'profesors.apellidos',
                    DB::raw('GROUP_CONCAT(DISTINCT cursos.nombre ORDER BY cursos.nombre SEPARATOR ", ") as cursos')
                )
                ->groupBy('profesors.id', 'profesors.nombres', 'profesors.apellidos')
                ->limit(100)
                ->get();

            $role = 'admin'; // Asegúrate de tener un campo 'role'

            return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'total_eventos', 'cursos', 'profesores', 'profesorSelect', 'clientes', 'events', 'total_configuraciones', 'role'));
        } else {
            $cliente = Cliente::where('user_id', Auth::id())->first();
            \Log::info('cliente', [$cliente]);
            $cursos = $cliente?->cursos ?? collect();


            $profesorSelect = DB::table('profesors')
                ->join('horario_profesor_curso', 'horario_profesor_curso.profesor_id', '=', 'profesors.id')
                ->join('horarios', 'horario_profesor_curso.horario_id', '=', 'horarios.id')
                ->join('cursos', 'horario_profesor_curso.curso_id', '=', 'cursos.id') // Usamos la tabla intermedia
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->join('clientes', 'cliente_curso.cliente_id', '=', 'clientes.id')
                ->join('users', 'clientes.user_id', '=', 'users.id')
                ->where('users.id', Auth::id())
                ->select(
                    'profesors.id',
                    'profesors.nombres',
                    'profesors.apellidos',
                    DB::raw('GROUP_CONCAT(DISTINCT cursos.nombre ORDER BY cursos.nombre SEPARATOR ", ") as cursos')
                )
                ->groupBy('profesors.id', 'profesors.nombres', 'profesors.apellidos')
                ->limit(100)
                ->get();

            return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'total_eventos', 'cursos', 'profesorSelect', 'events', 'total_configuraciones'));
        }
    }
    public function show($id) //show_reservas
    {
        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
            $events = CalendarEvent::with('cliente')->get(); // $events = CalendarEvent::all();
        } else {
            $events = CalendarEvent::where('cliente_id',  Auth::user()->cliente->id)->get();
        }
        return view('admin.reservas.show', compact('events'));
    }

    public function show_reserva_profesores() //calendar
    {
        try {
            // Verifica si el usuario autenticado es un administrador
            if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
                // Obtener todos los eventos del profesor específico
                $events = CalendarEvent::with(['profesor', 'cliente'])->get();
                return response()->json($events);
            } else {

                $events = CalendarEvent::with(['profesor', 'cliente'])
                    ->join('users as profesores', 'profesores.id', '=', 'events.profesor_id')
                    ->join('clientes', 'clientes.id', '=', 'events.cliente_id')
                    ->join('users as clientes_users', 'clientes.user_id', '=', 'clientes_users.id')
                    ->where('clientes.user_id', Auth::id())
                    ->select('events.*')
                    ->get();

                return response()->json($events);
            }
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error: ' . $exception->getMessage()]);
        }
    }
}

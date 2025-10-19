<?php

namespace App\Http\Controllers\Admin;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Agenda;  // Usa un alias para el modelo Agenda
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Post;
use App\Models\Vehiculo;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['message_landing_page']); // Aplica el middleware 'auth' a todos los métodos excepto 'landing_page' 
        // $this->middleware('can:admin.show_reservas')->only('show');
    }

    public function index()
    {
        $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_clientes = Cliente::count();
        $total_vehiculos = Vehiculo::count();

        $total_profesores = Profesor::count();
        $total_horarios = Horario::count();
        $total_agendas = Agenda::count();
        $total_configuraciones = Config::count();
        $total_cursos = Curso::count();

        $profesores = Profesor::all();
        $agendas = Agenda::all();

        if (Auth::user()->hasRole('espectador')) {
            $posts = Post::with(['category', 'image'])->latest()->get();
            return view('home', compact('posts'));
        }

        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria') || Auth::user()->hasRole('profesor')) {

            $data = $this->handleStaffDashboard();
            extract($data);

            $role = 'admin';

            return view('admin.index', compact('total_usuarios', 'total_cursos', 'total_vehiculos', 'total_secretarias', 'total_clientes', 'total_profesores', 'total_horarios', 'total_agendas', 'cursosDisponibles', 'profesores', 'profesorSelect', 'clientes', 'agendas', 'total_configuraciones', 'role'));
        } else {
            $clienteId = Auth::user()->cliente->id;
            $cursos = Auth::user()->cliente->cursos;
            $data = $this->handleClientRole($clienteId);
            extract($data);

            return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'total_agendas', 'cursos', 'profesorSelect', 'agendas', 'cursosDisponibles', 'total_configuraciones'));
        }
    }

    public function show() // show_reservas
    {
        $user = Auth::user();

        // Precarga relaciones solo si es necesario
        $agendas = $user->hasAnyRole(['superAdmin', 'admin', 'secretaria'])
            ? Agenda::with(['cliente.user'])->get()
            : Agenda::with(['cliente.user'])
            ->where('cliente_id', $user->cliente->id)
            ->get();

        return view('admin.home.show', compact('agendas'));
    }


    public function show_reserva_profesores() //calendar
    {
        try {
            // Verifica si el usuario autenticado es un administrador
            if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
                // Obtener todos los agendas del profesor específico
                $agendas = Agenda::with(['profesor', 'cliente'])->get();
                return response()->json($agendas);
            } else {

                $agendas = Agenda::with(['profesor', 'cliente'])
                    ->join('users as profesores', 'profesores.id', '=', 'agendas.profesor_id')
                    ->join('clientes', 'clientes.id', '=', 'agendas.cliente_id')
                    ->join('users as clientes_users', 'clientes.user_id', '=', 'clientes_users.id')
                    ->where('clientes.user_id', Auth::id())
                    ->select('agendas.*')
                    ->get();

                return response()->json($agendas);
            }
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error: ' . $exception->getMessage()]);
        }
    }

    public function message_landing_page(Request $request)
    {
        $valid[] = $request->validate([
            'title'   => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'message' => 'required',
        ]);

        // para depuración
        // dd($valid);

        Notification::route('mail', 'destino@tudominio.com')->notify(
            new PostNotification($request->title, $request->email, $request->phone, $request->message)
        );
        // new PostNotification($valid[]));

        return back()->with('success', '✅ Tu mensaje fue enviado correctamente.');
    }
    private function handleStaffDashboard()
    {
        $cursosDisponibles = Curso::all();
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
        return [
            'profesorSelect'   => $profesorSelect,
            'cursosDisponibles' => $cursosDisponibles,
            'clientes' => $clientes,
        ];
    }
    private function handleClientRole($clienteId)
    {
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

        $total_cursos = DB::table('cliente_curso')
            ->join('cursos', 'cliente_curso.curso_id', '=', 'cursos.id')
            ->where('cliente_curso.cliente_id', $clienteId)
            ->whereColumn('cliente_curso.horas_realizadas', '>=', 'cursos.horas_requeridas')
            ->count();

        if ($clienteId) {
            $cursosDisponibles = Curso::whereHas('clientes', function ($q) use ($clienteId) {    // Obtenemos cursos del cliente que aún no están completados
                $q->where('cliente_id', $clienteId)
                    ->whereColumn('cliente_curso.horas_realizadas', '<', 'cursos.horas_requeridas');
            })->get();
        } else {
            $cursosDisponibles = Curso::all();
        }
        return [
            'profesorSelect'   => $profesorSelect,
            'total_cursos'     => $total_cursos,
            'cursosDisponibles' => $cursosDisponibles,
        ];
    }
}

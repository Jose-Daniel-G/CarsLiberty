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


// 1. Agrega (Request $request) para poder leer lo que envía JS
public function show_reserva_profesores(Request $request) 
{
    try {
        // Capturamos el ID que viene de FullCalendar (extraParams)
        $profesorId = $request->query('profesor_id');

        $query = Agenda::with(['profesor', 'cliente']);

        // Si el usuario es administrativo
        if (Auth::user()->hasAnyRole(['superAdmin', 'admin', 'secretaria'])) {
            
            // Si seleccionó un profesor, filtramos por él. Si no, traemos todo.
            if ($profesorId) {
                $query->where('profesor_id', $profesorId);
            }
            
            $agendas = $query->get();

        } else {
            // SI ES UN ESTUDIANTE:
            // Queremos ver las mías (en verde) Y las de otros (en azul/gris) del profesor seleccionado
            if (!$profesorId) {
                return response()->json([]); // Si no hay profesor seleccionado, no mostramos nada
            }

            $agendas = $query->where('profesor_id', $profesorId)->get();
        }

        // --- FORMATEO PARA FULLCALENDAR ---
        // Esto es vital para que se pinten los colores que quieres
        $eventos = $agendas->map(function ($agenda) {
            $es_mio = $agenda->cliente->user_id == Auth::id();

            return [
                'id' => $agenda->id,
                'title' => $es_mio ? "Mi Clase" : "Ocupado",
                'start' => $agenda->start, // Asegúrate de que sean objetos Carbon o strings ISO
                'end' => $agenda->end,
                'backgroundColor' => $es_mio ? '#28a745' : '#007bff', // Verde mío, Azul otros
                'borderColor' => $es_mio ? '#1e7e34' : '#0062cc',
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'profesor' => $agenda->profesor,
                    'cliente' => $es_mio ? $agenda->cliente : ['nombres' => 'No disponible'],
                    'es_mio' => $es_mio
                ]
            ];
        });

        return response()->json($eventos);

    } catch (\Exception $exception) {
        return response()->json(['mensaje' => 'Error: ' . $exception->getMessage()], 500);
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

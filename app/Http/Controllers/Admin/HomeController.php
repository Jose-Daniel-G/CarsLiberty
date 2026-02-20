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
use Illuminate\Support\Facades\Log;
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
        $t_usuarios = User::count();
        $t_secretarias = Secretaria::count();
        $t_clientes = Cliente::count();
        $t_vehiculos = Vehiculo::count();

        $t_profesores = Profesor::count();
        $t_horarios = Horario::count();
        $t_agendas = Agenda::count();
        $t_configuraciones = Config::count();
        $t_cursos = Curso::count();

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

            return view('admin.index', compact('t_usuarios', 't_cursos', 't_vehiculos', 't_secretarias', 't_clientes', 't_profesores', 't_horarios', 't_agendas', 'cursosDisponibles', 'profesores', 'profesorSelect', 'clientes', 'agendas', 't_configuraciones', 'role'));
        } else {
            $clienteId = Auth::user()->cliente->id;
            $cursos = Auth::user()->cliente->cursos;
            $data = $this->handleClientRole($clienteId);
            extract($data);

            return view('admin.index', compact('t_usuarios', 't_secretarias', 't_clientes', 't_cursos', 't_profesores', 't_horarios', 't_agendas', 'cursos', 'profesorSelect', 'agendas', 'cursosDisponibles', 't_configuraciones'));
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
    public function show_reserva_profesores(Request $request, $id = null)
    {
        try {
            $user = Auth::user();
            $profesorId = $id ?? $request->query('profesor_id');
            $eventos = [];

            // 1. DETERMINAR QUÉ AGENDAS BUSCAR
            if ($profesorId) {
                // 1. Cargamos al profesor con sus horarios Y los cursos asociados a esos horarios
                $profesor = Profesor::with(['horarios.cursos'])->find($profesorId);

                // 2. Traemos las agendas (Eventos Rojos)
                $agendas = Agenda::with(['profesor.user', 'cliente.user', 'curso'])
                    ->where('profesor_id', $profesorId)
                    ->get();

                $dias_map = ['LUNES' => [1], 'MARTES' => [2], 'MIERCOLES' => [3], 'JUEVES' => [4], 'VIERNES' => [5], 'SABADO' => [6], 'DOMINGO' => [0]];


                // 3. Mapeo de Disponibilidad (Eventos Verdes)
                foreach ($profesor->horarios as $h) {
                    // Buscamos el curso asociado a este profesor y este horario específico
                    // a través de la relación que definiste en el modelo
                    $cursoAsociado = $profesor->cursos()
                        ->wherePivot('horario_id', $h->id)
                        ->first();

                    $nombreCurso = $cursoAsociado ? $cursoAsociado->nombre : 'Clase';

                    $eventos[] = [
                        'daysOfWeek' => $dias_map[strtoupper($h->dia)] ?? [],
                        'startTime' => date('H:i:s', strtotime($h->hora_inicio)),
                        'endTime' => date('H:i:s', strtotime($h->tiempo)),
                        'display' => 'background',
                        'color' => '#d4edda',
                        'title' => 'Disponible: ' . $nombreCurso,
                        'extendedProps' => [
                            'tipo' => 'disponibilidad',
                            'curso' => $nombreCurso
                        ]
                    ];
                }
            } elseif ($user->hasRole('cliente')) {
                // Si NO hay profesor pero es CLIENTE, cargamos sus clases por defecto
                $agendas = Agenda::with(['profesor.user', 'cliente.user', 'curso'])
                    ->where('cliente_id', $user->cliente->id)
                    ->get();
            } else {
                // Si no hay profesor y no es cliente (ej. admin sin filtrar), no mostramos nada
                return response()->json([]);
            }

            // 3. Mapeo de Agendas con lógica de colores
            foreach ($agendas as $a) {
                // Verificamos si la reserva pertenece al usuario actual
                $esMiReserva = ($a->cliente && $a->cliente->user_id == $user->id);
                $esAdmin = $user->hasRole(['superAdmin', 'admin', 'secretaria']);

                // Definimos colores y títulos según quién mira
                if ($esMiReserva || $esAdmin) {
                    $colorFondo = '#ff0000'; // Rojo (Tu clase o vista admin)
                    $colorBorde = '#b30000';
                    $titulo = $a->curso->nombre ?? 'Mi Clase';
                } else {
                    $colorFondo = '#6c757d'; // Gris (Ocupado por otro)
                    $colorBorde = '#495057';
                    $titulo = 'Ocupado'; // No mostramos el nombre del curso por privacidad
                }

                $eventos[] = [
                    'id' => $a->id,
                    'title' => $titulo,
                    'start' => $a->start,
                    'end' => $a->end->copy()->addMinutes(60), // Asumiendo duración de 30 mins, ajusta según tu lógica
                    // 'end' => $a->end->addMinutes(60), // Asumiendo duración de 30 mins, ajusta según tu lógica
                    'backgroundColor' => $colorFondo,
                    'borderColor' => $colorBorde,
                    'textColor' => '#ffffff',
                    'display' => 'block',

                    'extendedProps' => [
                        'profesor' => [
                            'nombres'   => $a->profesor->nombres ?? 'No asignado',
                            'apellidos' => $a->profesor->apellidos ?? '',
                        ],
                        'cliente' => [
                            'nombres'   => $a->cliente->nombres ?? 'No asignado',
                            'apellidos' => $a->cliente->apellidos ?? '',
                        ],
                        'tipo' => 'reserva'
                    ]
                ];
            }
            return response()->json($eventos);
        } catch (\Exception $e) {
            Log::error('Error al procesar eventos para profesor_id ' . $profesorId, ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    private function getDiaNumero($dia)
    {
        $map = [
            'DOMINGO' => [0],
            'LUNES' => [1],
            'MARTES' => [2],
            'MIERCOLES' => [3],
            'JUEVES' => [4],
            'VIERNES' => [5],
            'SABADO' => [6]
        ];
        return $map[$dia] ?? [];
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
                // DB::raw('GROUP_CONCAT(DISTINCT cursos.nombre ORDER BY cursos.nombre SEPARATOR ", ") as cursos')
                DB::raw('STRING_AGG(DISTINCT cursos.nombre, \', \' ORDER BY cursos.nombre) as cursos')
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
                // DB::raw('GROUP_CONCAT(DISTINCT cursos.nombre ORDER BY cursos.nombre SEPARATOR ", ") as cursos')
                DB::raw('STRING_AGG(DISTINCT cursos.nombre, \', \' ORDER BY cursos.nombre) as cursos')
            )
            ->groupBy('profesors.id', 'profesors.nombres', 'profesors.apellidos')
            ->limit(100)
            ->get();

        $t_cursos = DB::table('cliente_curso')
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
            't_cursos'     => $t_cursos,
            'cursosDisponibles' => $cursosDisponibles,
        ];
    }
}

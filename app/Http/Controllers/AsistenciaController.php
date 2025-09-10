<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Event as CalendarEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AsistenciaController extends Controller
{
    public function __construct()
    { // Solo los que tengan el permiso pueden acceder a estas acciones
        $this->middleware('can:admin.asistencias.index')->only('index');
        $this->middleware('can:admin.asistencias.inasistencias')->only('create', 'store'); 
    }

    public function index()  
    {
        $clientes = Cliente::all();
        $hoy = Carbon::now()->format('Y-m-d'); // Fecha de hoy
        // $events = CalendarEvent::whereDate('start', '>=', now())->get(); // Filtra solo los eventos futuros o del día actual
        // $events = CalendarEvent::whereDate('start', $hoy)->get();

        // ================ [ TEMPORAL ] ===================
        $asistencias=Asistencia::with('event','cliente')->get()->keyBy(function($item){return$item->evento_id.'-'.$item->cliente_id;});
        
        // ================ [ FINAL/CODIGO CORRECTO ] ===================
        // Obtener las asistencias del día actual y organizarlas en un array con clave 'evento_id-cliente_id'
        // $asistencias = Asistencia::with('event', 'cliente')
        //     ->whereHas('event', function ($query) use ($hoy) {
        //         $query->whereDate('start', $hoy);
        //     })
        //     ->get()
        //     ->keyBy(function ($item) {
        //         return $item->evento_id . '-' . $item->cliente_id;
        //     });

 
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin')) {// Obtener eventos basados en el rol del usuario
            $events = CalendarEvent::whereDate('start', '>=', now())
                ->join('profesors', 'events.profesor_id', '=', 'profesors.id')
                ->join('users', 'profesors.user_id', '=', 'users.id')
                ->select('events.*')
                ->get();
        } else {
            $events = CalendarEvent::whereDate('start', '>=', now())
                ->join('profesors', 'events.profesor_id', '=', 'profesors.id')
                ->join('users', 'profesors.user_id', '=', 'users.id')
                ->where('users.id', Auth::user()->id)
                ->select('events.*')
                ->get();
        }
        // Calcular las horas penalizadas en PHP
        foreach ($clientes as $cliente) {
            $start = new \DateTime($cliente->start);
            $end = new \DateTime($cliente->end);
            $diff = $start->diff($end);
            $hours = $diff->h + ($diff->i / 60); // Calcular horas con minutos convertidos a horas
            $cliente->cant_horas = round($hours, 2); // Asignar la cantidad de horas calculadas
        }
        return view('admin.asistencias.index', compact('events', 'asistencias'));
    }

    public function store(Request $request)
    {
        foreach ($request->eventos as $eventoId => $evento) {
            // Validamos los datos de cada evento
            $validatedData = Validator::make($evento, [
                'cliente_id' => 'required|exists:clientes,id',
                'asistio' => 'nullable|boolean',])->validate();      // Puede ser null si no está marcado
            
            $validatedData['evento_id'] = $eventoId;                 // Añadimos el evento_id al array de datos validados
            $validatedData['asistio'] = isset($validatedData['asistio']) ? $validatedData['asistio'] : 0; // Asignamos 0 si no está marcado el checkbox de 'asistió'

           
            $event = CalendarEvent::find($eventoId);                 // Obtener el evento para calcular la duración
            if ($event) {
                $start = Carbon::parse($event->start);
                $end = Carbon::parse($event->end);

                
                $duracionHoras = $end->diffInHours($start);           // Calcular la duración en horas
                $validatedData['penalidad'] = $validatedData['asistio'] == 0 ? $duracionHoras * 20000 : 0;
            } else {
                continue;
            }

           
            $asistenciaExistente = Asistencia::where('cliente_id', $validatedData['cliente_id'])
                ->where('evento_id', $eventoId)                        // Verificar si ya existe una asistencia para este cliente y evento
                ->first();

            if ($asistenciaExistente) {
                $asistenciaExistente->update($validatedData);
            } else {
                Asistencia::create($validatedData);
            }

            $clienteCurso = DB::table('cliente_curso')                  // Verificar si el registro en cliente_curso existe,
                ->where('cliente_id', $validatedData['cliente_id'])     // y crearlo si no existe
                ->where('curso_id', $event->curso_id)
                ->first();

            if (!$clienteCurso) {
                DB::table('cliente_curso')->insert([
                    'cliente_id' => $validatedData['cliente_id'],
                    'curso_id' => $event->curso_id,
                    'horas_realizadas' => 0,                  // Inicializamos en 0
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

           
            if ($validatedData['asistio']) {                  // Incrementar o decrementar horas realizadas solo si el cliente asistió
                DB::table('cliente_curso')
                    ->where('cliente_id', $validatedData['cliente_id'])
                    ->where('curso_id', $event->curso_id)
                    ->increment('horas_realizadas', $duracionHoras);
            } else {
                DB::table('cliente_curso')
                    ->where('cliente_id', $validatedData['cliente_id'])
                    ->where('curso_id', $event->curso_id)
                    ->decrement('horas_realizadas', $duracionHoras);
            }
        }

        return response()->json(['message' => 'Evento actualizado correctamente']);
    }

    public function show()  //ver INASISTENCIAS y habilitar cliente
    {   // Filtra los clientes que tengan inasistencias con penalidad
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin')) {
            $clientes = Cliente::select(
                'clientes.id',
                'clientes.nombres AS nombre',
                'clientes.apellidos AS apellido',
                'asistencias.id AS asistencia_id',
                'events.title AS nombre_evento',
                DB::raw('DATE(events.start) AS date'),
                DB::raw('TIME(events.start) AS start'),
                DB::raw('TIME(events.end) AS end'),
                'asistencias.asistio',
                'asistencias.penalidad',
                'asistencias.liquidado',
                'asistencias.fecha_pago_multa'
            )
                ->join('asistencias', 'clientes.id', '=', 'asistencias.cliente_id')
                ->join('events', 'asistencias.evento_id', '=', 'events.id')
                ->get();
            
            foreach ($clientes as $cliente) {             // Calcular las horas penalizadas en PHP
                $start = new \DateTime($cliente->start);
                $end = new \DateTime($cliente->end);
                $diff = $start->diff($end);
                $hours = $diff->h + ($diff->i / 60);      // Calcular horas con minutos convertidos a horas
                $cliente->cant_horas = round($hours, 2);  // Asignar la cantidad de horas calculadas
            }
            return view('admin.asistencias.inasistencias', compact('clientes'));
        } else {
            $clientes = Cliente::select('clientes.id', 'clientes.nombres AS nombre', 
                'clientes.apellidos AS apellido', 
                'asistencias.id AS asistencia_id', 
                'events.title AS nombre_evento', 
                DB::raw('DATE(events.start) AS date'),
                DB::raw('TIME(events.start) AS start'),
                DB::raw('TIME(events.end)   AS end'), 
                'asistencias.asistio', 'asistencias.penalidad', 'asistencias.liquidado', 'asistencias.fecha_pago_multa')
                ->join('asistencias', 'clientes.id', '=', 'asistencias.cliente_id')
                ->join('events', 'asistencias.evento_id', '=', 'events.id')
                ->where('asistencias.asistio', 0)
                ->where('asistencias.penalidad', '>=', 0)
                ->get();
            
            foreach ($clientes as $cliente) {             // Calcular las horas penalizadas en PHP
                $start = new \DateTime($cliente->start);
                $end = new \DateTime($cliente->end);
                $diff = $start->diff($end);
                $hours = $diff->h + ($diff->i / 60);      // Calcular horas con minutos convertidos a horas
                $cliente->cant_horas = round($hours, 2);  // Asignar la cantidad de horas calculadas
            }
            return view('admin.asistencias.inasistencias', compact('clientes'));
        }
    }

    public function habilitarCliente($cliente_id)            // Habilitar al cliente después de pagar la penalidad
    {
        $cliente = Cliente::findOrFail($cliente_id);
        foreach ($cliente->asistencias as $asistencia) {     // Recorre las asistencias del cliente
            
            if ($asistencia->liquidado) {                   // Si ya está habilitado, deshabilitar y cambiar el valor de 'asistio' a true 
                
                $asistencia->asistio = !$asistencia->asistio;// Invertir el valor de 'asistio'
               
                if (!$asistencia->asistio) {                 // Restablecer la fecha de pago de multa si se deshabilita
                    $asistencia->fecha_pago_multa = null;
                    $asistencia->liquidado = false;
                } else {
                    $asistencia->fecha_pago_multa = now()->format('Y-m-d H:i:s');
                    $asistencia->liquidado = true;
                }
            } else {
                if (!$asistencia->asistio) {                 // Si el cliente no ha sido habilitado antes, habilitarlo
                    $asistencia->liquidado = true;
                    $asistencia->fecha_pago_multa = now()->format('Y-m-d H:i:s');
                }
            }
            $asistencia->save();                             // Guardar los cambios en cada asistencia
        }

        return redirect()->back()->with('success', 'El estado del cliente ha sido actualizado correctamente');
    }

    // public function update(Request $request)
    // {
    //     foreach ($request->eventos as $evento_id => $data) {
    //         $evento = CalendarEvent::find($evento_id);
    //         $asistio = isset($data['asistio']) ? 1 : 0;

    //         $evento->update([
    //             'asistio' => $asistio,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Asistencia registrada correctamente');
    // }
}

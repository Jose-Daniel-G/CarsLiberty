<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\Event as CalendarEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        $horarios = Horario::with('profesor', 'cursos')->get(); // viene con la relacion del horario
        return view('admin.horarios.index', compact('horarios', 'cursos'));
    }

    public function create()
    {
        $profesores = Profesor::all();
        $cursos = Curso::all();
        $horarios = Horario::with('profesor', 'cursos')->get(); // viene con la relacion del horario

        return view('admin.horarios.create', compact('profesores', 'cursos', 'horarios'));
    }

    public function show_datos_cursos($id)
    {
        try {
            // Obtener horarios con profesor y curso
            $horarios = Horario::with('curso')->whereHas('profesor', fn($query) => $query->where('id', $id))->get();
            $horarios_asignados = CalendarEvent::select([
                'events.id AS evento_id',
                'events.profesor_id',
                'events.curso_id',
                'events.start AS hora_inicio',
                'events.end AS hora_fin',
                \DB::raw('DAYNAME(events.start) AS dia'),
                'users.id AS user_id',
                'users.name AS user_nombre',
                'cursos.nombre AS curso_nombre'
            ])
            ->join('cursos', 'events.curso_id', '=', 'cursos.id')
            ->join('clientes', 'events.cliente_id', '=', 'clientes.id')
            ->join('users', 'clientes.user_id', '=', 'users.id')
            ->where('events.curso_id', $id)
            ->where('events.start', '>=', Carbon::now()->startOfWeek()) // Filtra desde el inicio de la semana
            ->where('events.start', '<', Carbon::now()->endOfWeek()) // Filtra hasta el final de la semana
            ->orderBy('events.start', 'ASC')
            ->limit(100)
            ->get();
            
            // Traducir los días al español
            $horarios_asignados = $horarios_asignados->map(function ($horario) {
                $horario->dia = traducir_dia($horario->dia); // Traduce el día al español
                return $horario;
            });
            // dd($horarios_asignados);
            return view('admin.horarios.show_datos_cursos', compact('horarios', 'horarios_asignados'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error']);
        }
    }
       
    // public function show_datos_cursos($id)
    // { 
    //     // echo $id;   

    //     try {
    //         $horarios = Horario::with(['profesor', 'curso'])->where('curso_id', $id)->get();
    //         // return view('admin.horarios.show_datos_cursos', compact('horarios'));
    //         return response()->json($horarios);

    //     } catch (\Exception $exception) {
    //         return response()->json(['mesaje' => 'Error']);
    //     }
    // }
    
    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'profesor_id' => 'required|exists:profesors,id',
            'cursos' => 'required|array|min:1', // Asegura que se envíen al menos 1 curso
            'cursos.*' => 'exists:cursos,id',
        ]);
    
        DB::beginTransaction();
        try {
            // Verificar si ya existe el horario con los mismos datos
            $horario = Horario::firstOrCreate([
                'dia' => $validatedData['dia'],
                'hora_inicio' => $validatedData['hora_inicio'],
                'hora_fin' => $validatedData['hora_fin'],
                'profesor_id' => $validatedData['profesor_id'],
            ]);
    
            // Asociar los cursos al horario (sin duplicar)
            $horario->cursos()->syncWithoutDetaching($validatedData['cursos']);
    
            // Asociar los cursos al profesor (tabla curso_profesor)
            $profesor = Profesor::find($validatedData['profesor_id']);
            $profesor->cursos()->syncWithoutDetaching($validatedData['cursos']);
    
            DB::commit();
    
            return redirect()->route('admin.horarios.create')
                ->with('info', 'Se registraron los cursos para el horario correctamente.')
                ->with('icono', 'success');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al registrar el horario.');
        }

    }
    
    
    

        // Verificar si existe conflicto de horario con el mismo profesor en el mismo día y hora
        // $horarioProfesor = Horario::where('dia', $request->dia)
        //     ->where('profesor_id', $request->profesor_id) // Filtrar por el mismo profesor
        //     ->where(function ($query) use ($request) {
        //         $query->where(function ($query) use ($request) {
        //             $query->where('hora_inicio', '>=', $request->hora_inicio)
        //                 ->where('hora_inicio', '<', $request->hora_fin);
        //         })
        //             ->orWhere(function ($query) use ($request) {
        //                 $query->where('hora_fin', '>', $request->hora_inicio)
        //                     ->where('hora_fin', '<=', $request->hora_fin);
        //             })
        //             ->orWhere(function ($query) use ($request) {
        //                 $query->where('hora_inicio', '<', $request->hora_inicio)
        //                     ->where('hora_fin', '>', $request->hora_fin);
        //             });
        //     })
        //     ->exists();


        // if ($horarioProfesor) {
        //     return redirect()->back()
        //         ->withInput()
        //         ->with('mensaje', 'El profesor ya tiene asignado un horario en ese rango de tiempo')
        //         ->with('icono', 'error');
        // }

        // Crear el nuevo horario

        // Asociar los cursos
        // $horario->cursos()->attach($request->cursos);

    // }


    public function show(Horario $horario)
    {
        $horario = $horario->with('profesor', 'curso')->get();
        return view('admin.horarios.show', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        // Obtener el curso relacionado con el horario
        $curso = $horario->curso;
        $profesores = Profesor::all();
        $cursos = Curso::all();

        return view('admin.horarios.edit', compact('horario', 'curso', 'profesores', 'cursos'));
    }

    public function update(Request $request, Horario $horario)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        // Crea el nuevo horario
        $horario->update($request->all());

        return redirect()->route('admin.horarios.index')
            ->with(['info', 'Horario actualizado correctamente.','icono', 'success']);
    }


    public function destroy(Horario $horario)
    {   $horario->delete();
        return redirect()->route('admin.horarios.index')->with(['title', 'Exito','info', 'El horario se eliminó con éxito','icon', 'success']);
    }
}

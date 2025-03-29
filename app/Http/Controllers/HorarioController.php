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
            // Obtener los cursos que tiene asignado el profesor
            $cursos_profesor = Curso::whereHas('profesores', function ($query) use ($id) {
                $query->where('profesor_id', $id);
            })->get();
    
            // Obtener horarios con profesor y curso
            $horarios = Horario::whereHas('horarioProfesorCurso', function ($query) use ($id) {
                $query->where('profesor_id', $id);
            })->with('horarioProfesorCurso.curso')->get();
    
            // Obtener horarios asignados a los cursos
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
            ->where('events.profesor_id', $id)
            ->where('events.start', '>=', Carbon::now()->startOfWeek())
            ->where('events.start', '<', Carbon::now()->endOfWeek())
            ->orderBy('events.start', 'ASC')
            ->limit(100)
            ->get();
    
            // Traducir los días al español
            $horarios_asignados = $horarios_asignados->map(function ($horario) {
                $horario->dia = traducir_dia($horario->dia);
                return $horario;
            });
    
            return view('admin.horarios.show_datos_cursos', compact('cursos_profesor', 'horarios', 'horarios_asignados'));
    
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error', 'detalle' => $exception->getMessage()]);
        }
    }
    
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
        // dd($validatedData);
        // // Verificar si el horario ya existe para ese día, rango de horas y curso
        // $horarioCurso = Horario::where('dia', $request->dia)
        //     ->where('curso_id', $request->curso_id) // Filtrar por curso
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

        // // Si ya existe un horario en ese rango para el mismo curso con otro profesor
        // if ($horarioCurso) {
        //     return redirect()->back()
        //         ->withInput()
        //         ->with('mensaje', 'Ya existe un horario para el curso con otro profesor en ese rango de tiempo')
        //         ->with('icono', 'error');
        // }  

        // DB::beginTransaction();
        try {
            // Verificar si ya existe el horario con los mismos datos
            $horario = Horario::firstOrCreate([
                'dia' => $validatedData['dia'],
                'hora_inicio' => $validatedData['hora_inicio'],
                'hora_fin' => $validatedData['hora_fin'],
                'profesor_id' => $validatedData['profesor_id'],
            ]);
        // dd($horario);

            foreach ($validatedData['cursos'] as $cursoId) {
                DB::table('horario_profesor_curso')->updateOrInsert([
                    'horario_id' => $horario->id,
                    'curso_id' => $cursoId,
                    'profesor_id' => $validatedData['profesor_id']
                ]);
            }
        

            // DB::commit();

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
            ->with(['info', 'Horario actualizado correctamente.', 'icono', 'success']);
    }


    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('admin.horarios.index')->with(['title', 'Exito', 'info', 'El horario se eliminó con éxito', 'icon', 'success']);
    }
}

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
        $horarios = Horario::with('profesores', 'cursos')->get(); // viene con la relacion del horario
        return view('admin.horarios.index', compact('horarios', 'cursos'));
    }

    public function create()
    {
        $profesores = Profesor::all();
        $cursos = Curso::all();
        $horarios = Horario::with('profesores', 'cursos')->get(); // viene con la relacion del horario

        return view('admin.horarios.create', compact('profesores', 'cursos', 'horarios'));
    }

    public function show_datos_cursos($id) 
    {
        try {
<<<<<<< HEAD
            // Obtener los cursos asignados al profesor

            $cursos_profesor = Curso::whereHas('horarios', function ($query) use ($id) {
                $query->whereHas('profesores', function ($query) use ($id) {
                    $query->where('profesor_id', $id);
                });
            })->with('horarios.profesores')->get();


            // Obtener horarios disponibles del profesor con sus cursos
            $horarios = Horario::whereHas('profesores', function ($query) use ($id) {
                $query->where('profesor_id', $id);
            })->with(['cursos', 'profesores'])->get();
            // dd(['titulo' => 'Datos de horarios del Profesor', 'horarios' => $horarios->toArray()]);
            // Obtener eventos agendados para este profesor
            $horarios_asignados = DB::table('events')
                ->select([
                    'events.id AS evento_id',
                    'events.profesor_id',
                    'events.curso_id',
                    'events.start AS hora_inicio',
                    'events.end AS hora_fin',
                    DB::raw('DAYNAME(events.start) AS dia'),
                    'users.id AS user_id',
                    'users.name AS user_nombre',
                    'cursos.nombre AS curso_nombre'
                ])
                ->join('cursos', 'events.curso_id', '=', 'cursos.id')
                ->join('clientes', 'events.cliente_id', '=', 'clientes.id')
                ->join('users', 'clientes.user_id', '=', 'users.id')
                ->where('events.profesor_id', $id)
                ->get();
            // dd(['titulo' => 'Datos de horarios asignados', 'horarios asignados' => $horarios_asignados->toArray()]);

=======
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
    
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
            // Traducir los días al español
            $horarios_asignados = $horarios_asignados->map(function ($horario) {
                $horario->dia = traducir_dia($horario->dia);
                return $horario;
            });
<<<<<<< HEAD

            return view('admin.horarios.show_datos_cursos', compact('cursos_profesor', 'horarios', 'horarios_asignados'));
=======
    
            return view('admin.horarios.show_datos_cursos', compact('cursos_profesor', 'horarios', 'horarios_asignados'));
    
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error', 'detalle' => $exception->getMessage()]);
        }
    }
<<<<<<< HEAD


=======
    
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'profesor_id' => 'required|exists:profesors,id',
            'cursos' => 'required|array|min:1', // Al menos 1 curso
            'cursos.*' => 'exists:cursos,id',
        ]);
<<<<<<< HEAD

        // Normalizar el formato de las horas (si en la BD se guarda con segundos, por ejemplo "H:i:s")
        $horaInicio = Carbon::parse($validatedData['hora_inicio'])->format('H:i:s');
        $horaFin    = Carbon::parse($validatedData['hora_fin'])->format('H:i:s');

        // Verificar si el profesor ya tiene un horario agendado en ese día con superposición en el rango de horas
        $horarioExistente = Horario::where('dia', $validatedData['dia'])
            ->where('profesor_id', $validatedData['profesor_id'])
            ->where(function ($query) use ($horaInicio, $horaFin) {
                $query->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->where('hora_inicio', '>=', $horaInicio)
                        ->where('hora_inicio', '<', $horaFin);
                })
                    ->orWhere(function ($query) use ($horaInicio, $horaFin) {
                        $query->where('hora_fin', '>', $horaInicio)
                            ->where('hora_fin', '<=', $horaFin);
                    })
                    ->orWhere(function ($query) use ($horaInicio, $horaFin) {
                        $query->where('hora_inicio', '<', $horaInicio)
                            ->where('hora_fin', '>', $horaFin);
                    });
            })
            ->exists();

        if ($horarioExistente) {
            return redirect()->back()
                ->withInput()
                ->with('mensaje', 'El profesor ya tiene una clase agendada en ese rango de tiempo.')
                ->with('icono', 'error');
        }

        try {
            // Si no existe un horario en ese rango, se crea el horario
            $horario = Horario::firstOrCreate([
                'dia' => $validatedData['dia'],
                'hora_inicio' => $horaInicio,
                'hora_fin' => $horaFin,
                'profesor_id' => $validatedData['profesor_id'],
            ]);

            // Se asocian los cursos a ese horario
=======
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

>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
            foreach ($validatedData['cursos'] as $cursoId) {
                DB::table('horario_profesor_curso')->updateOrInsert([
                    'horario_id' => $horario->id,
                    'curso_id' => $cursoId,
                    'profesor_id' => $validatedData['profesor_id']
                ]);
            }
<<<<<<< HEAD
=======
        

            // DB::commit();
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6

            return redirect()->route('admin.horarios.create')
                ->with('info', 'Se registraron los cursos para el horario correctamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al registrar el horario.');
        }
    }
<<<<<<< HEAD
=======




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
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6


    public function show(Horario $horario)
    {
        $horario->load('profesores', 'cursos'); // Cargar relaciones en la instancia
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

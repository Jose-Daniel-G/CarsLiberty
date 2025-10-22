<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    public function __construct()
    {  // Solo los que tengan el permiso pueden acceder a estas acciones
        $this->middleware('can:admin.cursos.index')->only('index');
        $this->middleware('can:admin.cursos.create')->only('create', 'store');
        $this->middleware('can:admin.cursos.edit')->only('edit', 'update');
        $this->middleware('can:admin.cursos.destroy')->only('destroy');
    }

    public function index()
    {
        $cursos = Curso::all();
        return view('admin.cursos.index', compact(('cursos')));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'horas_requeridas' => 'required|integer|min:1',
            'estado' => 'required|in:0,1',
            'descripcion' => 'nullable',
        ]);
        Curso::create($request->all()); // Crear un nuevo curso

        return redirect()->route('admin.cursos.index')->with(['toast'=>2,'title' => 'Exito', 'info' => 'Curso registrado correctamente.', 'icon' => 'success']);
    }

    public function edit(Curso $curso)
    {
        return response()->json($curso);
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'horas_requeridas' => 'required',
        ]);

        $curso->update($request->all()); // Actualizar el registro específico

        return redirect()->route('admin.cursos.index')->with([
            'info' => 'Curso actualizado correctamente.',
            'icon' => 'success'
        ]);
    }
    public function completados()
    {
        if (
            Auth::user()->hasRole('superAdmin') ||
            Auth::user()->hasRole('admin') ||
            Auth::user()->hasRole('secretaria') ||
            Auth::user()->hasRole('profesor')
        ) {
            // 🔹 ADMIN: Todos los clientes
            $cursosClientes = DB::table('cursos')
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->join('clientes', 'cliente_curso.cliente_id', '=', 'clientes.id')
                ->select(
                    'cliente_curso.id as relacion_id',
                    'clientes.id as cliente_id',
                    DB::raw("CONCAT(clientes.nombres, ' ', clientes.apellidos) AS cliente_nombre"),
                    'cursos.id as curso_id',
                    'cursos.nombre as curso_nombre',
                    'cursos.descripcion',
                    'cursos.horas_requeridas',
                    'cliente_curso.horas_realizadas',
                    'cliente_curso.fecha_realizacion', 
                )
                ->orderBy('clientes.id')
                ->get();


            return view('admin.cursos.completados_all', compact('cursosClientes'));
        } else {
            // 🔹 CLIENTE NORMAL: solo sus cursos
            $userId = Auth::user()->id;
            $cliente = \App\Models\Cliente::where('user_id', $userId)->first();

            if (!$cliente) {
                return back()->with('error', 'No se encontró un registro asociado al usuario actual.');
            }

            $cursosCompletados = DB::table('cursos')
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->select(
                    'cliente_curso.id as relacion_id',
                    'cursos.id as id',
                    'cursos.nombre',
                    'cursos.descripcion',
                    'cursos.horas_requeridas',
                    'cliente_curso.horas_realizadas',
                    'cliente_curso.fecha_realizacion'
                )
                ->where('cliente_curso.cliente_id', $cliente->id)
                ->whereColumn('cliente_curso.horas_realizadas', '>=', 'cursos.horas_requeridas')
                ->orderBy('cursos.id')
                ->get();

            $cursosEnProgreso = DB::table('cursos')
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->select(
                    'cliente_curso.id as relacion_id',
                    'cursos.id as id',
                    'cursos.nombre',
                    'cursos.descripcion',
                    'cursos.horas_requeridas',
                    'cliente_curso.horas_realizadas'
                )
                ->where('cliente_curso.cliente_id', $cliente->id)
                ->whereColumn('cliente_curso.horas_realizadas', '<', 'cursos.horas_requeridas')
                ->orderBy('cursos.id')
                ->get();

            return view('admin.cursos.completados', compact('cursosCompletados', 'cursosEnProgreso'));
        }
    }

public function estadisticas()
{
    $cursosClientes = DB::table('cursos')
        ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
        ->join('clientes', 'cliente_curso.cliente_id', '=', 'clientes.id')
        ->select(
            'clientes.id as cliente_id',
            DB::raw("CONCAT(clientes.nombres, ' ', clientes.apellidos) as cliente_nombre"),
            'cursos.id as curso_id',
            'cursos.nombre as curso_nombre',
            'cursos.horas_requeridas',
            'cliente_curso.horas_realizadas',
            'cliente_curso.fecha_realizacion'
        )
        ->orderBy('clientes.id')
        ->get();

    $cursosCompletados = $cursosClientes->filter(fn($c) => $c->horas_realizadas >= $c->horas_requeridas);
    $cursosEnProgreso  = $cursosClientes->filter(fn($c) => $c->horas_realizadas < $c->horas_requeridas);

    return view('admin.cursos.estadisticas', compact('cursosClientes', 'cursosCompletados', 'cursosEnProgreso'));
}

    public function destroy(Curso $curso)
    {
        if ($curso->user) { $curso->user->delete();  } // Si existe un usuario asociado, eliminarlo

        $curso->delete(); // Eliminar el curso

        return redirect()->route('admin.cursos.index')
            ->with(['title'=> 'Exito', 'info'=>'El curso se eliminó con éxito', 'icon', 'success']);
    }
    public function toggleStatus($id) //DEACTIVATE
    {
        $curso = Curso::findOrFail($id);
        $curso->estado = !$curso->estado;
        $curso->save();

        return redirect()->back()->with(['toast'=>2,'info' => 'Estado del usuario actualizado.']);
    }
    public function obtenerCursos($clienteId)
    {
        $cliente = Cliente::with('cursos')->findOrFail($clienteId);
        return response()->json($cliente->cursos);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HistorialCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialCursoController extends Controller
{
    public function index()// listarCursosCompletados($clienteId)
    {
        $historial = DB::table('historial_cursos_completados')
                       ->where('cliente_id', $clienteId)
                       ->join('cursos', 'historial_cursos_completados.curso_id', '=', 'cursos.id')
                       ->select('cursos.nombre', 'historial_cursos_completados.fecha_completado')
                       ->get();

        return response()->json($historial);
    }

    public function create()
    {
        //
    }

    // Función para registrar un curso completado 
    // public function store(Request $request)
    public function registrarCursoCompletado($clienteId, $cursoId)
    {
        DB::table('historial_cursos_completados')->insert([
            'cliente_id' => $clienteId,
            'curso_id' => $cursoId,
            'fecha_completado' => now(),
        ]);
    }

    // Función para verificar si un curso está completado y registrar en historial
    public function completarCurso($clienteId, $cursoId)
    {
        $registro = DB::table('cliente_curso')
                      ->where('cliente_id', $clienteId)
                      ->where('curso_id', $cursoId)
                      ->first();

        if ($registro && $registro->horas_restantes === 0) {
            $this->registrarCursoCompletado($clienteId, $cursoId);
            return response()->json(['message' => 'Curso completado y registrado en el historial.'], 200);
        }

        return response()->json(['message' => 'Horas restantes aún no son cero.'], 400);
    }

    public function show(HistorialCurso $historialCurso)
    {
        //
    }

    public function edit(HistorialCurso $historialCurso)
    {
        //
    }

    public function update(Request $request, HistorialCurso $historialCurso)
    {
        //
    }

    public function destroy(HistorialCurso $historialCurso)
    {
        //
    }
}

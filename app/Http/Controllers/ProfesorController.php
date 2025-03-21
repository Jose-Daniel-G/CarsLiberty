<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::with('user')->get(); // viene con la relacion del profesor
        return view('admin.profesores.index', compact(('profesores')));
    }

    public function create()
    {
        return view('admin.profesores.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            // 'especialidad' => 'required',
            'email' => 'required|email|max:150|unique:users,email', // Asegúrate de que el email sea único en la tabla users
            'password' => 'min:8|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;

        // Hash de la contraseña
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();
        $profesor = $request->all();
        $profesor['user_id'] = $usuario->id; // Asigna el ID del nuevo usuario al nuevo profesor

        Profesor::create($profesor);
        $usuario->assignRole('profesor');// Asignar rol de 'profesor' al nuevo usuario

        return redirect()->route('admin.profesores.index')
            ->with(['info', 'Se registró el profesor de forma correcta','icono', 'success']);
    }


    public function show(Profesor $profesor)
    {
        return view('admin.profesores.show', compact('profesor'));
    }

    public function edit(Profesor $profesor)
    {
        return view('admin.profesores.edit', compact('profesor'));
    }

    public function update(Request $request, Profesor $profesor)
    {
        $data = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            // 'especialidad' => 'required',
            'email' => 'required|email|max:50|unique:users,email,' . $profesor->user_id, // Excluyendo el usuario actual
            'password' => 'nullable|min:8|confirmed', // Permitir que la contraseña sea opcional
        ]);

        // Asignar el user_id actual a los datos
        $data['user_id'] = $profesor->user_id;
        $profesor->update($data); // Actualiza el profesor

        // Obtener el usuario asociado al profesor directamente a través de la relación
        $usuario = $profesor->user;

        // Actualizar el email del usuario
        $usuario->email = $data['email']; // Asegúrate de usar el nuevo email validado
        // Condición para saber si el campo password se ha tocado
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }

        $usuario->save(); // Guardar cambios del usuario

        return redirect()->route('admin.profesores.index')
            ->with('info', 'Profesor actualizado correctamente.','icono', 'success');
    }



    public function destroy(Profesor $profesor)
    {   
        // Verificar si el profesor tiene eventos asociados
        if ($profesor->events()->exists()) {
            return redirect()->route('admin.profesores.index')->with('title', 'Error al eliminar profesor')
                ->with(['info', 'No se puede eliminar el profesor porque tiene eventos asociados.','icono', 'error']);
        }

        if ($profesor->user) {$profesor->user->delete();} // Si el profesor tiene un usuario asociado, eliminarlo
        
        $profesor->delete();// Eliminar el profesor

        return redirect()->route('admin.profesores.index')
            ->with(['info', 'El profesor se eliminó con éxito','icono', 'success']);
    }
    public function reportes()
    {
        return view('admin.profesores.reportes');
    }
    public function pdf($id)
    {
        $config = Config::latest()->first();
        $profesores = Profesor::all();
        // dd($profesores);
        $pdf = PDF::loadView('admin.profesores.pdf', compact('config', 'profesores'));

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y') . " - " . \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0, 0, 0));

        return $pdf->stream();
    }
    public function obtenerProfesores($cursoId)
    {
        $profesores = DB::table('horarios')
            ->join('profesors', 'horarios.profesor_id', '=', 'profesors.id')
            ->where('horarios.curso_id', $cursoId)
            ->select('profesors.*')
            ->distinct()
            ->get();
        // dd($profesores);
        return response()->json($profesores); // Asegúrate de devolver JSON
    }


    // public function obtenerProfesoresPorCurso($cursoId)
    // {
    //     // Suponiendo que tienes una relación entre Curso y Profesor
    //     $curso = Curso::find($cursoId);

    //     if (!$curso) {
    //         return response()->json(['message' => 'Curso no encontrado'], 404);
    //     }

    //     $profesores = $curso->profesores; // Asegúrate de que esta relación esté definida en el modelo Curso
    //     return response()->json($profesores);
    // }

    // public function obtenerProfesoresPorCurso($cursoId)
    // {
    //     // Suponiendo que tienes un método en el modelo Curso que devuelve los profesores
    //     $curso = Curso::find($cursoId);
    //     $profesores = $curso->profesores; // Asumiendo que tienes la relación definida

    //     return response()->json($profesores);
    // }
}

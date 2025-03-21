<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        // $vehiculos = Vehiculo::all();
        $vehiculos = Vehiculo::leftJoin('users', 'vehiculos.profesor_id', '=', 'users.id')
            ->join('profesors', 'users.id', '=', 'profesors.user_id')
            ->select('vehiculos.*', 'profesors.nombres', 'profesors.apellidos')
            ->limit(100)
            ->get();

        return view("admin.vehiculos.index", compact('vehiculos'));
    }

    public function create()
    {
        $profesores = Profesor::all(); // Obtener todos los profesores
        // $vehiculo->load('profesor'); // Cargar solo el profesor relacionado
        return response()->json(['profesores' => $profesores]);
        // return view('admin.vehiculos.create');
    }

    public function store(Request $request)
    {   // $vehiculos = $request->all();
        // return response()->json($vehiculos);
        $vehiculos = $request->validate([
            'placa' => 'required|string|max:10|unique:vehiculos,placa', // Validación para que la placa sea única
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|max:100', // Asegúrate de que 'tipo' sea válido
            'disponible' => 'required|boolean', // Asumiendo que quieres manejar disponibilidad
            // 'picoyplaca_id' => 'required|exists:picoyplaca,id', // Asumiendo que tienes esta validación
            'profesor_id' => 'required|exists:users,id', // Asegúrate de que el usuario exista
        ]);

        Vehiculo::create($vehiculos);

        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('icon', 'success')
            ->with('info', 'Vehículo creado correctamente.');
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo = Vehiculo::leftJoin('users', 'vehiculos.profesor_id', '=', 'users.id')
            ->join('profesors', 'users.id', '=', 'profesors.user_id')
            ->select('vehiculos.*', 'profesors.nombres', 'profesors.apellidos')
            ->where('vehiculos.id', $vehiculo->id) // Filtrar por el ID del vehículo
            ->first(); // Obtener solo un registro

        return view('admin.vehiculos.show', compact('vehiculo')); // Asegúrate de tener esta vista
    }

    public function edit(Vehiculo $vehiculo)
    {
        $profesores = Profesor::all(); // Obtener todos los profesores
        $vehiculo->load('profesor'); // Cargar solo el profesor relacionado

        return response()->json([
            'vehiculo' => $vehiculo,
            'profesores' => $profesores,
        ]);
    }


    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate(['placa' => 'required|string|max:7',
                            'modelo' => 'required|string|max:255',
                            'tipo' => 'required|string|max:50',
                            'disponible' => 'required|boolean', // Validación para 'disponible'
                            'picoyplaca_id' => 'nullable|exists:picoyplaca,id', // Si manejas un campo de pico y placa
                            'profesor_id' => 'nullable|exists:profesores,id']); // Validación para el profesor asociado
        $vehiculo->update();
        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('info', 'Vehículo actualizado correctamente.')
            ->with('icon', 'success');
    }


    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('info', 'El vehículo ha sido eliminado exitosamente.')
            ->with('icon', 'success');
    }
}

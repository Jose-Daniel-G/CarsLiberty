<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::leftJoin('users', 'vehiculos.profesor_id', '=', 'users.id')
            ->leftJoin('profesors', 'users.id', '=', 'profesors.user_id')
            ->select('vehiculos.*', 'profesors.nombres', 'profesors.apellidos')->get();
        $tipos = TipoVehiculo::all();
        return view("admin.vehiculos.index", compact('vehiculos','tipos'));
    }

    public function create()
    {
        $profesores = Profesor::all(); // Obtener todos los profesores
        return response()->json(['profesores' => $profesores]);
    }

    public function store(Request $request)
    {
        $vehiculos = $request->validate([
            'placa' => 'required|string|max:10|unique:vehiculos,placa', // Validación para que la placa sea única
            'modelo' => 'required|string|max:255',
            'tipo_id' => 'required|exists:tipos_vehiculos,id', // Asegúrate de que 'tipo' sea válido
            'disponible' => 'required|boolean', // Asumiendo que quieres manejar disponibilidad
            'profesor_id' => 'required|exists:users,id', // Asegúrate de que el usuario exista
        ]);
        // dd($vehiculos);

        Vehiculo::create($vehiculos);

        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('icon', 'success')
            ->with('info', 'Vehículo creado correctamente.');
    }

    public function show(Vehiculo $vehiculo)
    {
        // $vehiculo = Vehiculo::leftJoin('users', 'vehiculos.profesor_id', '=', 'users.id')
        //     ->join('profesors', 'users.id', '=', 'profesors.user_id')
        //     ->select('vehiculos.*', 'profesors.nombres', 'profesors.apellidos')
        //     ->where('vehiculos.id', $vehiculo->id) // Filtrar por el ID del vehículo
        //     ->first(); // Obtener solo un registro

        // return view('admin.vehiculos.show', compact('vehiculo')); // Asegúrate de tener esta vista
    }

    public function edit(Vehiculo $vehiculo)
    {
        // Cargar el profesor y su user
        $vehiculo->load(['profesor']); 

        $profesores = Profesor::all();
        $tipos = TipoVehiculo::all();

        return response()->json([
            'vehiculo' => $vehiculo,
            'profesores' => $profesores,
            'tipos' => $tipos,
        ]);
    }



    public function update(Request $request, Vehiculo $vehiculo)
    {
        // The unique validation rule is modified to ignore the current vehicle's ID
        $data = $request->validate([
            'placa' => 'required|string|max:7|unique:vehiculos,placa,' . $vehiculo->id,
            'modelo' => 'required|string|max:255',
            'tipo_selected' => 'required|exists:tipos_vehiculos,id',
            'disponible' => 'required|boolean',
            'profesor_id' => 'nullable|exists:profesors,user_id'
        ]);

        $data['tipo_id'] = $data['tipo_selected'];
        unset($data['tipo_selected']);

        $vehiculo->update($data);

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

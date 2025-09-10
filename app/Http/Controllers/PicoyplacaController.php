<?php

namespace App\Http\Controllers;

use App\Models\PicoyPlaca;
use Illuminate\Http\Request;

class PicoyPlacaController extends Controller
{
    public function index()
    {
        $picoyplaca = PicoyPlaca::all()->groupBy('dia');
        return view('admin.picoyplaca.index', compact('picoyplaca'));
    }

    public function create()
    {
        return view('admin.picoyplaca.create');
    }
    public function update(Request $request)
    {
        // Asegúrate de que los arrays de datos existan
        $horariosInicio = $request->input('horario_inicio', []);
        $horariosFin = $request->input('horario_fin', []);
        $placasReservadas = $request->input('placas_reservadas', []);

        foreach ($horariosInicio as $id => $horarioInicio) {// Itera sobre los IDs de los horarios
            $horarioFin = $horariosFin[$id];
            $placas = $placasReservadas[$id];

            $picoYPlaca = PicoyPlaca::find($id);            // Busca el modelo por su ID y actualiza los campos

            if ($picoYPlaca) {
                $picoYPlaca->update([
                    'horario_inicio' => $horarioInicio,
                    'horario_fin' => $horarioFin,
                    'placas_reservadas' => $placas,
                ]);
            }
        }
        return redirect()->route('admin.picoyplaca.index')->with('success', 'Horarios actualizados correctamente.');
    } 
}

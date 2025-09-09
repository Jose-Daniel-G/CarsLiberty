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

    // public function store(Request $request)
    // {
    //     $request->validate(['dia' => 'required|string|max:20',
    //                         'horario' => 'required|string|max:50',
    //                         'placa' => 'required|string|max:10',]);

    //     PicoyPlaca::create($request->all());

    //     return redirect()->route('admin.picoyplaca.index')
    //         ->with('success', 'Horario creado correctamente.');
    // }

    // public function edit(PicoyPlaca $picoyplaca)
    // {
    //     return view('admin.picoyplaca.edit', compact('picoyplaca'));
    // }

    // public function update(Request $request, PicoyPlaca $picoyplaca)
    // {
    //     $request->validate([
    //         'dia' => 'required|string|max:20',
    //         'horario' => 'required|string|max:50',
    //         'placa' => 'required|string|max:10',
    //     ]);

    //     $picoyplaca->update($request->all());

    //     return redirect()->route('admin.picoyplaca.index')
    //         ->with('success', 'Horario actualizado correctamente.');
    // }
    public function updateAll(Request $request)
    {
        // Elimina o comenta esta línea para permitir que el resto del código se ejecute.
        // dd($request->all());

        // Asegúrate de que los arrays de datos existan
        $horariosInicio = $request->input('horario_inicio', []);
        $horariosFin = $request->input('horario_fin', []);
        $placasReservadas = $request->input('placas_reservadas', []);

        // Itera sobre los IDs de los horarios
        foreach ($horariosInicio as $id => $horarioInicio) {
            $horarioFin = $horariosFin[$id];
            $placas = $placasReservadas[$id];

            // Busca el modelo por su ID y actualiza los campos
            $picoYPlaca = PicoyPlaca::find($id);

            if ($picoYPlaca) {
                $picoYPlaca->update([
                    'horario_inicio' => $horarioInicio,
                    'horario_fin' => $horarioFin,
                    'placas_reservadas' => $placas,
                ]);
            }
        }

        return redirect()->route('admin.picoyplaca.index')
            ->with('success', 'Horarios actualizados correctamente.');
    }

    // public function destroy(PicoyPlaca $picoyplaca)
    // {
    //     $picoyplaca->delete();

    //     return redirect()->route('admin.picoyplaca.index')
    //         ->with('success', 'Horario eliminado correctamente.');
    // }
}

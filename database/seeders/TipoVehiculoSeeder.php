<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TipoVehiculo;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tipos = ['sedan', 'suv', 'pickup', 'hatchback', 'moto'];

        foreach ($tipos as $tipo) {
            // updateOrInsert no busca timestamps (created_at/updated_at) por defecto
            // lo que soluciona tu error anterior.
            DB::table('tipos_vehiculos')->updateOrInsert(
                ['tipo' => $tipo], // Lo que busca para saber si ya existe
                ['tipo' => $tipo]  // Lo que inserta si no lo encuentra
            );
        }

    }
}

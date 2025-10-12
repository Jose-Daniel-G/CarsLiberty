<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cliente = Cliente::where('user_id', 8)->first();
        $asignaciones = [
            ['curso' => 'A1', 'horas_realizadas' => 15], // terminado
            ['curso' => 'B2', 'horas_realizadas' => 20], // terminado
            ['curso' => 'C1', 'horas_realizadas' => 10], // en progreso
        ];

        foreach ($asignaciones as $asig) {
            $curso = Curso::where('nombre', $asig['curso'])->first();

            if ($curso) {
                DB::table('cliente_curso')->updateOrInsert(
                    [
                        'cliente_id' => $cliente->id,
                        'curso_id' => $curso->id,
                    ],
                    [
                        'horas_realizadas' => $asig['horas_realizadas'],
                        'fecha_realizacion' => $asig['horas_realizadas'] >= $curso->horas_requeridas ? now() : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        $this->command->info("✅ Cursos simulados correctamente para el cliente '{$cliente->nombres}' (ID: {$cliente->id})");
    }
}

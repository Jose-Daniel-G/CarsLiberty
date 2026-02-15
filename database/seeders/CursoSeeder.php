<?php

namespace Database\Seeders;

use App\Models\Curso; 
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        //-----------------[ CURSOS ]--------------------------
        Curso::create([
            'nombre' => 'A1',
            'horas_requeridas' => '15',
            'descripcion' => 'Curso de conducción para obtener licencia tipo A1.',
            'estado' => '1',
        ]);
        // Curso::create([
        //     'nombre' => 'A2',
        //     'horas_requeridas' => '20',
        // 'descripcion' => 'Curso de conducción para obtener licencia tipo A2.',
        //     'ubicacion' => '1',
        //     'estado' => '1',
        // ]);
        Curso::create([
            'nombre' => 'B2',
            'horas_requeridas' => '20',
            'descripcion' => 'Curso de conducción para obtener licencia tipo B2.',
            'estado' => '1',
        ]);
        Curso::create([
            'nombre' => 'C1',
            'horas_requeridas' => '30',
            'descripcion' => 'Licencia tipo B1. PARA CARRO PUBLICO',
            'estado' => '1',
        ]);



    }
}

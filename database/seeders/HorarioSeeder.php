<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        /// CREACION DE HORARIOS
        Horario::create([
            'dia' => 'LUNES',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '19:00:00',
            'profesor_id' => '1',
            'curso_id' => '1',
        ]);
        Horario::create([
            'dia' => 'MARTES',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '18:00:00',
            'profesor_id' => '2',
            'curso_id' => '1',
        ]);
        Horario::create([
            'dia' => 'MIERCOLES',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '20:00:00',
            'profesor_id' => '1',
            'curso_id' => '1',
        ]);
        Horario::create([
            'dia' => 'JUEVES',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '14:00:00',
            'profesor_id' => '3',
            'curso_id' => '1',
        ]);
        Horario::create([
            'dia' => 'JUEVES',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '14:00:00',
            'profesor_id' => '1',
            'curso_id' => '2',
        ]);
        Horario::create([
            'dia' => 'VIERNES',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '20:00:00',
            'profesor_id' => '1',
            'curso_id' => '1',
        ]);
        Horario::create([
            'dia' => 'SABADO',
            'hora_inicio' => '6:00:00',
            'hora_fin' => '20:00:00',
            'profesor_id' => '3',
            'curso_id' => '1',
        ]);
    }
}

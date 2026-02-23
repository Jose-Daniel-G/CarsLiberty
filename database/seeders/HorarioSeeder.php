<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\HorarioProfesorCurso;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        // /// CREACION DE HORARIOS
        // Horario::create([                //1
        //     'dia' => 'LUNES',
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '19:00:00',
        //     'profesor_id' => '1',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '1',
        //     'curso_id' => '1',
        //     'profesor_id' => '1',
        // ]);
        // Horario::create([                //2
        //     'dia' => 'MARTES',
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '18:00:00',
        //     'profesor_id' => '2',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '2',
        //     'curso_id' => '1',
        //     'profesor_id' => '2',
        // ]);
        // Horario::create([               //3
        //     'dia' => 'MIERCOLES',
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '20:00:00',
        //     'profesor_id' => '1',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '3',
        //     'curso_id' => '2',
        //     'profesor_id' => '1',
        // ]);
        // Horario::create([               //4
        //     'dia' => 'JUEVES',
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '14:00:00',
        //     'profesor_id' => '3',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '4',
        //     'curso_id' => '3',
        //     'profesor_id' => '3',
        // ]);
        // Horario::create([               //5
        //     'dia' => 'JUEVES',
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '14:00:00',
        //     'profesor_id' => '1',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '5',
        //     'curso_id' => '1',
        //     'profesor_id' => '1',
        // ]);
        // Horario::create([
        //     'dia' => 'VIERNES',           //6
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '20:00:00',
        //     'profesor_id' => '1',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '6',
        //     'curso_id' => '1',
        //     'profesor_id' => '1',
        // ]);
        // Horario::create([
        //     'dia' => 'SABADO',              //7
        //     'hora_inicio' => '6:00:00',
        //     'tiempo' => '20:00:00',
        //     'profesor_id' => '3',
        // ]);
        // HorarioProfesorCurso::create([
        //     'horario_id' => '7',
        //     'curso_id' => '1',
        //     'profesor_id' => '3',
        // ]);

        // 1. Obtenemos los profesores y cursos existentes para evitar IDs manuales
        $profesores = Profesor::all();
        $cursos = Curso::all();

        // Verificación de seguridad: Si no hay datos, no ejecutamos para evitar errores
        if ($profesores->isEmpty() || $cursos->isEmpty()) {
            return;
        }

        // 2. Definimos la estructura de datos que queremos sembrar
        // Usamos el índice del array (0, 1, 2) para referenciar a los profesores/cursos
        $datosHorarios = [
            ['dia' => 'LUNES',     'inicio' => '6:00:00', 'fin' => '19:00:00', 'p_idx' => 0, 'c_idx' => 0],
            ['dia' => 'MARTES',    'inicio' => '6:00:00', 'fin' => '18:00:00', 'p_idx' => 1, 'c_idx' => 0],
            ['dia' => 'MIERCOLES', 'inicio' => '6:00:00', 'fin' => '20:00:00', 'p_idx' => 0, 'c_idx' => 1],
            ['dia' => 'JUEVES',    'inicio' => '6:00:00', 'fin' => '14:00:00', 'p_idx' => 2, 'c_idx' => 2],
            ['dia' => 'VIERNES',   'inicio' => '6:00:00', 'fin' => '20:00:00', 'p_idx' => 0, 'c_idx' => 0],
        ];

        foreach ($datosHorarios as $item) {
            // Buscamos el profesor según el índice, si no existe usamos el primero
            $profesor = $profesores[$item['p_idx']] ?? $profesores->first();
            $curso = $cursos[$item['c_idx']] ?? $cursos->first();

            // Creamos el horario
            $horario = Horario::create([
                'dia' => $item['dia'],
                'hora_inicio' => $item['inicio'],
                'tiempo' => $item['fin'],
                'profesor_id' => $profesor->id,
            ]);

            // Creamos la relación en la tabla pivote
            HorarioProfesorCurso::create([
                'horario_id' => $horario->id,
                'curso_id' => $curso->id,
                'profesor_id' => $profesor->id,
            ]);
        }
    }
}

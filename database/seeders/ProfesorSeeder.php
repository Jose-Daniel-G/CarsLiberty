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
use Illuminate\Support\Facades\Hash;


class ProfesorSeeder extends Seeder
{
    public function run(): void
    {
        //--------------------------------------------]
        // User::create([
        //     'name' => 'Profesor',
        //     'email' => 'profesor@email.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('123123123'),
        // ])->assignRole('profesor');
        // Profesor::create([
        //     'nombres' => 'Profesor',
        //     'apellidos' => 'Lewis',
        //     'telefono' => '4564564565',
        //     'user_id' => '4',
        // ]);

        // User::create([
        //     'name' => 'TEACHER',
        //     'email' => 'profesor1@email.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('123123123'),
        // ])->assignRole('profesor');
        // Profesor::create([
        //     'nombres' => 'TEACHER',
        //     'apellidos' => 'Gallardo',
        //     'telefono' => '432324324',
        //     'user_id' => '5',
        // ]);
        // User::create([
        //     'name' => 'Julio Profe',
        //     'email' => 'profesor2@email.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('123123213'),
        // ])->assignRole('profesor');
        // Profesor::create([
        //     'nombres' => 'Julio Profe',
        //     'apellidos' => 'Valdes',
        //     'telefono' => '123123213',
        //     'user_id' => '6',
        // ]);
        // User::create([
        //     'name' => 'Martin Profe',
        //     'email' => 'profesor3@email.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('123123213'),
        // ])->assignRole('profesor');
        // Profesor::create([
        //     'nombres' => 'Martin Profe',
        //     'apellidos' => 'Valdes',
        //     'telefono' => '123123213',
        //     'user_id' => '7',
        // ]);
        //--------------------------------------------]
        // 1. Gestionar el usuario del profesor
        $user = User::updateOrCreate(
            ['email' => 'profesor@email.com'], // Lo busca por email
            [
                'name' => 'Profesor',
                'email_verified_at' => now(),
                'password' => Hash::make('123123123'),
            ]
        );

        // Asignar rol si no lo tiene
        if (!$user->hasRole('profesor')) {
            $user->assignRole('profesor');
        }

        // 2. Gestionar los datos del modelo Profesor
        Profesor::updateOrCreate(
            ['user_id' => $user->id], // Busca si este usuario ya es profesor
            [
                'nombres' => 'Martin Profe',
                'apellidos' => 'Valdes',
                'telefono' => '123123213',
                'user_id' => '7',
            ]
        );
    }
}

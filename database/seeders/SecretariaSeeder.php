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

class SecretariaSeeder extends Seeder
{
    public function run(): void
    {
         //----------[  SECRETARIA  ]-------------
        //  User::create([
        //     'name' => 'Secretaria',
        //     'email' => 'secretaria@email.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('123123123'),
        // ])->assignRole('secretaria');

        // Secretaria::updateOrCreate([
        //     'nombres' => 'Secretaria',
        //     'apellidos' => 'Catrana',
        //     'cc' => '1112036545',
        //     'celular' => '3147078256',
        //     'fecha_nacimiento' => '22/10/2010',
        //     'direccion' => 'calle 5 o este',
        //     'user_id' => '3',
        // ]);
        // -------------------------------------------------
        // 1. Buscamos por email. Si existe, lo actualiza. Si no, lo crea.
        $user = User::updateOrCreate(
            ['email' => 'secretaria@email.com'], // Condición de búsqueda
            [
                'name' => 'Secretaria',
                'email_verified_at' => now(),
                'password' => Hash::make('123123123'), // Hash es más moderno que bcrypt
            ]
        );

        // Asignamos el rol solo si no lo tiene para evitar duplicados de Spatie
        if (!$user->hasRole('secretaria')) {
            $user->assignRole('secretaria');
        }

        // 2. Creamos la secretaria usando el ID real del usuario recién gestionado
        Secretaria::updateOrCreate(
            ['cc' => '1112036545'], // Buscamos por la Cédula (que suele ser única)
            [
                'nombres' => 'Secretaria',
                'apellidos' => 'Catrana',
                'celular' => '3147078256',
                'fecha_nacimiento' => '2010-10-22', // Ojo: Formato Y-m-d para bases de datos (PostgreSQL/MySQL)
                'direccion' => 'calle 5 o este',
                'user_id' => $user->id, // <--- DINÁMICO, nunca fallará
            ]
        );
    }
}

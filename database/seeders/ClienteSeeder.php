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

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        //--------------------------------------------]
        // -------------[ Cliente ]----------------------
        // Datos de los clientes para iterar y evitar repetir código
        $clientesData = [
            [
                'user' => [
                    'name' => 'Cliente',
                    'email' => 'cliente@email.com',
                ],
                'cliente' => [
                    'nombres' => 'Cliente',
                    'apellidos' => 'alracona',
                    'cc' => '12312753',
                    'genero' => 'M',
                    'celular' => '12395113',
                    'direccion' => 'Cll 9 oeste',
                    'contacto_emergencia' => '65495113',
                    'observaciones' => 'le irrita estar cerca del povo',
                ],
                'cursos' => [1, 2]
            ],
            [
                'user' => [
                    'name' => 'Fancisco Antonio Grijalba',
                    'email' => 'francisco.grijalba@email.com',
                ],
                'cliente' => [
                    'nombres' => 'Fancisco Antonio',
                    'apellidos' => 'Grijalba',
                    'cc' => '23548965',
                    'genero' => 'M',
                    'celular' => '987654321',
                    'direccion' => 'Cll 7 oeste',
                    'contacto_emergencia' => '65495113',
                    'observaciones' => 'migrana',
                ],
                'cursos' => [1, 3]
            ],
            [
                'user' => [
                    'name' => 'ARGEMIRO ESCOBAR GUTIERRES',
                    'email' => 'argemiro.escobar@email.com',
                ],
                'cliente' => [
                    'nombres' => 'ARGEMIRO',
                    'apellidos' => 'ESCOBAR',
                    'cc' => '2354765',
                    'genero' => 'M',
                    'celular' => '987654321',
                    'direccion' => 'Cll 7 oeste',
                    'contacto_emergencia' => '65495113',
                    'observaciones' => 'migrana',
                ],
                'cursos' => [3]
            ],
            [
                'user' => [
                    'name' => 'Gaspar',
                    'email' => 'gaspar@email.com',
                ],
                'cliente' => [
                    'nombres' => 'Gaspar',
                    'apellidos' => 'Ijaji',
                    'cc' => '23547657',
                    'genero' => 'M',
                    'celular' => '987654321',
                    'direccion' => 'Cll 7 oeste',
                    'contacto_emergencia' => '65495113',
                    'observaciones' => 'migrana',
                ],
                'cursos' => [2]
            ],
            [
                'user' => [
                    'name' => 'Juan David Grijalba Osorio',
                    'email' => 'juandavidgo1997@email.com',
                ],
                'cliente' => [
                    'nombres' => 'Juan David',
                    'apellidos' => 'Grijalba Osorio',
                    'cc' => '357986644',
                    'genero' => 'M',
                    'celular' => '314756832',
                    'direccion' => 'Cll 7 oeste',
                    'contacto_emergencia' => '65495113',
                    'observaciones' => 'migrana',
                ],
                'cursos' => [1, 2, 3]
            ],
        ];

        foreach ($clientesData as $data) {
            // 1. Crear o actualizar Usuario
            $user = User::updateOrCreate(
                ['email' => $data['user']['email']],
                [
                    'name' => $data['user']['name'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('123123123'),
                ]
            );

            // Asignar rol al usuario
            if (!$user->hasRole('cliente')) {
                $user->assignRole('cliente');
            }

            // 2. Crear o actualizar Cliente usando el ID real del usuario
            $cliente = Cliente::updateOrCreate(
                ['user_id' => $user->id],
                $data['cliente']
            );

            // 3. Sincronizar cursos (sync evita duplicados en la tabla pivote)
            $cursos = Curso::whereIn('id', $data['cursos'])->get();
            $cliente->cursos()->sync($cursos);
        }

        // --- ESPECTADOR ---
        $espectador = User::updateOrCreate(
            ['email' => 'espectador@email.com'],
            [
                'name' => 'Espectador',
                'email_verified_at' => now(),
                'password' => Hash::make('123123123'),
            ]
        );

        if (!$espectador->hasRole('espectador')) {
            $espectador->assignRole('espectador');
        }

        //-------------[ USUARIOS ]----------------]

        //         User::factory()->create([
        //             'name' => 'Test User',
        //             'email' => 'test@email.com',
        //             'password' => bcrypt('123123123'),
        //         ])->assignRole('usuario');

        //         User::factory()->create([
        //             'name' => 'user',
        //             'email' => 'user@email.com',
        //             'password' => bcrypt('123123123'),
        //         ])->assignRole('usuario');

        //         Curso::create([
        //             'nombre' => 'Curso B1',
        //             'descripcion' => 'Curso de conducción para obtener licencia tipo B1.',
        //             'horas_requeridas' => '11',
        //             'estado' => 'A',
        //         ]);

        //         User::factory(9)->create();
    }
}

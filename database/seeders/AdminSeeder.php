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
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // // User::factory()->create(
        // // User::create(
        // User::updateOrCreate(
        //     ['name'=>'Administrador','email'=>'admin@email.com','email_verified_at'=>now(),'password'=> bcrypt('123123123'),]
        //     )->assignRole('admin');

        // // User::create(
        // User::updateOrCreate(
        //     ['name'=>'JoseDaniel','email'=>'jose.jdgo97@gmail.com','email_verified_at'=>now(),'password' => bcrypt('123123123'),]
        //     )->assignRole('superAdmin');

        // Asegurar que existan los roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'superAdmin']);

        // Crear / actualizar Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@email.com'], // condición
            [
                'name' => 'Administrador',
                'password' => bcrypt('123123123'),
                'email_verified_at' => now(),
            ]
        );

        $admin->syncRoles(['admin']);

        // Crear / actualizar Jose
        $jose = User::updateOrCreate(
            ['email' => 'jose.jdgo97@gmail.com'], // condición
            [
                'name' => 'JoseDaniel',
                'password' => bcrypt('123123123'),
                'email_verified_at' => now(),
            ]
        );

        $jose->syncRoles(['superAdmin']);
    }
}

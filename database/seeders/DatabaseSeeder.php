<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // Storage::deleteDirectory('posts');
        // Storage::makeDirectory('posts');
        $this->call([
            TipoVehiculoSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            SecretariaSeeder::class,
            ProfesorSeeder::class,
            CursoSeeder::class,
            HorarioSeeder::class,
            PicoyPlacaSeeder::class,
            VehiculoSeeder::class,
            ClienteSeeder::class,
        ]);
        // $profesores = Profesor::factory()->count(10)->create();
        // Crear registros de PicoyPlaca antes de crear Vehiculos
        // PicoyPlaca::factory()->count(0)->create(); // Crea 5 registros de PicoyPlaca
        User::factory(9)->create(); // Crea 9 usuarios
        Tag::factory(8)->create();
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        // // Crear vehículos y vincularlos a profesores aleatorios
        // Vehiculo::factory()->count(10)->create([   'usuario_id' => $profesores->random()->id, // Asigna un profesor aleatorio]);
    }
}

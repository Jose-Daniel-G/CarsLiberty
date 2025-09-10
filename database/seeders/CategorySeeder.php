<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = ['Inicio', 'Nosotros', 'Cursos', 'Blog', 'Contacto'];
        $categories = ['accion','crimen','asaltos','infidelidades'];

        foreach ($categories as $name) {
            Category::factory(1)->create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}

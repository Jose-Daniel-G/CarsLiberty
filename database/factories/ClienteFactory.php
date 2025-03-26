<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name(),
            'apellidos' => $this->faker->lastName(),
            'cc' => $this->faker->unique()->numerify('########'),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'celular' => $this->faker->phoneNumber(),
            'correo' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
            // 'grupo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-']),
            // 'alergias' => $this->faker->words(3, true),
            'contacto_emergencia' => $this->faker->phoneNumber(),
            'observaciones' => $this->faker->words(3, true),
        ];
    }
}

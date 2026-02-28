<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profesor;
use App\Models\Cliente;
use App\Models\Curso;
use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'start' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            // 'color' => $this->faker->hexColor(), // O safeColorName()
            'user_id' => \App\Models\User::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'profesor_id' => \App\Models\Profesor::factory(),
            'curso_id' => \App\Models\Curso::factory(),
        ];
    }
}

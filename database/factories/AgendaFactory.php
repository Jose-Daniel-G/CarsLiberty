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
            'start' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'user_id' => User::factory(),
            'profesor_id' => Profesor::factory(),
            'cliente_id' => Cliente::factory(),
            'curso_id' => Curso::factory(),
        ];
    }
}
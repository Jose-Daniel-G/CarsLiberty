<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asistencia>
 */
class AsistenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agenda_id' => \App\Models\Agenda::factory(),
            'asistio' => $this->faker->boolean(),
            'cliente_id' => \App\Models\Cliente::factory(),
            // otros campos...
        ];
    }
}

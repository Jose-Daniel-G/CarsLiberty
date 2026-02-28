<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Agenda;
use App\Models\User;
use App\Models\Profesor;
use App\Models\Cliente;
use App\Models\Curso;
use App\Models\Asistencia;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendaTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos después de cada test

    /** @test */
    public function an_agenda_belongs_to_a_user_profesor_cliente_and_curso()
    {
        // 1. Crear las dependencias
        $user = User::factory()->create();
        $profesor = Profesor::factory()->create();
        $cliente = Cliente::factory()->create();
        $curso = Curso::factory()->create();

        // 2. Crear la Agenda
        $agenda = Agenda::factory()->create([
            'user_id' => $user->id,
            'profesor_id' => $profesor->id,
            'cliente_id' => $cliente->id,
            'curso_id' => $curso->id,
        ]);

        // 3. Verificaciones (Asserts)
        $this->assertInstanceOf(User::class, $agenda->user);
        $this->assertEquals($user->id, $agenda->user->id);

        $this->assertInstanceOf(Profesor::class, $agenda->profesor);
        $this->assertInstanceOf(Cliente::class, $agenda->cliente);
        $this->assertInstanceOf(Curso::class, $agenda->curso);
    }

    /** @test */
    public function an_agenda_has_many_asistencias()
    {
        // 1. Creamos la agenda (esto ya crea un cliente automáticamente por la factory)
        $agenda = Agenda::factory()->create();

        // 2. Creamos las asistencias pasando el cliente_id de esa agenda
        Asistencia::factory()->count(3)->create([
            'agenda_id' => $agenda->id,
            'cliente_id' => $agenda->cliente_id, // <--- ESTO SOLUCIONA EL ERROR
        ]);

        $this->assertCount(3, $agenda->asistencias);
        $this->assertInstanceOf(Asistencia::class, $agenda->asistencias->first());
    }

    /** @test */
    public function agenda_attributes_are_casted_to_datetime()
    {
        $agenda = Agenda::factory()->create([
            'start' => '2023-10-27 10:00:00',
            'end' => '2023-10-27 12:00:00',
        ]);

        // Verificamos que no sean strings, sino objetos Carbon/DateTime
        $this->assertInstanceOf(\DateTime::class, $agenda->start);
        $this->assertInstanceOf(\DateTime::class, $agenda->end);
    }
}

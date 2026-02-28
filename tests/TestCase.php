<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Validation\Rules\Password; // <--- ESTO FALTA
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Configuración inicial para todos los tests.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 1. Evita el error "Vite manifest not found"
        $this->withoutVite();

        // 2. Relaja las reglas de password (lo que ya tenías)
        Password::defaults(function () {
            return Password::min(4);
        });

        // 3. Hace que los tests de login sean más rápidos
        Hash::setRounds(4);
    }
}

<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        // Si estamos en entorno de pruebas, pedimos algo muy simple
        if (app()->environment('testing')) {
            return ['required', 'string', 'min:4', 'confirmed'];
        }
        // return ['required', 'string', Password::default(), 'confirmed'];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_estudiante',
        'email_estudiante',
        'telefono_estudiante',
        'fecha',
        'hora',
        'instructor',
    ];
}

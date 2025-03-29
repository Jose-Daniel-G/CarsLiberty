<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioProfesorCurso extends Model
{
    use HasFactory;
    protected $table = 'horario_profesor_curso';

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}

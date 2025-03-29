<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'profesor_id', 'curso_id'];

    // Relación con Profesor (belongsTo)
    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function horarioProfesorCurso()
    {
        return $this->hasMany(HorarioProfesorCurso::class, 'horario_id');
    }
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_horario');
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    // En el modelo Horario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

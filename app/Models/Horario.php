<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'profesor_id', 'curso_id'];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'horario_profesor_curso', 'horario_id', 'profesor_id');
    }
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'horario_profesor_curso', 'horario_id', 'curso_id');
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

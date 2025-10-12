<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'horas_requeridas', 'estado'];

    public function agenda()                // Uno a muchos
    {
        return $this->hasMany(Agenda::class);
    }
    public function horarioProfesorCurso() // Uno a muchos
    {
        return $this->hasMany(HorarioProfesorCurso::class, 'curso_id');
    }
   
    public function profesores()            // Uno a muchos inversa En el modelo Profesor
    {
        return $this->belongsToMany(Profesor::class, 'horario_profesor_curso', 'curso_id', 'profesor_id');
    }

    public function horarios()              // Muchos a muchos con horarios
    {   return $this->belongsToMany(Horario::class, 'horario_profesor_curso', 'curso_id', 'horario_id');}
    
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_curso', 'curso_id', 'cliente_id')
                    ->withPivot('horas_realizadas', 'fecha_realizacion')
                    ->withTimestamps();
    }

    
    public function historialCursos()
    {
        return $this->hasMany(HistorialCurso::class);
    }
}

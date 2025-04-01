<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'horas_requeridas', 'estado'];

    // En el modelo Profesor
    public function profesores()
    {
<<<<<<< HEAD
        return $this->belongsToMany(Profesor::class, 'horario_profesor_curso', 'curso_id', 'profesor_id');
    }
    
=======
        return $this->belongsToMany(Profesor::class, 'horario_profesor_curso');
    }
    
    // public function profesores()
    // {
    //     return $this->belongsToMany(Profesor::class, 'curso_profesor', 'curso_id', 'profesor_id');
    // }

    // INCIAL
    // public function horarios()
    // {
    //     return $this->hasMany(Horario::class);
    // }
    // TABNINE
    // public function horarios()
    // {
    //     return $this->belongsToMany(Horario::class, 'curso_horario', 'curso_id', 'horario_id');
    // }
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
    // Relación muchos a muchos con horarios
    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'horario_profesor_curso', 'curso_id', 'horario_id');
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function horarioProfesorCurso()
    {
        return $this->hasMany(HorarioProfesorCurso::class, 'curso_id');
    }
    
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'horario_profesor_curso')
            ->withPivot('horas_realizadas');
        // return $this->belongsToMany(Cliente::class, 'cliente_curso', 'curso_id', 'cliente_id');
    }
    public function historialCursos()
    {
        return $this->hasMany(HistorialCurso::class);
    }
}

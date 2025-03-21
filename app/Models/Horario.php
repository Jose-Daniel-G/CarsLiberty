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

    // Relación con Curso (hasMany, aunque esto podría necesitar revisión)
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
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

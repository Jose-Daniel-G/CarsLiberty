<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
    // Relación con el modelo Asistencia
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'evento_id');
    }
}

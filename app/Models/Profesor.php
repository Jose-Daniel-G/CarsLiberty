<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesors';  

    protected $fillable = ['nombres', 'apellidos', 'telefono', 'user_id',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'profesor_id', 'id');
    }
    // Relación muchos a muchos a través de la tabla intermedia 'horario_profesor_curso'
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'horario_profesor_curso', 'profesor_id', 'curso_id');
    }
    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'horario_profesor_curso', 'profesor_id', 'horario_id');
    }
    // public function historial()
    // {
    //     return $this->hasMany(Historial::class);
    // }
    // public function pagos()
    // {
    //     return $this->hasMany(Pago::class);
    // }
}

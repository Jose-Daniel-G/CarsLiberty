<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesors'; // Si la tabla se llama 'profesors'

    protected $fillable=['nombres','apellidos','telefono',
    'user_id',  // Asegúrate de agregarlo aquí
    ];
    // public function cursos()
    // {
    //     return $this->belongsToMany(Curso::class, 'curso_profesor', 'profesor_id', 'curso_id');
    // } 
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor');
    }
    // public function cursos()
    // {
    //     return $this->belongsToMany(Curso::class, 'curso_profesor', 'profesor_id', 'curso_id');
    // }
    public function horarios(){
        return $this->hasMany(Horario::class);
    }
    public function user(){
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
    // public function historial()
    // {
    //     return $this->hasMany(Historial::class);
    // }
    // public function pagos()
    // {
    //     return $this->hasMany(Pago::class);
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Cliente extends Model
{
    use HasRoles, HasFactory;

    protected $table = "clientes";

    protected $guard_name = 'web';
    protected $guarded = ['created_at', 'updated_at'];

    // Relación: Cliente pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    // public function cursos()
    // {
    //     // return $this->belongsToMany(Curso::class, 'cliente_curso');
    //     // return $this->belongsToMany(Curso::class, 'cliente_curso')
    //     // ->withPivot('horas_realizadas', 'fecha_realizacion')
    //     // ->withTimestamps();
    // }
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'cliente_curso')
        ->withPivot('horas_realizadas');
        // return $this->belongsToMany(Curso::class, 'cliente_curso', 'cliente_id', 'curso_id');
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'cliente_id'); // Asegúrate de que 'cliente_id' sea la clave foránea en la tabla asistencias
    }
    
    public function cursosCompletados()
    {
        return $this->hasMany(HistorialCurso::class);
    }
}

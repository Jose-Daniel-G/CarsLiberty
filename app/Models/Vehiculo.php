<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = ['placa','modelo','disponible','tipo_id','profesor_id',];
    
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
    public function tipo()
    {
        return $this->belongsTo(TipoVehiculo::class,  'tipo_id');// Relación de muchos a uno: un vehículo tiene un tipo
    }
    // protected $fillable = ['marca','anio','color', 'pico_y_placa', 'placa','nombre','modelo', 'tipo','disponible',];

    // protected $casts = [ 'anio' => 'integer',     ];
}

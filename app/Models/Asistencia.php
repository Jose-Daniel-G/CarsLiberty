<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event as CalendarEvent;

class Asistencia extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id'); 
    }
    // Relación con el modelo CalendarEvent
    public function event()
    {
        return $this->belongsTo(CalendarEvent::class, 'evento_id');
    }
}

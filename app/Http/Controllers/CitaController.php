<?php

namespace App\Http\Controllers;

use App\Mail\CitaAgendadaMail;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class CitaController extends Controller
{
    public function index()
    {
        return view('citas.create');
    }

    public function store(Request $request)
    {
        $cita = Cita::create($request->all());

        // Enviar correo
        Mail::to($cita->email_estudiante)->send(new CitaAgendadaMail($cita));

        // Enviar WhatsApp
        $this->enviarWhatsApp($cita);

        return back()->with('success', 'Cita agendada correctamente. Se ha enviado notificación por correo y WhatsApp.');
    }

    private function enviarWhatsApp($cita)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $from = "whatsapp:" . env('TWILIO_WHATSAPP_FROM');
        $to = "whatsapp:+57" . $cita->telefono_estudiante; // cambia el prefijo si no es Colombia

        $client = new Client($sid, $token);
        $mensaje = "🚘 Hola {$cita->nombre_estudiante}, tu clase de conducción fue agendada para el {$cita->fecha} a las {$cita->hora} con el instructor {$cita->instructor}. ¡Te esperamos!";

        $client->messages->create($to, [
            'from' => $from,
            'body' => $mensaje
        ]);
    }
}

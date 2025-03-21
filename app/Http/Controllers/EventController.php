<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Config;
use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Event as CalendarEvent;
use App\Models\Horario;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function index() {} public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'profesorid' => 'required|exists:profesors,id',
            'cursoid' => 'required',
            'fecha_reserva' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|numeric|min:1',
            'cliente_id' => 'required_if:role,admin,secretaria' // Asegúrate de que cliente_id si es admin o secretaria
        ]);
        // $data = $request->all();
        // return response()->json($data);
        // Buscar el profesor por su ID
        $profesor = Profesor::find($request->profesorid);
        $fecha_reserva = $request->fecha_reserva;
        $hora_inicio = $request->hora_inicio . ':00';                          // Asegurarse de que la hora esté en formato correcto
        $fecha_hora_inicio = Carbon::parse("{$fecha_reserva} {$hora_inicio}"); // Crear un objeto Carbon para la fecha y hora de inicio
        $fecha_hora_fin = $fecha_hora_inicio->copy()->addHours($request->hora_fin); // Sumamos las horas ingresadas en el campo 'hora_fin'
        $cursoid = $request->cursoid;

        // Obtener el cliente para verificar asistencia
        $cliente_id = Auth::user()->hasRole('superAdmin') || Auth::user()->hasRole('admin') || 
                      Auth::user()->hasRole('secretaria') ? $request->cliente_id : Auth::user()->cliente->id;

        // Verificar si el cliente tiene un evento anterior y si asistió
        $asistencia = Asistencia::join('events', 'asistencias.evento_id', '=', 'events.id')
                    ->select('events.start', 'asistencias.*')
                    ->where('asistencias.cliente_id', $cliente_id) // Filtrar por cliente
                    ->orderBy('events.start', 'desc') // Ordenar por fecha para obtener el evento más reciente
                    ->first(); // Obtener solo el último evento

        // Si hay asistencia y no asistió
        if ($asistencia && $asistencia->asistio === 0) {
        // if ($asistencia && (!$asistencia->asistio || Carbon::parse($asistencia->start)->isFuture())) {
            return redirect()->back()->with([
                'info' => 'No puedes agendar otra clase hasta que contactes con la escuela por faltar a tu último evento.',
                'icono' => 'error',
                'title' => 'Asistencia pendiente',
            ]);
        }

        // Obtener el día de la semana en español
        $dia = date('l', strtotime($fecha_reserva));
        $dia_de_reserva = $this->traducir_dia($dia);

        // Formatear las horas para compararlas en la consulta
        $hora_inicio_formato = $fecha_hora_inicio->format('H:i:s');
        $hora_fin_formato    = $fecha_hora_fin->format('H:i:s');

        // Consultar los horarios disponibles del profesor
        $horarios = Horario::where('profesor_id', $profesor->id)
            ->where('dia', $dia_de_reserva)
            ->where('hora_inicio', '<=', $hora_inicio_formato)
            ->where('hora_fin', '>=', $hora_fin_formato)
            ->exists();

        if (!$horarios) {
            return redirect()->back()->with([
                'info' => 'El profesor no está disponible en ese horario.',
                'icono' => 'error',
                'hora_inicio' => 'El profesor no está disponible en ese horario.',
            ]);
        }

        // Validar si existen eventos duplicados
        $eventos_duplicados = CalendarEvent::where('profesor_id', $profesor->id)
            ->where('start', $fecha_hora_inicio)
            ->where('end', $fecha_hora_fin)->exists();

        if ($eventos_duplicados) {
            return redirect()->back()->with([
                'info' => 'Ya existe una reserva con el mismo profesor en esa fecha y hora.',
                'icono' => 'error',
                'title' => 'Ya existe una reserva con el mismo profesor en esa fecha y hora.',
            ]);
        }

        $curso = Curso::find($cursoid);
        // Crear una nueva instancia de CalendarEvent
        $evento = new CalendarEvent();
        $evento->title = $curso->nombre; // Asegúrate de que estás usando la variable correcta
        $evento->start = $fecha_hora_inicio;
        $evento->end = $fecha_hora_fin;
        $evento->color = '#e82216';
        $evento->profesor_id = $request->profesorid;
        $evento->curso_id = $cursoid;

        if (Auth::user()->hasRole('superAdmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
            $evento->cliente_id = $request->cliente_id; // Cliente id
        } else {
            $evento->cliente_id = Auth::user()->cliente->id; // Cliente id
        }

        $evento->save();
        // Crear una asistencia por defecto como inasistencia
        Asistencia::create([
            'cliente_id' => $evento->cliente_id,
            'evento_id' => $evento->id,
            'asistio' => false,  // Inasistencia por defecto
            'penalidad' => 20000*$request->hora_fin,  // Penalidad por inasistencia
            'liquidado' => false,
            'fecha_pago_multa' => null,
        ]);
        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.index')->with(['title', 'Se ha agendado de forma correcta.'
            ,'info', 'Recuerda que no puedes faltar a tu clase, si faltas a las clases sin justificación se cobran 20 mil pesos por hora no vista.'
            ,'icono', 'success'] );
    }

    private function traducir_dia($dia)
    {
        $dias = ['Monday' => 'LUNES','Tuesday' => 'MARTES','Wednesday' => 'MIERCOLES','Thursday' => 'JUEVES','Friday' => 'VIERNES','Saturday' => 'SABADO','Sunday' => 'DOMINGO',];
        return $dias[$dia] ?? $dias;
    }

    public function show(Request $request)
    {
        try {
            // $events = CalendarEvent::all(); // Cambia esto según la lógica que necesites
            $events = CalendarEvent::with('profesor', 'cliente')->get(); // Carga la relación 'profesor'

            return response()->json($events); // Devuelve todos los eventos
        } catch (\Exception $e) {
            \Log::error($e); // Loguea el error para diagnóstico
            return response()->json(['error' => 'Error al obtener eventos'], 500);
        }
    }


    public function update(Request $request, CalendarEvent $event)
    {
        $validatedData = $request->validate(['profesor_id' => 'required', 'hora_inicio' => 'required', 'fecha_reserva' => 'required|date']);
        $event->update($validatedData);
        return response()->json(['message' => 'Evento actualizado correctamente']);
    }

    public function destroy(CalendarEvent $evento)
    {
        $evento->delete(); 
        return redirect()->back()->with(['mensaje' => 'Se eliminó la reserva de manera correcta','icono' => 'success',]);
    }
    ///================ [ NO SE ESTAN USANDO ]================

    // public function reportes(){
    //     return view('admin.reservas.reportes');
    // }

    // public function pdf()
    // {
    //     $configuracion = Config::latest()->first();
    //     $eventos = CalendarEvent::all();

    //     $pdf = Pdf::loadView('admin.reservas.pdf', compact('configuracion', 'eventos'));

    //     // Incluir la numeración de páginas y el pie de página
    //     $pdf->output();
    //     $dompdf = $pdf->getDomPDF();
    //     $canvas = $dompdf->getCanvas();
    //     $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
    //     $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
    //     $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y') . " - " . \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0, 0, 0));


    //     return $pdf->stream();
    // }

    // public function pdf_fechas(Request $request){
    //     //$datos = request()->all();
    //     //return response()->json($datos);

    //     $configuracion = Configuracione::latest()->first();

    //     $fecha_inicio = $request->input('fecha_inicio');
    //     $fecha_fin = $request->input('fecha_fin');

    //     $eventos = CalendarEvent::whereBetween('start',[$fecha_inicio, $fecha_fin])->get();

    //     $pdf = \PDF::loadView('admin.reservas.pdf_fechas', compact('configuracion','eventos','fecha_inicio','fecha_fin'));

    //     // Incluir la numeración de páginas y el pie de página
    //     $pdf->output();
    //     $dompdf = $pdf->getDomPDF();
    //     $canvas = $dompdf->getCanvas();
    //     $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
    //     $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
    //     $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));


    //     return $pdf->stream();
    // }
}

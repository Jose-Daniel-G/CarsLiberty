<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">Hora</th>
                @php
                    $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
                @endphp
                @foreach ($diasSemana as $dia)
                    <th scope="col">{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $horas = [
                    '06:00 am - 07:00 am',
                    '07:00 am - 08:00 am',
                    '08:00 am - 09:00 am',
                    '09:00 am - 10:00 am',
                    '10:00 am - 11:00 am',
                    '11:00 am - 12:00 pm', 
                    '01:00 pm - 02:00 pm',
                    '02:00 pm - 03:00 pm',
                    '03:00 pm - 04:00 pm',
                    '04:00 pm - 05:00 pm',
                    '05:00 pm - 06:00 pm',
                    '06:00 pm - 07:00 pm',
                    '07:00 pm - 08:00 pm',
                ];
            @endphp

            @foreach ($horas as $hora)
                @php
                    [$hora_inicio, $tiempo] = explode(' - ', $hora);
                    $hora_inicio_24 = date('H:i', strtotime($hora_inicio));
                    $hora_fin_24 = date('H:i', strtotime($tiempo));
                @endphp
                <tr>
                    <td scope="row" class="fw-bold">{{ $hora }}</td>

                    @foreach ($diasSemana as $dia)
                        @php
                            $curso_mostrado = '';
                            $agendado = false;
                            $es_del_usuario = false;

                            // 🔹 Verifica si hay curso disponible en este bloque (solapamiento flexible)
                            foreach ($horarios as $horario) {
                                $horario_inicio_24 = date('H:i', strtotime($horario->hora_inicio));
                                $horario_fin_24 = date('H:i', strtotime($horario->tiempo));

                                if (
                                    strtoupper($horario->dia) == $dia &&
                                    $hora_inicio_24 < $horario_fin_24 && // Se cruza con el bloque actual
                                    $hora_fin_24 > $horario_inicio_24
                                ) {
                                    // Muestra todos los cursos disponibles
                                    $curso_mostrado = $horario->cursos->pluck('nombre')->join(', ');
                                    break;
                                }
                            }

                            // 🔹 Verifica si hay curso agendado (resaltado de color)
                            foreach ($horarios_asignados as $horario_asignado) {
                                $asignado_inicio_24 = date('H:i', strtotime($horario_asignado->hora_inicio));
                                $asignado_fin_24 = date('H:i', strtotime($horario_asignado->tiempo));
                                $asignado_dia = strtoupper($horario_asignado->dia);

                                if (
                                    $asignado_dia == $dia &&
                                    $hora_inicio_24 < $asignado_fin_24 &&
                                    $hora_fin_24 > $asignado_inicio_24
                                ) {
                                    $agendado = true;
                                    $es_del_usuario = auth()->user()->id == $horario_asignado->user_id;
                                    $curso_mostrado = $horario_asignado->curso_nombre ?? $curso_mostrado;
                                    break;
                                }
                            }

                            // 🔹 Define el color de la celda
                            $clase = '';
                             $contenido = $curso_mostrado;
                            if ($agendado) {
                                $clase = $es_del_usuario ? 'table-success' : 'table-primary';
                            } elseif ($curso_mostrado) {
                                // Badge para horarios disponibles (no agendados)
                                $contenido = '<span class="badge badge-pill badge-light border border-dark">' . e($curso_mostrado) . '</span>';;
                            }
                        @endphp

                        <td class="{{ $clase }}  text-center">{!! $contenido !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="alert alert-primary d-inline-block me-2 p-2"><strong>Azul:</strong> Ocupado (otro cliente)</div>
    <div class="alert alert-success d-inline-block me-2 p-2"><strong>Verde:</strong> Agendado por ti</div>
    <div class="alert alert-light border border-dark text-center d-inline-block me-2 p-2"><strong>Blanco:</strong> Disponible</div>
</div>

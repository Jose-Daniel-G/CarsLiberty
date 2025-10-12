
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Hora</th>
                        @php
                            $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
                        @endphp
                        @foreach ($diasSemana as $dia)
                            <th>{{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $bloques = [
                            '06:00 am - 07:00 am','07:00 am - 08:00 am','08:00 am - 09:00 am','09:00 am - 10:00 am',
                            '10:00 am - 11:00 am','11:00 am - 12:00 pm','12:00 pm - 01:00 pm','01:00 pm - 02:00 pm',
                            '02:00 pm - 03:00 pm','03:00 pm - 04:00 pm','04:00 pm - 05:00 pm','05:00 pm - 06:00 pm',
                            '06:00 pm - 07:00 pm','07:00 pm - 08:00 pm',
                        ];
                    @endphp

                    @foreach ($bloques as $bloque)
                        @php
                            [$inicio_label, $fin_label] = explode(' - ', $bloque);
                            $inicio_24 = date('H:i:s', strtotime($inicio_label));
                            $fin_24 = date('H:i:s', strtotime($fin_label));
                        @endphp
                        <tr>
                            <td><strong>{{ $bloque }}</strong></td>

                            @foreach ($diasSemana as $dia)
                                @php
                                    $celda_texto = '—';
                                    $clase_celda = '';

                                    // Verificar si hay disponibilidad
                                    $disponible = collect($horarios)->first(function ($h) use ($dia, $inicio_24, $fin_24) {
                                        return $h['dia'] === $dia &&
                                               $inicio_24 >= $h['hora_inicio'] &&
                                               $fin_24 <= $h['tiempo'];
                                    });

                                    if ($disponible) {
                                        $curso_nombre = $disponible['cursos'][0]['nombre'] ?? '';
                                        $celda_texto = $curso_nombre ?: 'Disponible';
                                        $clase_celda = 'table-warning';
                                    }

                                    // Verificar si está agendado
                                    foreach ($horarios_asignados as $asignado) {
                                        if ($asignado->dia === $dia) {
                                            $asig_inicio = date('H:i:s', strtotime($asignado->hora_inicio));
                                            $asig_fin = date('H:i:s', strtotime($asignado->tiempo));

                                            if ($inicio_24 < $asig_fin && $fin_24 > $asig_inicio) {
                                                // Se solapa
                                                $celda_texto = 'AGENDADO';
                                                $clase_celda = auth()->check() && auth()->id() == $asignado->user_id
                                                    ? 'table-success'
                                                    : 'table-primary';
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                <td class="{{ $clase_celda }}">{{ $celda_texto }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <div class="alert alert-primary d-inline-block me-2 p-2"><strong>Azul:</strong> Ocupado (otro cliente)</div>
            <div class="alert alert-success d-inline-block me-2 p-2"><strong>Verde:</strong> Agendado por ti</div>
            <div class="alert alert-warning d-inline-block me-2 p-2"><strong>Amarillo:</strong> Disponible</div>
        </div>
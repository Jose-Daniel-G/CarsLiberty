{{-- Verifica los datos que están llegando a la vista --}}
{{-- <pre>{{ print_r($horarios, true)}}</pre>    --}}
{{-- <pre>    {{ print_r($cursos_profesor, true) }}</pre>    --}}
{{-- <pre>   {{ print_r($horarios_asignados, true) }} </pre>  --}}
{{-- <pre>{{ json_encode($horarios, JSON_PRETTY_PRINT) }}</pre> --}}

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
                    '06:00 am - 07:00 am','07:00 am - 08:00 am',// 2 hours
                    '08:00 am - 09:00 am','09:00 am - 10:00 am',
                    '10:00 am - 11:00 am','11:00 am - 12:00 pm',
                    '12:00 pm - 01:00 pm','01:00 pm - 02:00 pm',
                    '02:00 pm - 03:00 pm','03:00 pm - 04:00 pm',
                    '04:00 pm - 05:00 pm','05:00 pm - 06:00 pm',
                    '06:00 pm - 07:00 pm','07:00 pm - 08:00 pm',
                ];
            @endphp

            @foreach ($horas as $hora)
                @php
                    [$hora_inicio, $hora_fin] = explode(' - ', $hora);
                    $hora_inicio_24 = date('H:i:s', strtotime($hora_inicio));
                    $hora_fin_24 = date('H:i:s', strtotime($hora_fin));
                @endphp
                <tr>
                    <td scope="row">{{ $hora }}</td>
                    @foreach ($diasSemana as $dia)
                        @php
                            $curso_mostrado = '';
                            $agendado = false; // Inicializa la variable $agendado en false

                            foreach ($horarios as $horario) {
                                $horario_inicio_24 = date('H:i', strtotime($horario->hora_inicio));
                                $horario_fin_24 = date('H:i', strtotime($horario->hora_fin));

                                if (
                                    strtoupper($horario->dia) == $dia &&
                                    $hora_inicio_24 >= $horario->hora_inicio &&
                                    $hora_fin_24 <= $horario->hora_fin
                                ) {
                                    $curso_mostrado = $horario->cursos->pluck('nombre')->join(', ');

                                    foreach ($horarios_asignados as $horario_asignado) {
                                        $asignado_inicio_24 = date('H:i', strtotime($horario_asignado->hora_inicio));
                                        $asignado_fin_24 = date('H:i', strtotime($horario_asignado->hora_fin));
                                        $asignado_dia = strtoupper($horario_asignado->dia);
                                        $agendado = false;
                                        // Comparación con mayor flexibilidad (solapamiento)
                                        if (
                                            $asignado_dia == $dia &&
                                            $hora_inicio_24 < $asignado_fin_24 &&
                                            $hora_fin_24 > $asignado_inicio_24
                                        ) {
                                            $agendado = true; // Cambia a verdadero si hay coincidencia
                                            $es_del_usuario = auth()->user()->id == $horario_asignado->user_id;
                                            break; // Salir del bucle si se encuentra coincidencia
                                        }
                                    }
                                    break;
                                }
                            }
                        @endphp
                        {{-- <td class="{{ $curso_mostrado ? 'table-success' : '' }}"> --}}
                        <td class="{{ $agendado ? ($es_del_usuario ? 'table-success' : 'table-primary') : '' }}">

                            {{ $curso_mostrado }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

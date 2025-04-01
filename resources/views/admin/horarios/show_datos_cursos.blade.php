{{-- Verifica los datos que están llegando a la vista --}}
<<<<<<< HEAD
{{-- <pre>{{ print_r($horarios, true)}}</pre>    --}}
{{-- <pre>    {{ print_r($cursos_profesor, true) }}</pre>    --}}
{{-- <pre>   {{ print_r($horarios_asignados, true) }} </pre>  --}}
{{-- <pre>{{ json_encode($horarios, JSON_PRETTY_PRINT) }}</pre> --}}

=======
{{-- <pre>{{ print_r($horarios, true) }}
    {{ print_r('asigndos'.$horarios_asignados, true) }}</pre> --}}
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
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
                    '06:00 am - 07:00 am', '07:00 am - 08:00 am', '08:00 am - 09:00 am',
                    '09:00 am - 10:00 am', '10:00 am - 11:00 am', '11:00 am - 12:00 pm',
                    '12:00 pm - 01:00 pm', '01:00 pm - 02:00 pm', '02:00 pm - 03:00 pm',
                    '03:00 pm - 04:00 pm', '04:00 pm - 05:00 pm', '05:00 pm - 06:00 pm',
                    '06:00 pm - 07:00 pm', '07:00 pm - 08:00 pm'
                ];
<<<<<<< HEAD
=======

                // Función auxiliar para verificar solapamientos
                function tieneSolapamiento($hora_inicio, $hora_fin, $evento_inicio, $evento_fin)
                {
                    return $hora_inicio < $evento_fin && $hora_fin > $evento_inicio;
                }
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
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
<<<<<<< HEAD
                            $curso_mostrado = '';
                            foreach ($horarios as $horario) {
                                if (
                                    strtoupper($horario->dia) == $dia &&
                                    $hora_inicio_24 >= $horario->hora_inicio &&
                                    $hora_fin_24 <= $horario->hora_fin
                                ) {
                                    $curso_mostrado = $horario->cursos->pluck('nombre')->join(', ');
                                    break;
                                }
                            }
                        @endphp
                        <td class="{{ $curso_mostrado ? 'table-success' : '' }}">
                            {{ $curso_mostrado }}
=======
                            $nombre_profesor = '';
                            $agendado = false;
                            $course_name = '';
                            $es_del_usuario = '';

                            foreach ($cursos_profesor as $curso) {
                                foreach ($curso->horarios as $horario) {
                                    $horario_inicio_24 = date('H:i', strtotime($horario->hora_inicio));
                                    $horario_fin_24 = date('H:i', strtotime($horario->hora_fin));

                                    if (
                                        strtoupper($horario->dia) == $dia &&
                                        $hora_inicio_24 >= $horario_inicio_24 &&
                                        $hora_fin_24 <= $horario_fin_24
                                    ) {
                                        $nombre_profesor = $horario->profesor->nombres;
                                        $course_name = ' - ' . $curso->nombre;

                                        foreach ($horarios_asignados as $horario_asignado) {
                                            $asignado_inicio_24 = date(
                                                'H:i',
                                                strtotime($horario_asignado->hora_inicio),
                                            );
                                            $asignado_fin_24 = date('H:i', strtotime($horario_asignado->hora_fin));
                                            $asignado_dia = strtoupper($horario_asignado->dia);

                                            if (
                                                $asignado_dia == $dia &&
                                                $hora_inicio_24 < $asignado_fin_24 &&
                                                $hora_fin_24 > $asignado_inicio_24
                                            ) {
                                                $agendado = true;
                                                $es_del_usuario = auth()->user()->id == $horario_asignado->user_id;
                                                break;
                                            }
                                        }
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <td class="{{ $agendado ? ($es_del_usuario ? 'table-success' : 'table-primary') : '' }}">
                             {{ $course_name }}
>>>>>>> 70c0c682aa3c2ca1bef3774c65d098efdad0d0a6
                        </td>
                    @endforeach
                </tr>
            @endforeach

        </tbody>
    </table>
</div>


    
    
    
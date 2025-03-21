{{-- Verifica los datos que están llegando a la vista --}}
<pre>
    {{-- {{ print_r($horarios, true) }}
    {{ print_r('asigndos'.$horarios_asignados, true) }} --}}
</pre><div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">Hora</th>
                <th scope="col">Lunes</th>
                <th scope="col">Martes</th>
                <th scope="col">Miércoles</th>
                <th scope="col">Jueves</th>
                <th scope="col">Viernes</th>
                <th scope="col">Sábado</th>
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
                    '12:00 pm - 01:00 pm',
                    '01:00 pm - 02:00 pm',
                    '02:00 pm - 03:00 pm',
                    '03:00 pm - 04:00 pm',
                    '04:00 pm - 05:00 pm',
                    '05:00 pm - 06:00 pm',
                    '06:00 pm - 07:00 pm',
                    '07:00 pm - 08:00 pm',
                ];
                $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
            @endphp

            @foreach ($horas as $hora)
                @php
                    [$hora_inicio, $hora_fin] = explode(' - ', $hora);
                    $hora_inicio_24 = date('H:i', strtotime($hora_inicio));
                    $hora_fin_24 = date('H:i', strtotime($hora_fin));
                @endphp
                <tr>
                    <td scope="row">{{ $hora }}</td>
                    @foreach ($diasSemana as $dia)
                        @php
                            $nombre_profesor = '';
                            $agendado = false; // Inicializa la variable $agendado en false
                            $course_name = '';
                            // Recorremos los horarios disponibles
                            foreach ($horarios as $horario) {
                                $horario_inicio_24 = date('H:i', strtotime($horario->hora_inicio));
                                $horario_fin_24 = date('H:i', strtotime($horario->hora_fin));
                                
                                
                                // Comparar los horarios
                                if (
                                    strtoupper($horario->dia) == $dia &&
                                    $hora_inicio_24 >= $horario_inicio_24 &&
                                    $hora_fin_24 <= $horario_fin_24
                                ) {
                                    // $nombre_profesor = $horario->profesor->nombres . ' ' . $horario->profesor->apellidos;
                                    $nombre_profesor = $horario->profesor->nombres;
                                    $course_name= " - ".$horario->curso->nombre;
                                    // Verificamos si está agendado
                                    foreach ($horarios_asignados as $horario_asignado) {
                                        $asignado_inicio_24 = date('H:i', strtotime($horario_asignado->hora_inicio));
                                        $asignado_fin_24 = date('H:i', strtotime($horario_asignado->hora_fin));
                                        $asignado_dia = strtoupper($horario_asignado->dia);

                                        // Comparación con mayor flexibilidad (solapamiento)
                                        if (
                                            $asignado_dia == $dia &&
                                            $hora_inicio_24 < $asignado_fin_24 && 
                                            $hora_fin_24 > $asignado_inicio_24
                                        ) {
                                            $agendado = true; // Cambia a verdadero si hay coincidencia
                                            $es_del_usuario = auth()->check() && auth()->user()->id == $horario_asignado->user_id;
                                            break; // Salir del bucle si se encuentra coincidencia
                                        }
                                    }
                                    break; // Salir del bucle si se encuentra el profesor adecuado
                                }
                            }
                        @endphp
                                    <td class="{{ $agendado ? ($es_del_usuario ? 'table-success' : 'table-primary') : '' }}">
                                        {{ $nombre_profesor }} 
                                        {{ $course_name }}
                                    </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
                    '06:00 am - 07:00 am', '07:00 am - 08:00 am', '08:00 am - 09:00 am',
                    '09:00 am - 10:00 am', '10:00 am - 11:00 am', '11:00 am - 12:00 pm',
                    '12:00 pm - 01:00 pm', '01:00 pm - 02:00 pm', '02:00 pm - 03:00 pm',
                    '03:00 pm - 04:00 pm', '04:00 pm - 05:00 pm', '05:00 pm - 06:00 pm',
                    '06:00 pm - 07:00 pm', '07:00 pm - 08:00 pm'
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
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    
    
    
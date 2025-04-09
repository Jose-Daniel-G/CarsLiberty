<?php

namespace App\Helpers;

class DateHelper
{
    public static function traducirDia($dia)
    {
        $dias = [
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SABADO',
            'Sunday' => 'DOMINGO',
        ];
        return $dias[$dia] ?? $dia; 
    }

    public static function getCurrentMonthRange()
    {
        $today = now();
        return [
            'firstDay' => $today->startOfMonth()->toDateString(),
            'lastDay' => $today->endOfMonth()->toDateString(),
        ];
    }
}

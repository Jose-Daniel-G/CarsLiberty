<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Traducir nombre del día (en inglés a español)
     */
    public static function traducirDia($dia)
    {
        $dias = [
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIÉRCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SÁBADO',
            'Sunday' => 'DOMINGO',
        ];
        return $dias[$dia] ?? strtoupper($dia);
    }

    /**
     * Obtener primer y último día del mes actual
     */
    public static function getCurrentMonthRange()
    {
        $today = now();
        return [
            'firstDay' => $today->copy()->startOfMonth()->toDateString(),
            'lastDay' => $today->copy()->endOfMonth()->toDateString(),
        ];
    }

    /**
     * Verifica si una fecha dada está dentro del mes actual
     */
    public static function isInCurrentMonth($date)
    {
        $carbonDate = Carbon::parse($date);
        return $carbonDate->isSameMonth(now());
    }

    /**
     * Convierte una fecha a formato legible (Ej: "10 de Octubre de 2025")
     */
    public static function formatoLargo($fecha)
    {
        $carbon = Carbon::parse($fecha);
        return $carbon->translatedFormat('d \d\e F \d\e Y');
    }

    /**
     * Devuelve el día de la semana en español de una fecha dada
     */
    public static function diaSemana($fecha)
    {
        return strtoupper(Carbon::parse($fecha)->translatedFormat('l'));
    }

    /**
     * Devuelve el rango de una semana específica (lunes - domingo)
     */
    public static function getWeekRange($date = null)
    {
        $date = $date ? Carbon::parse($date) : now();
        return [
            'startOfWeek' => $date->copy()->startOfWeek()->toDateString(),
            'endOfWeek' => $date->copy()->endOfWeek()->toDateString(),
        ];
    }

    /**
     * Retorna cuántos días faltan entre hoy y una fecha dada
     */
    public static function diasRestantes($fecha)
    {
        return now()->diffInDays(Carbon::parse($fecha), false);
    }
    
}

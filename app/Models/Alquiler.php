<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    /**
     * Precio diario de cada tipo de seguro.
     *
     * @var array<string, float>
     */
    public const TARIFAS_SEGURO = [
        'Básico' => 175.0,
        'Completo' => 350.0,
        'Premium' => 500.0,
        'Sin seguro' => 0.0,
    ];

    /**
     * Recargo diario en lempiras cuando la devolucion supera la fecha prevista.
     */
    public const RECARGO_POR_DIA = 250.0;

    protected $fillable = [
        'matricula',
        'dni',
        'fecha_inicio',
        'fecha_devolucion_prevista',
        'fecha_devolucion_real',
        'duracion_dias',
        'tipo_seguro',
        'precio_total',
        'recargo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_devolucion_prevista' => 'date',
        'fecha_devolucion_real' => 'date',
        'duracion_dias' => 'integer',
        'precio_total' => 'decimal:2',
        'recargo' => 'decimal:2',
    ];
}

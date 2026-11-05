<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
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

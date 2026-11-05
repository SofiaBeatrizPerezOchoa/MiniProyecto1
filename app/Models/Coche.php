<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    protected $fillable = [
        'matricula',
        'grupo',
        'marca',
        'modelo',
        'numero_puertas',
        'numero_plazas',
        'capacidad_maletero',
        'edad_minima',
        'codigo_oficina',
        'estado',
    ];
}

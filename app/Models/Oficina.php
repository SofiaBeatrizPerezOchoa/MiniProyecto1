<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $fillable = [
        'codigo_oficina',
        'ciudad',
        'calle',
        'numero',
        'codigo_postal',
        'telefono',
    ];
}

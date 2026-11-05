<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'DNI';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'DNI',
        'nombre',
        'direccion',
        'telefono',
        'tarjeta_credito',
    ];
}

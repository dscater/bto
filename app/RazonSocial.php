<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
    protected $fillable = [
        'codigo', 'nombre', 'alias', 'ciudad', 'dir',
        'nro_aut', 'fono', 'cel', 'casilla', 'correo', 'logo',
        'actividad_economica'
    ];
}

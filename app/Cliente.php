<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'apellidos', 'ci', 'ci_exp', 'email', 'fono', 'cel',
        'dir', 'foto', 'empresa', 'fecha_registro', 'estado'
    ];
}

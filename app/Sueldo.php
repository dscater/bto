<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sueldo extends Model
{
    protected $fillable = [
        'empleado_id', 'sueldo', 'moneda', 'tipo_pago',
        'fecha_registro'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

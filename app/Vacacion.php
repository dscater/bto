<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    protected $fillable = [
        'empleado_id', 'fecha', 'fecha_registro'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

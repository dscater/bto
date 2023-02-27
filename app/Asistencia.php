<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'empleado_id', 'hora_inicio', 'hora_fin', 'fecha', 'fecha_registro'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

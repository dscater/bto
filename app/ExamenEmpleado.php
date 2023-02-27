<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenEmpleado extends Model
{
    protected $fillable = [
        'examen_id', 'empleado_id', 'resultado', 'fecha'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

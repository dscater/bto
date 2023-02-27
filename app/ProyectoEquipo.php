<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoEquipo extends Model
{
    protected $fillable = [
        'proyecto_id', 'empleado_id'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

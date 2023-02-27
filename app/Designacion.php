<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designacion extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'designacion_id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class, 'designacion_id');
    }
}

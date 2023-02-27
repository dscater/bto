<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'departamento_id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class, 'departamento_id');
    }
}

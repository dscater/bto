<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'empresa_id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class, 'empresa_id');
    }
}

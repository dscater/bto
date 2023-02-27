<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $fillable = [
        'empresa_id', 'departamento_id', 'designacion_id',
        'nombre', 'fecha_registro', 'estado'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function designacion()
    {
        return $this->belongsTo(Designacion::class, 'designacion_id');
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'examen_id');
    }

    public function examenEmpleados()
    {
        return $this->hasMany(ExamenEmpleado::class, 'examen_id');
    }
}

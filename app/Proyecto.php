<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre', 'cliente_id', 'fecha_ini', 'fecha_fin', 'tarifa',
        'prioridad', 'lider_proyecto', 'descripcion', 'archivo', 'fecha_registro',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function lider()
    {
        return $this->belongsTo(Empleado::class, 'lider_proyecto');
    }

    public function equipo()
    {
        return $this->hasMany(ProyectoEquipo::class, 'proyecto_id');
    }

    public function actividads()
    {
        return $this->hasMany(Actividad::class, 'proyecto_id');
    }
}

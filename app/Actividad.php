<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $fillable = [
        'proyecto_id', 'nombre', 'archivo', 'empresa_adjudicado', 'monto', 'estado', 'fecha_registro'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}

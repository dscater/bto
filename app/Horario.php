<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable =  [
        'empleado_id', 'dia', 
        'hi_lu','hf_lu',
        'hi_mar','hf_mar',
        'hi_mier','hf_mier',
        'hi_jue','hf_jue',
        'hi_vier','hf_vier',
        'hi_sa','hf_sa',
        'hi_do','hf_do',
        'horas_trabajo',
        'fecha_registro'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = [
        'examen_id', 'descripcion', 'a', 'b', 'c', 'd', 'respuesta', 'valor'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
    }
}

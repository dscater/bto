<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci', 'ci_exp',
        'dir', 'email', 'fono', 'cel', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

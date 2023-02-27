<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci',
        'ci_exp', 'codigo_empleado', 'fecha_ingreso',
        'fono', 'cel', 'dir', 'email', 'empresa_id',
        'departamento_id', 'designacion_id',
        'estado', 'fecha_registro', 'user_id'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function horario()
    {
        return $this->hasOne(Horario::class, 'empleado_id');
    }

    public function sueldo()
    {
        return $this->hasOne(Sueldo::class, 'empleado_id');
    }

    public function equipo()
    {
        return $this->hasMany(ProyectoEquipo::class, 'empleado_id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'empleado_id');
    }

    public function vacacions()
    {
        return $this->hasMany(Vacacion::class, 'empleado_id');
    }

    public function examens()
    {
        return $this->hasMany(ExamenEmpleado::class, 'empleado_id');
    }
}

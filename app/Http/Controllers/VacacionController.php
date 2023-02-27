<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vacacion;
use App\Empleado;

class VacacionController extends Controller
{
    public function index(Empleado $empleado)
    {
        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();
        return view('vacacions.index', compact('empleados'));
    }

    public function store(Request $request)
    {
        $empleado = Empleado::find($request->ie);
        Vacacion::create([
            'empleado_id' => $empleado->id,
            'fecha' => $request->fecha,
            'fecha_registro' => date('Y-m-d')
        ]);

        return response()->JSON([
            'sw' => true,
        ]);
    }

    public function vacacions_empleado(Empleado $empleado)
    {
        return view('vacacions.vacacions_empleado', compact('empleado'));
    }

    public function fechas_vacacions(Empleado $empleado)
    {
        $vacacions = $empleado->vacacions;
        $fechas = [];
        foreach ($vacacions as $value) {
            $fechas[] = [
                'id' => $value->id,
                'title' => 'Vacación',
                'start' => $value->fecha,
                'color' => '#667eea',
                'textColor' => '#ffffff',
                'elimina' => route('vacacions.destroy', $value->id)
            ];
        }
        return response()->JSON($fechas);
    }

    public function destroy(Vacacion $vacacion)
    {
        $vacacion->delete();
        return \response()->JSON([
            'sw' => true
        ]);
    }
}

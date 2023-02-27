<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Horario;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        return view('horarios.index', compact('empleados'));
    }

    public function horarios_empleado(Empleado $empleado)
    {
        $comprueba = Horario::where('empleado_id', $empleado->id)->get()->first();
        if ($comprueba) {
            $horario = $empleado->horario;
            return view('horarios.horarios_empleado', compact('empleado', 'horario'));
        } else {
            $horario = Horario::create([
                'empleado_id' => $empleado->id,
                'horas_trabajo' => 0,
                'fecha_registro' => date('Y-m-d'),
            ]);
        }
        return view('horarios.horarios_empleado', compact('empleado', 'horario'));
    }

    public function update(Horario $horario, Request $request)
    {
        $index = $request->index;
        $horario[$index] = $request->valor;
        $horario->save();
        if ($request->ajax()) {
            return response()->json([
                'sw' => true,
                'valor' => $horario[$index]
            ]);
        }
        return redirect()->route('horarios.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Horario $horario)
    {
        return 'mostrar cargo';
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('bien', 'Registro eliminado correctamente');
    }
}

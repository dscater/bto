<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sueldo;
use App\Empleado;

class SueldoController extends Controller
{
    public function index()
    {
        $sueldos = Sueldo::all();

        // $empleados = DB::select("SELECT e.id, e.nombre, e.paterno, e.materno 
        // FROM empleados e JOIN users u ON e.user_id = u.id
        // WHERE u.estado = 1
        // AND NOT EXISTS(SELECT * FROM sueldos WHERE empleado_id = e.id);
        // ");

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        $array_empleados[''] = 'Seleccione...';
        foreach ($empleados as $empleado) {
            $array_empleados[$empleado->id] = $empleado->nombre . ' ' . $empleado->paterno . ' ' . $empleado->materno;
        }

        return view('sueldos.index', compact('sueldos', 'array_empleados'));
    }

    public function create()
    {
        return view('sueldos.create');
    }

    public function store(Request $request)
    {
        $comprueba = Sueldo::where('empleado_id', $request->empleado_id)->get()->first();
        if ($comprueba) {
            return redirect()->route('sueldos.index')->with('info', 'El empleado que seleccionó ya tiene un sueldo asignado');
        }

        $request['fecha_registro'] = date('Y-m-d');
        Sueldo::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('sueldos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Sueldo $sueldo)
    {
        return view('sueldos.edit', compact('sueldo'));
    }

    public function update(Sueldo $sueldo, Request $request)
    {
        $sueldo->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('sueldos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Sueldo $sueldo)
    {
        return 'mostrar cargo';
    }

    public function destroy(Sueldo $sueldo)
    {
        $sueldo->delete();
        return redirect()->route('sueldos.index')->with('bien', 'Registro eliminado correctamente');
    }
}

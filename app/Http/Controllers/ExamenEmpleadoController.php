<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Empleado;
use App\Examen;
use App\ExamenEmpleado;
use App\Pregunta;

class ExamenEmpleadoController extends Controller
{
    public function index(Empleado $empleado)
    {
        $completos = $empleado->examens;
        $designacion = $empleado->designacion->id;
        $examens = DB::select("SELECT e.* FROM examens e 
            WHERE e.designacion_id = $designacion
            AND e.estado = 1
            AND NOT EXISTS(SELECT * FROM examen_empleados ee WHERE ee.empleado_id = $empleado->id AND ee.examen_id = e.id)
            ");

        return view('examen_empleados.index', compact('empleado', 'completos', 'examens'));
    }

    public function evaluacion(Examen $examen)
    {
        return view('examen_empleados.examen', compact('examen'));
    }

    public function evaluacion_store(Request $request)
    {
        $nueva_evaluacion = new ExamenEmpleado([
            'examen_id' => $request->ei,
            'empleado_id' => $request->emi,
            'resultado' => 0,
            'fecha' => date('Y-m-d')
        ]);

        $preguntas = $request->pregunta;
        $resultado_total = 0;
        if (count($preguntas) > 0) {
            for ($i = 0; $i < count($preguntas); $i++) {
                $pregunta = Pregunta::find($preguntas[$i]);
                if($request['resp'.$pregunta->id]){
                    if($request['resp'.$pregunta->id] == $pregunta->respuesta){
                        $resultado_total += $pregunta->valor;
                    }  
                }
            }
        }
        $nueva_evaluacion->resultado = $resultado_total;

        $nueva_evaluacion->save();
        return redirect()->route('examen_empleados.index', $request->emi)->with('bien', 'Registro realizado con éxito');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Actividad;
use App\Asistencia;
use App\Horario;
use App\Empleado;
use App\Proyecto;
use App\Examen;
use App\ExamenEmpleado;
use DateTime;

class KPIController extends Controller
{
    public function cantidad_empleados(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));

        $estado = $request->estado;

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $empleados = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('empleados.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->get();
                    break;
                case 'estado':
                    if ($estado != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('users.estado', 1)
                            ->where('empleados.estado', $estado)
                            ->get();
                        break;
                    }
            }
        }

        return response()->JSON([
            'sw' => true,
            'cantidad_empleados' => count($empleados)
        ]);
    }

    public function horas_trabajadas_empleados(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $empresa = $request->empresa;
        $departamento = $request->departamento;
        $designacion = $request->designacion;
        $empleado = $request->empleado;

        $asistencias = Asistencia::select('asistencias.*')
            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $asistencias = Asistencia::whereBetween('fecha', [$fecha_ini, $fecha_fin])->get();
                    break;
                case 'empresa':
                    if ($empresa != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('users.estado', 1)
                            ->where('empleados.empresa_id', $empresa)
                            ->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('users.estado', 1)
                            ->where('empleados.departamento_id', $departamento)
                            ->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('users.estado', 1)
                            ->where('empleados.designacion_id', $designacion)
                            ->get();
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('users.estado', 1)
                            ->where('empleados.id', $empleado)
                            ->get();
                    }
                    break;
            }
        }

        $cantidad_horas = 0;
        foreach ($asistencias as $value) {
            $horario = Horario::where('empleado_id', $value->empleado->id)->get()->first();
            if ($value->hora_fin != '' && $value->hora_fin != null) {
                //obtener el horario de salida del empleado del dia
                $hora_salida = null;
                $dia = date('w', strtotime($value->fecha));
                switch ($dia) {
                    case 0:
                        $hora_salida = $horario->hf_do;
                        break;
                    case 1:
                        $hora_salida = $horario->hf_lu;
                        break;
                    case 2:
                        $hora_salida = $horario->hf_mar;
                        break;
                    case 3:
                        $hora_salida = $horario->hf_mier;
                        break;
                    case 4:
                        $hora_salida = $horario->hf_jue;
                        break;
                    case 5:
                        $hora_salida = $horario->hf_vier;
                        break;
                    case 6:
                        $hora_salida = $horario->hf_sa;
                        break;
                }

                $fecha1 = new DateTime($value->fecha . ' ' . $value->hora_fin); //fecha inicial
                $fecha2 = new DateTime($value->fecha . ' ' . $hora_salida); //fecha cierre
                $intervalo = $fecha1->diff($fecha2);
                $cantidad_horas += (int)$horario->horas_trabajo + (int)$intervalo->h;
            } else {
                $cantidad_horas += (int)$horario->horas_trabajo;
            }
        }

        return response()->JSON([
            'sw' => true,
            'cantidad_horas' => $cantidad_horas
        ]);
    }

    public function ingresos_economicos(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $empresa = $request->empresa;
        $departamento = $request->departamento;
        $designacion = $request->designacion;
        $empleado = $request->empleado;

        $proyectos = Proyecto::where('estado', 1)->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $proyectos = Proyecto::where('estado', 1)->whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])->get();
                    break;
                case 'empresa':
                    if ($empresa != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.empresa_id', $empresa)
                            ->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.departamento_id', $departamento)
                            ->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.designacion_id', $designacion)
                            ->get();
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.id', $empleado)
                            ->get();
                    }
                    break;
            }
        }

        $total_ingresos = 0;
        foreach ($proyectos as $value) {
            $total_ingresos += (float)$value->tarifa;
        }

        return response()->JSON([
            'sw' => true,
            'total_ingresos' => (float)(number_format($total_ingresos, 2, ".", ""))
        ]);
    }

    public function capacitacion_examen(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $empresa = $request->empresa;
        $departamento = $request->departamento;
        $designacion = $request->designacion;
        $empleado = $request->empleado;

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'empresa':
                    if ($empresa != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.empresa_id', $empresa)
                            ->where('users.estado', 1)
                            ->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.departamento_id', $departamento)
                            ->where('users.estado', 1)
                            ->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.designacion_id', $designacion)
                            ->where('users.estado', 1)
                            ->get();
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.id', $empleado)
                            ->where('users.estado', 1)
                            ->get();
                    }
                    break;
            }
        }

        $total_empleados = count($empleados);

        $examens = Examen::where('estado', 1)->get();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'empresa':
                    if ($empresa != 'todos') {
                        $examens = Examen::where('empresa_id', $empresa)->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $examens = Examen::where('departamento_id', $departamento)->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $examens = Examen::where('designacion_id', $designacion)->get();
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        $_empleado = Empleado::find($empleado);
                        $examens = Examen::where('designacion_id', $_empleado->designacion_id)->get();
                    }
                    break;
            }
        }

        $total_examenes = count($examens);

        $total_capacitacion = 0;
        foreach ($examens as $examen) {
            $examen_empleados = ExamenEmpleado::where('examen_id', $examen->id)->get();
            if ($filtro != 'todos') {
                switch ($filtro) {
                    case 'fecha':
                        $examen_empleados = ExamenEmpleado::where('examen_id', $examen->id)
                            ->whereBetween('fecha', [$fecha_ini, $fecha_fin])->get();
                    case 'empresa':
                        if ($empresa != 'todos') {
                            $examen_empleados = ExamenEmpleado::select('examen_empleados.*')
                                ->join('examens', 'examens.id', '=', 'examen_empleados.examen_id')
                                ->where('examens.empresa_id', $empresa)
                                ->where('examen_empleados.examen_id', $examen->id)
                                ->get();
                        }
                        break;
                    case 'departamento':
                        if ($departamento != 'todos') {
                            $examen_empleados = ExamenEmpleado::select('examen_empleados.*')
                                ->join('examens', 'examens.id', '=', 'examen_empleados.examen_id')
                                ->where('examens.departamento_id', $departamento)
                                ->where('examen_empleados.examen_id', $examen->id)
                                ->get();
                        }
                        break;
                    case 'designacion':
                        if ($designacion != 'todos') {
                            $examen_empleados = ExamenEmpleado::select('examen_empleados.*')
                                ->join('examens', 'examens.id', '=', 'examen_empleados.examen_id')
                                ->where('examens.designacion_id', $designacion)
                                ->where('examen_empleados.examen_id', $examen->id)
                                ->get();
                        }
                        break;
                    case 'empleado':
                        if ($empleado != 'todos') {
                            $examen_empleados = ExamenEmpleado::select('examen_empleados.*')
                                ->join('examens', 'examens.id', '=', 'examen_empleados.examen_id')
                                ->where('examen_empleados.empleado_id', $empleado)
                                ->where('examen_empleados.examen_id', $examen->id)
                                ->get();
                        }
                        break;
                }
            }
            if ($total_empleados > 0) {
                $total_capacitacion += (count($examen_empleados) / $total_empleados) * 100;
            }
        }

        if ($total_examenes > 0) {
            $total_capacitacion = $total_capacitacion / $total_examenes;
        } else {
            $total_capacitacion = 0;
        }

        return response()->JSON([
            'sw' => true,
            'total_capacitacion' => number_format($total_capacitacion, 2)
        ]);
    }

    public function asistencia_empleados(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $empresa = $request->empresa;
        $departamento = $request->departamento;
        $designacion = $request->designacion;
        $empleado = $request->empleado;

        $asistencias = Asistencia::select('asistencias.*')
            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $asistencias = Asistencia::select('asistencias.*')
                        ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->whereBetween('asistencias.fecha', [$fecha_ini, $fecha_fin])->get();
                    break;
                case 'empresa':
                    if ($empresa != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.empresa_id', $empresa)
                            ->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.departamento_id', $departamento)
                            ->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.designacion_id', $designacion)
                            ->get();
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        $asistencias = Asistencia::select('asistencias.*')
                            ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('empleados.id', $empleado)
                            ->get();
                    }
                    break;
            }
        }

        $total_asistencias = count($asistencias);
        return response()->JSON([
            'sw' => true,
            'total_asistencias' => number_format($total_asistencias, 2)
        ]);
    }

    public function progreso_proyectos(Request $request)
    {
        $filtro = $request->filtro;
        $empresa = $request->empresa;
        $departamento = $request->departamento;
        $designacion = $request->designacion;
        $proyecto = $request->proyecto;

        $proyectos = Proyecto::where('estado', 1)->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'empresa':
                    if ($empresa != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.empresa_id', $empresa)
                            ->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.departamento_id', $departamento)
                            ->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.designacion_id', $designacion)
                            ->get();
                    }
                    break;
                case 'proyecto':
                    if ($proyecto != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->where('proyectos.estado', 1)
                            ->where('proyectos.id', $proyecto)
                            ->get();
                    }
                    break;
            }
        }

        $total_progreso = 0;
        $cont_proyectos = 0;
        foreach ($proyectos as $proyecto) {
            $porcentaje = 0;
            $tareas = Actividad::where('proyecto_id', $proyecto->id)->get();
            if (count($tareas) > 0) {
                $tareas_completos = Actividad::where('proyecto_id', $proyecto->id)->where('estado', 'COMPLETO')->get();
                $porcentaje = (count($tareas_completos) * 100) / count($tareas);
            }
            $total_progreso += $porcentaje;
            $cont_proyectos++;
        }

        if ($cont_proyectos > 0) {
            $total_progreso = $total_progreso / $cont_proyectos;
        } else {
            $total_progreso = 0;
        }

        return response()->JSON([
            'sw' => true,
            'total_progreso' => number_format($total_progreso, 2)
        ]);
    }

    public function ganancia_empleados(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $proyecto = $request->proyecto;
        $empleado = $request->empleado;

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $empleados = Empleado::select('empleados.*')
                        ->join('proyectos', 'proyectos.lider_proyecto', '=', 'empleados.id')
                        ->where('proyectos.estado', 1)
                        ->whereBetween('proyectos.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->get();

                    $empleados_equipo = Empleado::select('empleados.*')
                        ->join('proyecto_equipos', 'proyecto_equipos.empleado_id', '=', 'empleados.id')
                        ->join('proyectos', 'proyectos.id', '=', 'proyecto_equipos.proyecto_id')
                        ->where('proyectos.estado', 1)
                        ->whereBetween('proyectos.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->get();
                    if (count($empleados_equipo) > 0) {
                        foreach ($empleados_equipo as $ee) {
                            $empleados[] = $ee;
                        }
                    }
                    break;
                case 'proyecto':
                    if ($proyecto != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('proyectos', 'proyectos.lider_proyecto', '=', 'empleados.id')
                            ->where('proyectos.estado', 1)
                            ->where('proyectos.id', $proyecto)
                            ->get();

                        $empleados_equipo = Empleado::select('empleados.*')
                            ->join('proyecto_equipos', 'proyecto_equipos.empleado_id', '=', 'empleados.id')
                            ->join('proyectos', 'proyectos.id', '=', 'proyecto_equipos.proyecto_id')
                            ->where('proyectos.estado', 1)
                            ->where('proyectos.id', $proyecto)
                            ->get();
                        if (count($empleados_equipo) > 0) {
                            foreach ($empleados_equipo as $ee) {
                                $empleados[] = $ee;
                            }
                        }
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        $empleados = Empleado::select('empleados.*')
                            ->join('proyectos', 'proyectos.lider_proyecto', '=', 'empleados.id')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.id', $empleado)
                            ->get();
                    }
                    break;
            }
        }

        $ganancia_total = 0;
        $cont = 0;
        foreach ($empleados as $empleado) {
            $sueldo = $empleado->sueldo;
            if ($sueldo) {
                if ($sueldo->moneda == 'DÓLARES') {
                    $ganancia_total += ((float)$sueldo->sueldo * 6.96);
                } else {
                    $ganancia_total += (float)$sueldo->sueldo;
                }
                $cont++;
            }
        }

        return response()->JSON([
            'sw' => true,
            'ganancia_total' => number_format($ganancia_total, 2, '.', '')
        ]);
    }

    public function progreso_actividades(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $empresa = $request->empresa;
        $departamento = $request->departamento;
        $designacion = $request->designacion;
        $empleado = $request->empleado;

        $proyectos = Proyecto::where('estado', 1)->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $proyectos = Proyecto::select('proyectos.*')
                        ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                        ->where('proyectos.estado', 1)
                        ->whereBetween('proyectos.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->get();
                    break;
                case 'empresa':
                    if ($empresa != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.empresa_id', $empresa)
                            ->get();
                    }
                    break;
                case 'departamento':
                    if ($departamento != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.departamento_id', $departamento)
                            ->get();
                    }
                    break;
                case 'designacion':
                    if ($designacion != 'todos') {
                        $proyectos = Proyecto::select('proyectos.*')
                            ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                            ->where('proyectos.estado', 1)
                            ->where('empleados.designacion_id', $designacion)
                            ->get();
                    }
                    break;
                case 'empleado':
                    if ($empleado != 'todos') {
                        //obtener los proyectos en los que esta incluido
                        $proyectos = Proyecto::select('proyectos.*')
                            ->where('proyectos.estado', 1)
                            ->where('proyectos.lider_proyecto', $empleado)
                            ->get();

                        $proyectos_equipo = Proyecto::select('proyectos.*')
                            ->join('proyecto_equipos', 'proyecto_equipos.proyecto_id', '=', 'proyectos.id')
                            ->where('proyectos.estado', 1)
                            ->where('proyecto_equipos.empleado_id', $empleado)
                            ->get();
                        if (count($proyectos_equipo) > 0) {
                            foreach ($proyectos_equipo as $pe) {
                                $proyectos[] = $pe;
                            }
                        }
                    }
                    break;
            }
        }

        $total_progreso = 0;
        $cont_proyectos = 0;
        foreach ($proyectos as $proyecto) {
            $porcentaje = 0;
            $tareas = Actividad::where('proyecto_id', $proyecto->id)->get();
            if (count($tareas) > 0) {
                $tareas_completos = Actividad::where('proyecto_id', $proyecto->id)->where('estado', 'COMPLETO')->get();
                $porcentaje = (count($tareas_completos) * 100) / count($tareas);
            }
            $total_progreso += $porcentaje;
            $cont_proyectos++;
        }

        if ($cont_proyectos > 0) {
            $total_progreso = $total_progreso / $cont_proyectos;
        } else {
            $total_progreso = 0;
        }

        return response()->JSON([
            'sw' => true,
            'total_progreso' => number_format($total_progreso, 2)
        ]);
    }
}

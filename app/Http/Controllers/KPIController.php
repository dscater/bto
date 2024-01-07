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
use Illuminate\Support\Facades\Log;

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

        $empleados = count(Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get());
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $empleados = count(Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('empleados.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->get());
                    break;
                case 'pronostico':
                    $fechas1 = ["", ""];
                    $fechas2 = ["", ""];
                    $fechas3 = ["", ""];

                    // obtener las fechas de pronostico
                    $fechas_pronostico = self::getFechasPronostico();
                    $fechas1 = $fechas_pronostico["fechas1"];
                    $fechas2 = $fechas_pronostico["fechas2"];
                    $fechas3 = $fechas_pronostico["fechas3"];

                    $empleados1 = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('empleados.fecha_registro', [$fechas1[0], $fechas1[1]])
                        ->get();
                    $empleados2 = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('empleados.fecha_registro', [$fechas2[0], $fechas2[1]])
                        ->get();
                    $empleados3 = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('empleados.fecha_registro', [$fechas3[0], $fechas3[1]])
                        ->get();

                    $total = count($empleados1) + count($empleados2) + count($empleados3);
                    $total = $total / 3;
                    $empleados = number_format($total, 2, ".", "");
                    break;
                case 'estado':
                    if ($estado != 'todos') {
                        $empleados = count(Empleado::select('empleados.*')
                            ->join('users', 'users.id', '=', 'empleados.user_id')
                            ->where('users.estado', 1)
                            ->where('empleados.estado', $estado)
                            ->get());
                        break;
                    }
            }
        }
        return response()->JSON([
            'sw' => true,
            'cantidad_empleados' => $empleados
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

        if ($filtro == 'pronostico') {
            $fechas1 = ["", ""];
            $fechas2 = ["", ""];
            $fechas3 = ["", ""];

            // obtener las fechas de pronostico
            $fechas_pronostico = self::getFechasPronostico();
            $fechas1 = $fechas_pronostico["fechas1"];
            $fechas2 = $fechas_pronostico["fechas2"];
            $fechas3 = $fechas_pronostico["fechas3"];

            $asistencias1 = Asistencia::whereBetween('fecha', [$fechas1[0], $fechas1[1]])->get();
            $asistencias2 = Asistencia::whereBetween('fecha', [$fechas2[0], $fechas2[1]])->get();
            $asistencias3 = Asistencia::whereBetween('fecha', [$fechas3[0], $fechas3[1]])->get();

            $cantidad_horas1 = self::getHorasTrabajadas($asistencias1);
            $cantidad_horas2 = self::getHorasTrabajadas($asistencias2);
            $cantidad_horas3 = self::getHorasTrabajadas($asistencias3);

            $cantidad_horas = ($cantidad_horas1 + $cantidad_horas2 + $cantidad_horas3) / 3;
            $cantidad_horas = number_format($cantidad_horas, 2, ".", "");
        } else {
            $cantidad_horas = self::getHorasTrabajadas($asistencias);
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
        if ($filtro == 'pronostico') {
            $fechas1 = ["", ""];
            $fechas2 = ["", ""];
            $fechas3 = ["", ""];

            // obtener las fechas de pronostico
            $fechas_pronostico = self::getFechasPronostico();
            $fechas1 = $fechas_pronostico["fechas1"];
            $fechas2 = $fechas_pronostico["fechas2"];
            $fechas3 = $fechas_pronostico["fechas3"];

            $proyectos1 = Proyecto::where('estado', 1)->whereBetween('fecha_registro', [$fechas1[0], $fechas1[1]])->get();
            $proyectos2 = Proyecto::where('estado', 1)->whereBetween('fecha_registro', [$fechas2[0], $fechas2[1]])->get();
            $proyectos3 = Proyecto::where('estado', 1)->whereBetween('fecha_registro', [$fechas3[0], $fechas3[1]])->get();


            $total_ingresos1 = 0;
            foreach ($proyectos1 as $value) {
                $total_ingresos1 += (float)$value->tarifa;
            }
            $total_ingresos2 = 0;
            foreach ($proyectos2 as $value) {
                $total_ingresos2 += (float)$value->tarifa;
            }
            $total_ingresos3 = 0;
            foreach ($proyectos3 as $value) {
                $total_ingresos3 += (float)$value->tarifa;
            }

            $total_ingresos = ($total_ingresos1 + $total_ingresos2 + $total_ingresos3) / 3;
        } else {
            $total_ingresos = 0;
            foreach ($proyectos as $value) {
                $total_ingresos += (float)$value->tarifa;
            }
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

        $total_empleados = count($empleados);
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
        if ($filtro == 'pronostico') {
            $fechas1 = ["", ""];
            $fechas2 = ["", ""];
            $fechas3 = ["", ""];

            // obtener las fechas de pronostico
            $fechas_pronostico = self::getFechasPronostico();
            $fechas1 = $fechas_pronostico["fechas1"];
            $fechas2 = $fechas_pronostico["fechas2"];
            $fechas3 = $fechas_pronostico["fechas3"];

            $total_capacitacion1 = 0;
            $total_capacitacion2 = 0;
            $total_capacitacion3 = 0;
            foreach ($examens as $examen) {
                $examen_empleados1 = ExamenEmpleado::where('examen_id', $examen->id)
                    ->whereBetween('fecha', [$fechas1[0], $fechas1[1]])->get();
                $examen_empleados2 = ExamenEmpleado::where('examen_id', $examen->id)
                    ->whereBetween('fecha', [$fechas2[0], $fechas2[1]])->get();
                $examen_empleados3 = ExamenEmpleado::where('examen_id', $examen->id)
                    ->whereBetween('fecha', [$fechas3[0], $fechas3[1]])->get();

                if ($total_empleados > 0) {
                    $total_capacitacion1 += (count($examen_empleados1) / $total_empleados) * 100;
                    $total_capacitacion2 += (count($examen_empleados2) / $total_empleados) * 100;
                    $total_capacitacion3 += (count($examen_empleados3) / $total_empleados) * 100;
                }
            }

            $total_capacitacion = ($total_capacitacion1 + $total_capacitacion2 + $total_capacitacion3) / 3;
        } else {
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

        $total_asistencias = 0;
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'fecha':
                    $asistencias = Asistencia::select('asistencias.*')
                        ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->whereBetween('asistencias.fecha', [$fecha_ini, $fecha_fin])->get();
                    break;
                case 'pronostico':
                    $fechas1 = ["", ""];
                    $fechas2 = ["", ""];
                    $fechas3 = ["", ""];

                    // obtener las fechas de pronostico
                    $fechas_pronostico = self::getFechasPronostico();
                    $fechas1 = $fechas_pronostico["fechas1"];
                    $fechas2 = $fechas_pronostico["fechas2"];
                    $fechas3 = $fechas_pronostico["fechas3"];

                    $asistencias1 = count(Asistencia::select('asistencias.*')
                        ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->whereBetween('asistencias.fecha', [$fechas1[0], $fechas1[1]])->get());

                    $asistencias2 = count(Asistencia::select('asistencias.*')
                        ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->whereBetween('asistencias.fecha', [$fechas2[0], $fechas2[1]])->get());

                    $asistencias3 = count(Asistencia::select('asistencias.*')
                        ->join('empleados', 'empleados.id', '=', 'asistencias.empleado_id')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->whereBetween('asistencias.fecha', [$fechas3[0], $fechas3[1]])->get());

                    $total_asistencias = ($asistencias1 + $asistencias2 + $asistencias3) / 3;
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

        if ($filtro != 'pronostico') {
            $total_asistencias = count($asistencias);
        }
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

        if ($filtro == 'pronostico') {
            $fechas1 = ["", ""];
            $fechas2 = ["", ""];
            $fechas3 = ["", ""];

            // obtener las fechas de pronostico
            $fechas_pronostico = self::getFechasPronostico();
            $fechas1 = $fechas_pronostico["fechas1"];
            $fechas2 = $fechas_pronostico["fechas2"];
            $fechas3 = $fechas_pronostico["fechas3"];

            // INICIO 1
            $empleados = Empleado::select('empleados.*')
                ->join('proyectos', 'proyectos.lider_proyecto', '=', 'empleados.id')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas1[0], $fechas1[1]])
                ->get();

            $empleados_equipo = Empleado::select('empleados.*')
                ->join('proyecto_equipos', 'proyecto_equipos.empleado_id', '=', 'empleados.id')
                ->join('proyectos', 'proyectos.id', '=', 'proyecto_equipos.proyecto_id')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas1[0], $fechas1[1]])
                ->get();
            if (count($empleados_equipo) > 0) {
                foreach ($empleados_equipo as $ee) {
                    $empleados[] = $ee;
                }
            }

            $ganancia_total1 = 0;
            $cont = 0;
            foreach ($empleados as $empleado) {
                $sueldo = $empleado->sueldo;
                if ($sueldo) {
                    if ($sueldo->moneda == 'DÓLARES') {
                        $ganancia_total1 += ((float)$sueldo->sueldo * 6.96);
                    } else {
                        $ganancia_total1 += (float)$sueldo->sueldo;
                    }
                    $cont++;
                }
            }
            // FIN 1

            // INICIO 2
            $empleados = Empleado::select('empleados.*')
                ->join('proyectos', 'proyectos.lider_proyecto', '=', 'empleados.id')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas2[0], $fechas2[1]])
                ->get();

            $empleados_equipo = Empleado::select('empleados.*')
                ->join('proyecto_equipos', 'proyecto_equipos.empleado_id', '=', 'empleados.id')
                ->join('proyectos', 'proyectos.id', '=', 'proyecto_equipos.proyecto_id')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas2[0], $fechas2[1]])
                ->get();
            if (count($empleados_equipo) > 0) {
                foreach ($empleados_equipo as $ee) {
                    $empleados[] = $ee;
                }
            }

            $ganancia_total2 = 0;
            $cont = 0;
            foreach ($empleados as $empleado) {
                $sueldo = $empleado->sueldo;
                if ($sueldo) {
                    if ($sueldo->moneda == 'DÓLARES') {
                        $ganancia_total2 += ((float)$sueldo->sueldo * 6.96);
                    } else {
                        $ganancia_total2 += (float)$sueldo->sueldo;
                    }
                    $cont++;
                }
            }
            // FIN 2

            // INICIO 3
            $empleados = Empleado::select('empleados.*')
                ->join('proyectos', 'proyectos.lider_proyecto', '=', 'empleados.id')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas3[0], $fechas3[1]])
                ->get();

            $empleados_equipo = Empleado::select('empleados.*')
                ->join('proyecto_equipos', 'proyecto_equipos.empleado_id', '=', 'empleados.id')
                ->join('proyectos', 'proyectos.id', '=', 'proyecto_equipos.proyecto_id')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas3[0], $fechas3[1]])
                ->get();
            if (count($empleados_equipo) > 0) {
                foreach ($empleados_equipo as $ee) {
                    $empleados[] = $ee;
                }
            }

            $ganancia_total3 = 0;
            $cont = 0;
            foreach ($empleados as $empleado) {
                $sueldo = $empleado->sueldo;
                if ($sueldo) {
                    if ($sueldo->moneda == 'DÓLARES') {
                        $ganancia_total3 += ((float)$sueldo->sueldo * 6.96);
                    } else {
                        $ganancia_total3 += (float)$sueldo->sueldo;
                    }
                    $cont++;
                }
            }
            // FIN 3
            $ganancia_total  = ($ganancia_total1 + $ganancia_total2 + $ganancia_total3) / 3;
        } else {
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

        if ($filtro == 'pronostico') {
            $fechas1 = ["", ""];
            $fechas2 = ["", ""];
            $fechas3 = ["", ""];

            // obtener las fechas de pronostico
            $fechas_pronostico = self::getFechasPronostico();
            $fechas1 = $fechas_pronostico["fechas1"];
            $fechas2 = $fechas_pronostico["fechas2"];
            $fechas3 = $fechas_pronostico["fechas3"];

            // PROYECTOS 1
            $proyectos = Proyecto::select('proyectos.*')
                ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas1[0], $fechas1[1]])
                ->get();
            $cont_proyectos = 0;
            $total_progreso1 = 0;
            foreach ($proyectos as $proyecto) {
                $porcentaje = 0;
                $tareas = Actividad::where('proyecto_id', $proyecto->id)->get();
                if (count($tareas) > 0) {
                    $tareas_completos = Actividad::where('proyecto_id', $proyecto->id)->where('estado', 'COMPLETO')->get();
                    $porcentaje = (count($tareas_completos) * 100) / count($tareas);
                }
                $total_progreso1 += $porcentaje;
                $cont_proyectos++;
            }

            if ($cont_proyectos > 0) {
                $total_progreso1 = $total_progreso1 / $cont_proyectos;
            } else {
                $total_progreso1 = 0;
            }
            // FIN 1

            // PROYECTOS 2
            $proyectos = Proyecto::select('proyectos.*')
                ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas2[0], $fechas2[1]])
                ->get();
            $cont_proyectos = 0;
            $total_progreso2 = 0;
            foreach ($proyectos as $proyecto) {
                $porcentaje = 0;
                $tareas = Actividad::where('proyecto_id', $proyecto->id)->get();
                if (count($tareas) > 0) {
                    $tareas_completos = Actividad::where('proyecto_id', $proyecto->id)->where('estado', 'COMPLETO')->get();
                    $porcentaje = (count($tareas_completos) * 100) / count($tareas);
                }
                $total_progreso2 += $porcentaje;
                $cont_proyectos++;
            }

            if ($cont_proyectos > 0) {
                $total_progreso2 = $total_progreso2 / $cont_proyectos;
            } else {
                $total_progreso2 = 0;
            }
            // FIN 2

            // PROYECTOS 3
            $proyectos = Proyecto::select('proyectos.*')
                ->join('empleados', 'empleados.id', '=', 'proyectos.lider_proyecto')
                ->where('proyectos.estado', 1)
                ->whereBetween('proyectos.fecha_registro', [$fechas3[0], $fechas3[1]])
                ->get();
            $cont_proyectos = 0;
            $total_progreso3 = 0;
            foreach ($proyectos as $proyecto) {
                $porcentaje = 0;
                $tareas = Actividad::where('proyecto_id', $proyecto->id)->get();
                if (count($tareas) > 0) {
                    $tareas_completos = Actividad::where('proyecto_id', $proyecto->id)->where('estado', 'COMPLETO')->get();
                    $porcentaje = (count($tareas_completos) * 100) / count($tareas);
                }
                $total_progreso3 += $porcentaje;
                $cont_proyectos++;
            }

            if ($cont_proyectos > 0) {
                $total_progreso3 = $total_progreso3 / $cont_proyectos;
            } else {
                $total_progreso3 = 0;
            }
            // FIN 3
            $total_progreso = ($total_progreso1 + $total_progreso2 + $total_progreso3) / 3;
        } else {
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
        }

        return response()->JSON([
            'sw' => true,
            'total_progreso' => number_format($total_progreso, 2)
        ]);
    }

    public static function getFechasPronostico()
    {
        // restar menos 90 dias y empezar a armar
        $fecha_actual = date("Y-m-d");
        $fecha_inicial = date("Y-m-d", strtotime($fecha_actual . "-90 days"));

        $fechas1[0] = date("Y-m-d", strtotime($fecha_inicial));
        $fechas1[1] = date("Y-m-d", strtotime($fecha_inicial . "+30 days"));

        $fechas2[0] = date("Y-m-d", strtotime($fecha_inicial . "+31 days"));
        $fechas2[1] = date("Y-m-d", strtotime($fecha_inicial . "+60 days"));

        $fechas3[0] = date("Y-m-d", strtotime($fecha_inicial . "+61 days"));
        $fechas3[1] = date("Y-m-d", strtotime($fecha_inicial . "+90 days"));

        $fechas_pronostico = [
            "fechas1" => $fechas1,
            "fechas2" => $fechas2,
            "fechas3" => $fechas3,
        ];

        return $fechas_pronostico;
    }

    public static function getHorasTrabajadas($asistencias)
    {
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
        return number_format($cantidad_horas, 2, ".", "");
    }
}

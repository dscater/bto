<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Empleado;
use App\Asistencia;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        if ($request->ajax()) {
            $nom_empleado = $request->nom_empleado;
            $mes = $request->mes;
            $anio = $request->anio;
            $fecha = $anio . '-' . $mes . '-01';
            $dias = date('t', \strtotime($fecha));
            if ($nom_empleado != '') {
                $empleados = Empleado::select('empleados.*')
                    ->join('users', 'users.id', '=', 'empleados.user_id')
                    ->where('users.estado', 1)
                    ->where(DB::raw('CONCAT(empleados.nombre, empleados.paterno, empleados.materno)'), 'LIKE', "%$nom_empleado%")
                    ->get();
            }

            $header = '<th>Empleado</th>';
            for ($i = 1; $i <= $dias; $i++) {
                $header .= '<th>' . $i . '</th>';
            }

            $fila_html = '';
            foreach ($empleados as $empleado) {
                $fila_html .= '<tr>';
                $fila_html .= '<td>
                                <h2 class="table-avatar">
                                <a class="avatar avatar-xs" href="' . route('empleados.show', $empleado->id) . '"><img alt="" src="' . asset('imgs/users/' . $empleado->user->foto) . '"></a>
                                <a href="' . route('empleados.show', $empleado->id) . '">' . $empleado->nombre . ' ' . $empleado->paterno . ' ' . $empleado->materno . '</a>
                                </h2>
                                </td>';
                for ($i = 1; $i <= $dias; $i++) {
                    if ($i < 10) {
                        $fecha = $anio . '-' . $mes . '-0' . $i;
                    } else {
                        $fecha = $anio . '-' . $mes . '-' . $i;
                    }
                    $asistencia = Asistencia::where('empleado_id', $empleado->id)
                        ->where('fecha', $fecha)->get()->first();
                    if ($asistencia) {
                        $fila_html .= '<td><i class="fa fa-check text-success"></i></td>';
                    } else {
                        $fila_html .= '<td><i class="fa fa-close text-danger"></i></td>';
                    }
                }
                $fila_html .= '</tr>';
            }

            return response()->JSON([
                'sw' => true,
                'header' => $header,
                'filas' => $fila_html
            ]);
        }

        $p_asistencia = Asistencia::first();
        $u_asistencia = Asistencia::get()->last();
        $array_anios[date('Y')] = date('Y');
        $anio_actual = date("Y");
        if ($p_asistencia) {
            $p_anio = date('Y', strtotime($p_asistencia->fecha));
            $u_anio = date('Y', strtotime($u_asistencia->fecha));
            if ($u_anio < $anio_actual) {
                $u_anio = $anio_actual;
            }
            $array_anios = [];
            for ($i = $p_anio; $i <= $u_anio; $i++) {
                $array_anios[$i] = $i;
            }
        }
        return view('asistencias.index', compact('array_anios'));
    }

    public function asistencias_empleado(Empleado $empleado)
    {
        $p_asistencia = Asistencia::first();
        $u_asistencia = Asistencia::get()->last();
        $array_anios[date('Y')] = date('Y');
        $anio_actual = date("Y");
        if ($p_asistencia) {
            $p_anio = date('Y', strtotime($p_asistencia->fecha));
            $u_anio = date('Y', strtotime($u_asistencia->fecha));
            if ($u_anio < $anio_actual) {
                $u_anio = $anio_actual;
            }
            $array_anios = [];
            for ($i = $p_anio; $i <= $u_anio; $i++) {
                $array_anios[$i] = $i;
            }
        }
        return view('asistencias.asistencias_empleado', compact('empleado', 'array_anios'));
    }

    public function getAsistenciasEmpleado(Empleado $empleado, Request $request)
    {
        $mes = $request->mes;
        $anio = $request->anio;
        $fecha = $anio . '-' . $mes . '-01';

        $dias = date('t', \strtotime($fecha));

        $header = '';
        $dias_html = '<tr>';
        for ($i = 1; $i <= $dias; $i++) {
            $header .= '<th>' . $i . '</th>';
            if ($i < 10) {
                $fecha = $anio . '-' . $mes . '-0' . $i;
            } else {
                $fecha = $anio . '-' . $mes . '-' . $i;
            }
            $asistencia = Asistencia::where('empleado_id', $empleado->id)
                ->where('fecha', $fecha)->get()->first();
            if ($asistencia) {
                $dias_html .= '<td><i class="fa fa-check text-success"></i></td>';
            } else {
                $dias_html .= '<td><i class="fa fa-close text-danger"></i></td>';
            }
        }
        $dias_html .= '</tr>';

        return response()->JSON([
            'sw' => true,
            'header' => $header,
            'dias' => $dias_html,
        ]);
    }

    public function store(Request $request)
    {
        $fecha = $request->fecha;
        $hora = $request->hora;
        $tipo = $request->tipo;
        $empleado = Empleado::find($request->id);
        $existe = Asistencia::where('empleado_id', $empleado->id)
            ->where('fecha', $fecha)->get()->first();
        if ($existe) {
            if ($tipo == 'inicio') {
                $existe->hora_inicio = $hora;
            } else {
                $existe->hora_fin = $hora;
            }
            $existe->save();
        } else {
            if ($tipo == 'inicio') {
                Asistencia::create([
                    'empleado_id' => $empleado->id,
                    'hora_inicio' => $hora,
                    'fecha' => $fecha,
                    'fecha_registro' => date('Y-m-d')
                ]);
            } else {
                Asistencia::create([
                    'empleado_id' => $empleado->id,
                    'hora_fin' => $hora,
                    'fecha' => $fecha,
                    'fecha_registro' => date('Y-m-d')
                ]);
            }
        }

        return response()->JSON([
            'sw' => true
        ]);
    }

    public function getHoraTipoEmpleado(Empleado $empleado, Request $request)
    {
        $horario_sw = false;
        $hora = $request->hora;
        $fecha = $request->fecha;

        $horario = $empleado->horario;
        $hora_ini = null;
        $hora_fin = null;
        $tipo = 'inicio';
        $index_sw = '';
        if ($horario) {
            $dia = date('w', strtotime($fecha));
            switch ($dia) {
                case 0:
                    $hora_ini = $horario->hi_do;
                    $hora_fin = $horario->hf_do;
                    $index_sw = 'do';
                    break;
                case 1:
                    $hora_ini = $horario->hi_lu;
                    $hora_fin = $horario->hf_lu;
                    $index_sw = 'lu';
                    break;
                case 2:
                    $hora_ini = $horario->hi_mar;
                    $hora_fin = $horario->hf_mar;
                    $index_sw = 'mar';
                    break;
                case 3:
                    $hora_ini = $horario->hi_mier;
                    $hora_fin = $horario->hf_mier;
                    $index_sw = 'mier';
                    break;
                case 4:
                    $hora_ini = $horario->hi_jue;
                    $hora_fin = $horario->hf_jue;
                    $index_sw = 'jue';
                    break;
                case 5:
                    $hora_ini = $horario->hi_vier;
                    $hora_fin = $horario->hf_vier;
                    $index_sw = 'vier';
                    break;
                case 6:
                    $hora_ini = $horario->hi_sa;
                    $hora_fin = $horario->hf_sa;
                    $index_sw = 'sa';
                    break;
            }

            $tipo == 'falta';
            if ($hora_ini == null || $hora_fin == null || $hora_ini == '' || $hora_fin == '') {
                $horario_sw = false;
            } else {
                if (date('H:i:s', strtotime($hora)) <= date('H:i:s', strtotime($hora_ini))) {
                    $tipo = 'inicio';
                    $index_sw = 'hi_' . $index_sw;
                } elseif (date('H:i:s', strtotime($hora)) >= date('H:i:s', strtotime($hora_fin))) {
                    $comprueba_inicio = Asistencia::where('empleado_id', $empleado->id)
                        ->where('fecha', $fecha)
                        ->get()
                        ->first();
                    if ($comprueba_inicio) {
                        if ($comprueba_inicio->hora_inicio != '' && $comprueba_inicio->hora_inicio != null) {
                            $tipo = 'fin';
                            $index_sw = 'hf_' . $index_sw;
                        } else {
                            $tipo = 'falta';
                        }
                    }
                } else {
                    $tipo = 'falta';
                }
                $horario_sw = true;
                // comprobar si no existe un registro
                $comprueba = Asistencia::where('empleado_id', $empleado->id)
                    ->where('fecha', $fecha)
                    ->get()
                    ->first();

                if ($comprueba) {
                    if ($tipo == 'inicio') {
                        if ($comprueba->hora_inicio != null && $comprueba->hora_inicio != '') {
                            $horario_sw = false;
                        }
                    } elseif ($tipo == 'fin') {
                        if ($comprueba->hora_fin != null && $comprueba->hora_fin != '') {
                            $horario_sw = false;
                        }
                    }
                }
            }
        } else {
            $horario_sw = false;
        }

        return \response()->json([
            'sw' => true,
            'horario_sw' => $horario_sw,
            'fecha' => $fecha,
            'hora' => $hora,
            'hora_ini' => $hora_ini,
            'hora_fin' => $hora_fin,
            'tipo' => $tipo,
            'index_sw' => $index_sw,
        ]);
    }
}

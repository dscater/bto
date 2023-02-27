<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Proyecto;
use App\Empleado;
use App\DatosUsuario;
use App\Cliente;
use App\Empresa;
use App\Departamento;
use App\Designacion;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $month = date("Y-m");
        //
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        // obtener mes en espanol
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        $proyectos = Proyecto::where('estado', 1)->get();

        // COMPROBAR SI ES UN EMPLEADO
        if (Auth::user()->tipo == 'EMPLEADO') {
            //obtener los proyectos en los que esta incluido
            $proyectos = Proyecto::select('proyectos.*')
                ->where('proyectos.estado', 1)
                ->where('proyectos.lider_proyecto', Auth::user()->empleado->id)
                ->get();

            $proyectos_equipo = Proyecto::select('proyectos.*')
                ->join('proyecto_equipos', 'proyecto_equipos.proyecto_id', '=', 'proyectos.id')
                ->where('proyectos.estado', 1)
                ->where('proyecto_equipos.empleado_id', Auth::user()->empleado->id)
                ->get();
            if (count($proyectos_equipo) > 0) {
                foreach ($proyectos_equipo as $pe) {
                    $proyectos[] = $pe;
                }
            }
        }

        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->get();

        $clientes = Cliente::select('clientes.*')
            ->where('estado', 1)
            ->get();

        $c_proyectos = count($proyectos);
        $c_empleados = count($empleados);
        $c_usuarios = count($usuarios);
        $c_clientes = count($clientes);

        $empresas = Empresa::all();
        $departamentos = Departamento::all();
        $designacions = Designacion::all();

        $array_empresas['todos'] = 'TODOS';
        $array_departamentos['todos'] = 'TODOS';
        $array_designacions['todos'] = 'TODOS';

        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }
        foreach ($departamentos as $value) {
            $array_departamentos[$value->id] = $value->nombre;
        }
        foreach ($designacions as $value) {
            $array_designacions[$value->id] = $value->nombre;
        }


        $array_empleados['todos'] = 'TODOS';
        foreach ($empleados as $value) {
            $array_empleados[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        $array_proyectos['todos'] = 'TODOS';
        foreach ($proyectos as $value) {
            $array_proyectos[$value->id] = $value->nombre;
        }

        return view("dashboard", [
            'data' => $data,
            'mes' => $mes,
            'mespanish' => $mespanish,
            'c_proyectos' => $c_proyectos,
            'c_empleados' => $c_empleados,
            'c_usuarios' => $c_usuarios,
            'c_clientes' => $c_clientes,
            'array_empresas' => $array_empresas,
            'array_departamentos' => $array_departamentos,
            'array_designacions' => $array_designacions,
            'array_empleados' => $array_empleados,
            'array_proyectos' => $array_proyectos
        ]);
    }
    public static function calendar_month($month)
    {
        //$mes = date("Y-m");
        $mes = $month;
        //sacar el ultimo de dia del mes
        $daylast =  date("Y-m-d", strtotime("last day of " . $mes));
        //sacar el dia de dia del mes
        $fecha      =  date("Y-m-d", strtotime("first day of " . $mes));
        $daysmonth  =  date("d", strtotime($fecha));
        $montmonth  =  date("m", strtotime($fecha));
        $yearmonth  =  date("Y", strtotime($fecha));
        // sacar el lunes de la primera semana
        $nuevaFecha = mktime(0, 0, 0, $montmonth, $daysmonth, $yearmonth);
        $diaDeLaSemana = date("w", $nuevaFecha);
        $nuevaFecha = $nuevaFecha - ($diaDeLaSemana * 24 * 3600); //Restar los segundos totales de los dias transcurridos de la semana
        $dateini = date("Y-m-d", $nuevaFecha);
        //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
        // numero de primer semana del mes
        $semana1 = date("W", strtotime($fecha));
        // numero de ultima semana del mes
        $semana2 = date("W", strtotime($daylast));
        // semana todal del mes
        // en caso si es diciembre
        if (date("m", strtotime($mes)) == 12) {
            $semana = 5;
        } else {
            $semana = ($semana2 - $semana1) + 1;
        }
        // semana todal del mes
        $datafecha = $dateini;
        $calendario = array();
        $iweek = 0;
        while ($iweek < $semana) :
            $iweek++;
            //echo "Semana $iweek <br>";
            //
            $weekdata = [];
            for ($iday = 0; $iday < 7; $iday++) {
                // code...
                $datafecha = date("Y-m-d", strtotime($datafecha . "+ 1 day"));
                $datanew['mes'] = date("M", strtotime($datafecha));
                $datanew['dia'] = date("d", strtotime($datafecha));
                $datanew['fecha'] = $datafecha;
                //AGREGAR CONSULTAS EVENTO
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                array_push($weekdata, $datanew);
            }
            $dataweek['semana'] = $iweek;
            $dataweek['datos'] = $weekdata;
            //$datafecha['horario'] = $datahorario;
            array_push($calendario, $dataweek);
        endwhile;
        $nextmonth = date("Y-M", strtotime($mes . "+ 1 month"));
        $lastmonth = date("Y-M", strtotime($mes . "- 1 month"));
        $month = date("M", strtotime($mes));
        $yearmonth = date("Y", strtotime($mes));
        //$month = date("M",strtotime("2019-03"));
        $data = array(
            'next' => $nextmonth,
            'month' => $month,
            'year' => $yearmonth,
            'last' => $lastmonth,
            'calendar' => $calendario,
        );
        return $data;
    }
    public function index_month($month)
    {

        $data = $this->calendar_month($month);
        $mes = $data['month'];
        // obtener mes en espanol
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];

        return view("dashboard", [
            'data' => $data,
            'mes' => $mes,
            'mespanish' => $mespanish
        ]);
    }
    public static function spanish_month($month)
    {

        $mes = $month;
        if ($month == "Jan") {
            $mes = "Enero";
        } elseif ($month == "Feb") {
            $mes = "Febrero";
        } elseif ($month == "Mar") {
            $mes = "Marzo";
        } elseif ($month == "Apr") {
            $mes = "Abril";
        } elseif ($month == "May") {
            $mes = "Mayo";
        } elseif ($month == "Jun") {
            $mes = "Junio";
        } elseif ($month == "Jul") {
            $mes = "Julio";
        } elseif ($month == "Aug") {
            $mes = "Agosto";
        } elseif ($month == "Sep") {
            $mes = "Septiembre";
        } elseif ($month == "Oct") {
            $mes = "Octubre";
        } elseif ($month == "Oct") {
            $mes = "December";
        } elseif ($month == "Dec") {
            $mes = "Diciembre";
        } else {
            $mes = $month;
        }
        return $mes;
    }
}

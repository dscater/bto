<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\ProyectoEquipo;
use App\Empleado;
use App\Cliente;
use App\Actividad;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    public function index(Request $request)
    {
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

        $clientes = Cliente::select('clientes.*')
            ->where('estado', 1)
            ->get();

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->where('empleados.estado', 'ACTIVO')
            ->get();

        $array_clientes[''] = 'Seleccione...';
        $array_empleados[''] = 'Seleccione...';

        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->apellidos . ' ("' . $value->empresa . '")';
        }

        foreach ($empleados as $value) {
            $array_empleados[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        if ($request->ajax()) {
            $texto = $request->texto;
            $proyectos = Proyecto::where('estado', 1)
                ->where('nombre', 'LIKE', "%$texto%")
                ->get();


            // COMPROBAR SI ES UN EMPLEADO
            if (Auth::user()->tipo == 'EMPLEADO') {
                //obtener los proyectos en los que esta incluido
                $proyectos = Proyecto::select('proyectos.*')
                    ->where('proyectos.estado', 1)
                    ->where('proyectos.lider_proyecto', Auth::user()->empleado->id)
                    ->where('proyectos.nombre', 'LIKE', "%$texto%")
                    ->get();

                $proyectos_equipo = Proyecto::select('proyectos.*')
                    ->join('proyecto_equipos', 'proyecto_equipos.proyecto_id', '=', 'proyectos.id')
                    ->where('proyectos.estado', 1)
                    ->where('proyecto_equipos.empleado_id', Auth::user()->empleado->id)
                    ->where('proyectos.nombre', 'LIKE', "%$texto%")
                    ->get();
                if (count($proyectos_equipo) > 0) {
                    foreach ($proyectos_equipo as $pe) {
                        $proyectos[] = $pe;
                    }
                }
            }
            $html = view('proyectos.parcial.lista', compact('proyectos', 'array_clientes', 'array_empleados'))->render();

            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }

        return view('proyectos.index', compact('proyectos', 'array_clientes', 'array_empleados'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;
        $nuevo_proyecto = new Proyecto(array_map('mb_strtoupper', $request->except('archivo', 'fecha_ini', 'fecha_fin', 'equipo_create', 'descripcion')));
        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $nuevo_proyecto->fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $nuevo_proyecto->fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $nuevo_proyecto->descripcion = $request->descripcion;

        //obtener el archivo
        $file_archivo = $request->file('archivo');
        $extension = "." . $file_archivo->getClientOriginalExtension();
        $nom_archivo = $nuevo_proyecto->nombre . time() . $extension;
        $file_archivo->move(public_path() . "/files/proyectos/", $nom_archivo);
        $nuevo_proyecto->archivo = $nom_archivo;

        $nuevo_proyecto->save();

        $equipo_empleados = $request->equipo_create;
        for ($i = 0; $i < count($equipo_empleados); $i++) {
            $nuevo_empleado_equipo = new ProyectoEquipo([
                'proyecto_id' => $nuevo_proyecto->id,
                'empleado_id' => $equipo_empleados[$i]
            ]);

            $nuevo_proyecto->equipo()->save($nuevo_empleado_equipo);
        }

        return redirect()->route('proyectos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Proyecto $proyecto, Request $request)
    {
        $proyecto->update(array_map('mb_strtoupper', $request->except('archivo', 'fecha_ini', 'fecha_fin', 'equipo_create', 'descripcion')));

        $fecha_ini = \str_replace('/', '-', $request->fecha_ini);
        $fecha_fin = \str_replace('/', '-', $request->fecha_fin);
        $proyecto->fecha_ini = date('Y-m-d', \strtotime($fecha_ini));
        $proyecto->fecha_fin = date('Y-m-d', \strtotime($fecha_fin));
        $proyecto->descripcion = $request->descripcion;

        if ($request->hasFile('archivo')) {
            // antiguo
            $antiguo = $proyecto->archivo;
            \File::delete(public_path() . '/files/proyectos/' . $antiguo);

            //obtener el archivo
            $file_archivo = $request->file('archivo');
            $extension = "." . $file_archivo->getClientOriginalExtension();
            $nom_archivo = $proyecto->nombre . time() . $extension;
            $file_archivo->move(public_path() . "/files/proyectos/", $nom_archivo);
            $proyecto->archivo = $nom_archivo;
        }

        $proyecto->save();

        $equipo_empleados = [];
        if ($request->equipo_create) {
            $equipo_empleados = $request->equipo_create;
        }
        for ($i = 0; $i < count($equipo_empleados); $i++) {
            $nuevo_empleado_equipo = new ProyectoEquipo([
                'proyecto_id' => $proyecto->id,
                'empleado_id' => $equipo_empleados[$i]
            ]);

            $proyecto->equipo()->save($nuevo_empleado_equipo);
        }

        return redirect()->route('proyectos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Proyecto $proyecto)
    {

        $clientes = Cliente::select('clientes.*')
            ->where('estado', 1)
            ->get();

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->where('empleados.estado', 'ACTIVO')
            ->get();

        $array_clientes[''] = 'Seleccione...';
        $array_empleados[''] = 'Seleccione...';

        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->apellidos . ' ("' . $value->empresa . '")';
        }

        foreach ($empleados as $value) {
            $array_empleados[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        return view('proyectos.show', compact('proyecto', 'array_clientes', 'array_empleados'));
    }

    public function info_proyecto(Request $request)
    {
        $id = $request->id;
        $proyecto = Proyecto::find($id);
        $actividades = $proyecto->actividads;

        $total_actividades = count($actividades);

        $completos = count(Actividad::where('proyecto_id', $proyecto->id)
            ->where('estado', 'COMPLETO')
            ->get());

        $pendientes = count(Actividad::where('proyecto_id', $proyecto->id)
            ->where('estado', 'PENDIENTE')
            ->get());

        $porcentaje = ($completos * 100) / $total_actividades;
        $porcentaje = \number_format($porcentaje, 0);

        return response()->JSON([
            'sw' => true,
            'total_actividades' => $total_actividades,
            'porcentaje' => $porcentaje,
            'pendientes' => $pendientes,
            'completos' => $completos
        ]);
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->estado = 0;
        $proyecto->save();
        return redirect()->route('proyectos.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function download(Proyecto $proyecto)
    {
        return response()->download(\public_path() . '/files/proyectos/' . $proyecto->archivo, $proyecto->archivo);
    }
}

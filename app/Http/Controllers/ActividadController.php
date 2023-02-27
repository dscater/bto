<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Proyecto;

class ActividadController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::where('estado', 1)->get();
        return view('actividads.index', compact('proyectos'));
    }

    public function actividadesProyecto(Proyecto $proyecto, Request $request)
    {
        $filtro = $request->filtro;
        $actividads = Actividad::where('proyecto_id', $proyecto->id)->get();
        if ($filtro != 'todos') {
            if ($filtro == 'pendientes') {
                $actividads = Actividad::where('proyecto_id', $proyecto->id)
                    ->where('estado', 'PENDIENTE')
                    ->get();
            } else {
                $actividads = Actividad::where('proyecto_id', $proyecto->id)
                    ->where('estado', 'COMPLETO')
                    ->get();
            }
        }

        $html = view('actividads.parcial.actividads_proyecto',compact('proyecto','actividads'))->render();

        return response()->JSON([
            'sw' => true,
            'html' => $html
        ]);
    }

    public function create()
    {
        return view('actividads.create');
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        $request['proyecto_id'] = $proyecto->id;
        $request['estado'] = 'PENDIENTE';
        $request['fecha_registro'] = date('Y-m-d');
        $nueva_actividad = new Actividad(array_map('mb_strtoupper', $request->all()));

        $proyecto->actividads()->save($nueva_actividad);

        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'actividad' => $nueva_actividad,
                'url' => route('actividads.update',$nueva_actividad->id)
            ]);
        }

        return redirect()->route('actividads.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Actividad $actividad)
    {
        return view('actividads.edit', compact('actividads'));
    }

    public function update(Actividad $actividad, Request $request)
    {
        $actividad->update(array_map('mb_strtoupper', $request->all()));

        if ($request->ajax()) {
            return \response()->JSON([
                'sw' => true,
                'nombre' => $actividad->nombre
            ]);
        }

        return redirect()->route('actividads.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Actividad $actividad)
    {
        return 'mostrar cargo';
    }

    public function destroy(Actividad $actividad, Request $request)
    {
        $nombre = $actividad->nombre;
        $actividad->delete();
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'nombre' => $nombre
            ]);
        }

        return redirect()->route('actividads.index')->with('bien', 'Registro eliminado correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designacion;
use App\Empleado;

class DesignacionController extends Controller
{
    public function index()
    {
        $designacions = Designacion::all();
        return view('designacions.index', compact('designacions'));
    }

    public function create()
    {
        return view('designacions.create');
    }

    public function store(Request $request)
    {
        Designacion::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('designacions.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Designacion $designacion)
    {
        return view('designacions.edit', compact('designacion'));
    }

    public function update(Designacion $designacion, Request $request)
    {
        $designacion->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('designacions.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Designacion $designacion)
    {
        return 'mostrar cargo';
    }

    public function destroy(Designacion $designacion)
    {
        $comprueba = Empleado::where('designacion_id', $designacion->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('designacions.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $designacion->delete();
            return redirect()->route('designacions.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}

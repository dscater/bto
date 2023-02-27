<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\Empleado;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        Departamento::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('departamentos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamento'));
    }

    public function update(Departamento $departamento, Request $request)
    {
        $departamento->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('departamentos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Departamento $departamento)
    {
        return 'mostrar cargo';
    }

    public function destroy(Departamento $departamento)
    {
        $comprueba = Empleado::where('departamento_id', $departamento->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('departamentos.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $departamento->delete();
            return redirect()->route('departamentos.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}

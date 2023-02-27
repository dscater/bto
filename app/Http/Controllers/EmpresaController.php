<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Empleado;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        Empresa::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('empresas.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Empresa $empresa, Request $request)
    {
        $empresa->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('empresas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Empresa $empresa)
    {
        return 'mostrar cargo';
    }

    public function destroy(Empresa $empresa)
    {
        $comprueba = Empleado::where('empresa_id', $empresa->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('empresas.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $empresa->delete();
            return redirect()->route('empresas.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examen;
use App\Empresa;
use App\Departamento;
use App\Designacion;
use App\Pregunta;

class ExamenController extends Controller
{
    public function index()
    {
        $examens = Examen::where('estado', 1)->get();

        $empresas = Empresa::all();
        $departamentos = Departamento::all();
        $designacions = Designacion::all();

        $array_empresas[''] = 'Seleccione...';
        $array_departamentos[''] = 'Seleccione...';
        $array_designacions[''] = 'Seleccione...';

        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }

        foreach ($departamentos as $value) {
            $array_departamentos[$value->id] = $value->nombre;
        }

        foreach ($designacions as $value) {
            $array_designacions[$value->id] = $value->nombre;
        }

        return view('examens.index', compact('examens', 'array_empresas', 'array_departamentos', 'array_designacions'));
    }

    public function create()
    {
        return view('examens.create');
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;
        $nuevo_examen = new Examen(array_map('mb_strtoupper', $request->except('descripcion', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'respuesta', 'valor')));
        $nuevo_examen->save();

        // preguntas
        $descripcions = $request->descripcion;
        $opcionA = $request->opcionA;
        $opcionB = $request->opcionB;
        $opcionC = $request->opcionC;
        $opcionD = $request->opcionD;
        $respuesta = $request->respuesta;
        $valor = $request->valor;
        for ($i = 0; $i < count($descripcions); $i++) {
            $nueva_pregunta = new Pregunta([
                'examen_id' => $nuevo_examen->id,
                'descripcion' => mb_strtoupper($descripcions[$i]),
                'a' => mb_strtoupper($opcionA[$i]),
                'b' => mb_strtoupper($opcionB[$i]),
                'c' => mb_strtoupper($opcionC[$i]),
                'd' => mb_strtoupper($opcionD[$i]),
                'respuesta' => $respuesta[$i],
                'valor' => $valor[$i],
            ]);
            $nuevo_examen->preguntas()->save($nueva_pregunta);
        }

        return redirect()->route('examens.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Examen $examen)
    {
        return view('examens.edit', compact('examen'));
    }

    public function update(Examen $examen, Request $request)
    {
        $examen->update(array_map('mb_strtoupper', $request->except('descripcion', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'respuesta', 'valor')));

        // preguntas
        $descripcions = [];
        if ($request->descripcion) {
            $descripcions = $request->descripcion;
            $opcionA = $request->opcionA;
            $opcionB = $request->opcionB;
            $opcionC = $request->opcionC;
            $opcionD = $request->opcionD;
            $respuesta = $request->respuesta;
            $valor = $request->valor;
        }
        for ($i = 0; $i < count($descripcions); $i++) {
            $nueva_pregunta = new Pregunta([
                'examen_id' => $examen->id,
                'descripcion' => mb_strtoupper($descripcions[$i]),
                'a' => mb_strtoupper($opcionA[$i]),
                'b' => mb_strtoupper($opcionB[$i]),
                'c' => mb_strtoupper($opcionC[$i]),
                'd' => mb_strtoupper($opcionD[$i]),
                'respuesta' => $respuesta[$i],
                'valor' => $valor[$i],
            ]);
            $examen->preguntas()->save($nueva_pregunta);
        }

        return redirect()->route('examens.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Examen $examen)
    {
        return 'mostrar cargo';
    }

    public function form_examen_edit(Request $request)
    {
        $examen = Examen::find($request->id);

        $empresas = Empresa::all();
        $departamentos = Departamento::all();
        $designacions = Designacion::all();

        $array_empresas[''] = 'Seleccione...';
        $array_departamentos[''] = 'Seleccione...';
        $array_designacions[''] = 'Seleccione...';

        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }

        foreach ($departamentos as $value) {
            $array_departamentos[$value->id] = $value->nombre;
        }

        foreach ($designacions as $value) {
            $array_designacions[$value->id] = $value->nombre;
        }

        $html = view('examens.parcial.form_edit_examen', compact('examen', 'array_empresas', 'array_departamentos', 'array_designacions'))->render();

        return response()->JSON([
            'sw' => true,
            'html' => $html
        ]);
    }

    public function destroy(Examen $examen)
    {
        $examen->estado = 0;
        $examen->save();
        return redirect()->route('examens.index')->with('bien', 'Registro eliminado correctamente');
    }
}

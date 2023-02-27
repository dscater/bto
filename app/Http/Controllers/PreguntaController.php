<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pregunta;

class PreguntaController extends Controller
{
    public function update(Pregunta $pregunta, Request $request)
    {
        $pregunta->update(\array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'pregunta' => $pregunta,
                'valor' => $pregunta[$request->index]
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Pregunta $pregunta)
    {
        $pregunta->delete();
        return response()->JSON([
            'sw' => true
        ]);
    }
}

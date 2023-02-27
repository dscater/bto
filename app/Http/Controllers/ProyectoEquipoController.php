<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoEquipo;

class ProyectoEquipoController extends Controller
{
    public function destroy(ProyectoEquipo $proyectoEquipo)
    {
        $proyectoEquipo->delete();
        return response()->JSON([
            'sw' => true,
        ]);
    }
}

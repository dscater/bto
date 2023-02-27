<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;
use App\DatosUsuario;
use App\Empresa;
use App\Departamento;
use App\Designacion;
use App\Empleado;

class ReporteController extends Controller
{
    public function index()
    {
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
        return view('reportes.index', compact('array_empresas', 'array_departamentos', 'array_designacions'));
    }

    public function usuarios(Request $request)
    {
        $filtro = $request->filtro;
        $tipo = $request->role;

        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.email as usuario', 'users.foto', 'users.tipo')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->orderBy('datos_usuarios.nombre', 'ASC')
            ->get();

        if ($filtro != 'todos') {
            if ($tipo != 'todos') {
                $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.email as usuario', 'users.foto')
                    ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                    ->where('users.estado', 1)
                    ->where('users.tipo', $tipo)
                    ->orderBy('datos_usuarios.nombre', 'ASC')
                    ->get();
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }

    public function empleados(Request $request)
    {
        $filtro = $request->filtro;
        $empresa = $request->empresa;
        $departamento = $request->filtro;
        $designacion = $request->designacion;

        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'empresa':
                    $empleados = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->where('empleados.empresa_id', $empresa)
                        ->get();
                    break;
                case 'departamento':
                    $empleados = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->where('empleados.departamento_id', $departamento)
                        ->get();
                    break;
                case 'designacion':
                    $empleados = Empleado::select('empleados.*')
                        ->join('users', 'users.id', '=', 'empleados.user_id')
                        ->where('users.estado', 1)
                        ->where('empleados.designacion_id', $designacion)
                        ->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.empleados', compact('empleados'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Empleado;
use App\Empresa;
use App\Departamento;
use App\Designacion;
use App\Http\Requests\EmpleadoStoreRequest;
use App\Http\Requests\EmpleadoUpdateRequest;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $empleados = Empleado::select('empleados.*')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->where('users.estado', 1)
            ->get();

        $empresas = Empresa::all();
        $departamentos = Departamento::all();
        $designacions = Designacion::all();

        if ($request->ajax()) {
            $texto = $request->texto;

            $empleados = Empleado::select('empleados.*')
                ->join('users', 'users.id', '=', 'empleados.user_id')
                ->where('users.estado', 1)
                ->where(DB::raw('CONCAT(empleados.codigo_empleado, empleados.nombre, empleados.paterno, empleados.materno)'), 'LIKE', "%$texto%")
                ->get();

            $html = view('empleados.parcial.lista', compact('empleados', 'empresas', 'departamentos', 'designacions'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }

        return view('empleados.index', compact('empleados', 'empresas', 'departamentos', 'designacions'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(EmpleadoStoreRequest $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $empleado = new Empleado(array_map('mb_strtoupper', $request->except('email', 'fecha_ingreso')));
        $fecha_ingreso = \str_replace('/', '-', $request->fecha_ingreso);
        $empleado->fecha_ingreso = date('Y-m-d', \strtotime($fecha_ingreso));
        $empleado->email = $request->email;
        // $nombre_empleado = UserController::nombreempleado($request->nombre, $request->paterno);

        $nuevo_user = new User();
        $nuevo_user->email = $request->email;
        $nuevo_user->password = Hash::make($request->ci);
        $nuevo_user->tipo = 'EMPLEADO';
        $nuevo_user->foto = 'user_default.png';
        $nuevo_user->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $empleado->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_user->foto = $nom_foto;
        }
        $nuevo_user->save();
        $nuevo_user->empleado()->save($empleado);
        return redirect()->route('empleados.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Empleado $empleado, EmpleadoUpdateRequest $request)
    {
        $empleado->update(array_map('mb_strtoupper', $request->except('foto', 'email', 'fecha_ingreso')));
        $fecha_ingreso = \str_replace('/', '-', $request->fecha_ingreso);
        $empleado->fecha_ingreso = date('Y-m-d', \strtotime($fecha_ingreso));
        $empleado->email = $request->email;
        $empleado->user->email = $request->email;
        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $empleado->user->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/users/' . $antiguo);
            }
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $empleado->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $empleado->user->foto = $nom_foto;
        }
        $empleado->save();
        $empleado->user->save();
        return redirect()->route('empleados.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Empleado $empleado)
    {
        $empresas = Empresa::all();
        $departamentos = Departamento::all();
        $designacions = Designacion::all();

        return view('empleados.show', compact('empleado', 'empresas', 'departamentos', 'designacions'));
    }

    public function empleado_info(Request $request)
    {
        $id = $request->id;
        $empleado = Empleado::find($id);

        return response()->JSON([
            'sw' => true,
            'empleado' => $empleado,
            'user' => $empleado->user,
            'urlShow' => route('empleados.show', $empleado->id)
        ]);
    }

    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();
        return redirect()->route('empleados.index')->with('bien', 'Registro eliminado correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::select('clientes.*')
            ->where('estado', 1)
            ->get();

        if ($request->ajax()) {
            $texto = $request->texto;

            $clientes = Cliente::where('estado', 1)
                ->where(DB::raw('CONCAT(clientes.nombre, clientes.apellidos, clientes.empresa)'), 'LIKE', "%$texto%")
                ->get();

            $html = view('clientes.parcial.lista', compact('clientes'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;
        $cliente = new Cliente(array_map('mb_strtoupper', $request->except('email')));
        $cliente->email = $request->email;

        $cliente->foto = 'user_default.png';
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $cliente->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/clientes/", $nom_foto);
            $cliente->foto = $nom_foto;
        }
        $cliente->save();

        return redirect()->route('clientes.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Cliente $cliente, Request $request)
    {
        $cliente->update(array_map('mb_strtoupper', $request->except('foto', 'email')));
        $cliente->email = $request->email;

        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $cliente->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/clientes/' . $antiguo);
            }
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $cliente->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/clientes/", $nom_foto);
            $cliente->foto = $nom_foto;
        }
        $cliente->save();
        return redirect()->route('clientes.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->estado = 0;
        $cliente->save();
        return redirect()->route('clientes.index')->with('bien', 'Registro eliminado correctamente');
    }
}

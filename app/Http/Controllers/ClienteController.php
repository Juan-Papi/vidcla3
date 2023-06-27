<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'carnet' => 'required|integer|unique:clientes',
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'ciudad' => 'required',
            'sexo' => 'required',
        ]);

        Cliente::create([
            'carnet' => $request->carnet,
            'nombre' => $request->nombre,
            'materno' => $request->materno,
            'paterno' => $request->paterno,
            'ciudad' => $request->ciudad,
            'sexo' => $request->sexo,
        ]);

        // Código adicional o redireccionamiento después de guardar el cliente

        return redirect()->route('cliente.index')->with('info', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'carnet' => 'required|integer|unique:clientes,carnet,'.$cliente->id,
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'ciudad' => 'required',
            'sexo' => 'required',
        ]);
    
        $cliente->update([
            'carnet' => $request->carnet,
            'nombre' => $request->nombre,
            'materno' => $request->materno,
            'paterno' => $request->paterno,
            'ciudad' => $request->ciudad,
            'sexo' => $request->sexo,
        ]);
    
        // Código adicional o redireccionamiento después de actualizar el cliente
    
        return redirect()->route('cliente.index')->with('info', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('cliente.index')->with('info', 'El CLIENTE se eliminó con éxito!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proveedor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email|unique:proveedors,email',
            'telefono' => 'required|string',
            'ciudad' => 'required|string',
            'pais' => 'required|string',
        ]);
    
        $proveedor = new Proveedor();
        $proveedor->nombre = $validatedData['nombre'];
        $proveedor->email = $validatedData['email'];
        $proveedor->telefono = $validatedData['telefono'];
        $proveedor->ciudad = $validatedData['ciudad'];
        $proveedor->pais = $validatedData['pais'];
        $proveedor->save();
        return redirect()->route('admin.proveedor.index')->with('info', 'El nuevo PROVEEDOR se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return view('proveedor.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email|unique:proveedors,email,' . $proveedor->id,
            'telefono' => 'required|string',
            'ciudad' => 'required|string',
            'pais' => 'required|string',
        ]);
    
        $proveedor->nombre = $validatedData['nombre'];
        $proveedor->email = $validatedData['email'];
        $proveedor->telefono = $validatedData['telefono'];
        $proveedor->ciudad = $validatedData['ciudad'];
        $proveedor->pais = $validatedData['pais'];
        $proveedor->save();

        return redirect()->route('admin.proveedor.index')->with('info', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('admin.proveedor.index')->with('info', 'El PROVEEDOR se eliminó con éxito!');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('almacen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('almacen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:almacens,nombre',
            'ubicacion' => 'required',
            'capacidad' => 'required|integer',
        ]);
    
        // Crear el almacén
        $almacen = new Almacen;
        $almacen->nombre = $request->nombre;
        $almacen->ubicacion = $request->ubicacion;
        $almacen->capacidad = $request->capacidad;
        $almacen->save();
        return Redirect()->route('admin.almacen.index')->with('info', 'El ALMACEN se creo satisfactoriamente!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Almacen $almacen)
    {
        return view('almacen.show', compact('almacen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Almacen $almacen)
    {
        return view('almacen.edit', compact('almacen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Almacen $almacen)
    {
        $request->validate([
            'nombre' => 'required|unique:almacens,nombre,' . $almacen->id,
            'ubicacion' => 'required',
            'capacidad' => 'required|integer',
        ]);
    
        // Actualizar el almacén
        $almacen->nombre = $request->input('nombre');
        $almacen->ubicacion = $request->input('ubicacion');
        $almacen->capacidad = $request->input('capacidad');
        $almacen->save();
        return Redirect()->route('admin.almacen.index')->with('info', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Almacen $almacen)
    {
        $almacen->delete();
        return Redirect()->route('admin.almacen.index')->with('info', 'Almacen eliminado!');
    }
}

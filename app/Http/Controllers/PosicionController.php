<?php

namespace App\Http\Controllers;

use App\Models\Posicion;
use Illuminate\Http\Request;

class PosicionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posiciones = Posicion::all();
        return view('posicion.index', compact('posiciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posicion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:posicions'
        ]);
    
        $posicion = new Posicion();
        $posicion->nombre = $request->nombre;
        $posicion->save();
        return Redirect()->route('admin.posicion.index')->with('info', 'La POSICION se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posicion $posicion)
    {
        return view('posicion.show', compact('posicion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posicion $posicion)
    {
        return view('posicion.edit', compact('posicion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posicion $posicion)
    {
        $request->validate([
            'nombre' => 'required|unique:posicions,nombre,'.$posicion->id
        ]);
    
        $posicion->nombre = $request->nombre;
        $posicion->save();
        return redirect()->route('admin.posicion.index')->with('info', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posicion $posicion)
    {
        $posicion->delete();
        return redirect()->route('admin.posicion.index')->with('info', 'La POSICION se eliminó con éxito!');
    }
}

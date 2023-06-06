<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->save();
        return Redirect()->route('admin.marca.index')->with('info', 'La MARCA se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    { //para mirar los datos, un boton de "VER" en el form
        return view('marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
       
        $marca->nombre = $request->nombre;    
        $marca->save();
        return redirect()->route('admin.marca.index')->with('info', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();
        return redirect()->route('admin.marca.index')->with('info', 'La MARCA se eliminó con éxito!');
    }
}

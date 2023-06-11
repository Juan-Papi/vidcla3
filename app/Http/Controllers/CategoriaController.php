<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias'
        ]);
    
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();

        
        return Redirect()->route('admin.categoria.index')->with('info', 'La CATEGORIA se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias,nombre,'.$categoria->id
        ]);
    
        $categoria->nombre = $request->nombre;
        $categoria->save();
        
        return redirect()->route('admin.categoria.index')->with('info', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categoria.index')->with('info', 'La CATEGORIA se eliminó con éxito!');
    }
}

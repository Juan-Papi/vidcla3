<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vehiculos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all();
        return view('vehiculos.create',compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
           
            'matricula.unique' => 'La matrícula ya está en uso.',
            'descripcion.required' => 'El campo Descripción es obligatorio.',
            'año.required' => 'El campo Año es obligatorio.',
            'marca_id.required' => 'Debe seleccionar una marca.',
        ];
        
        $request->validate([
            
            'descripcion' => 'required',
            'año' => 'required',
            'marca_id' => 'required',
        ], $messages);
        
      
        $vehiculo = Vehiculo::create([
            'año' => $request->año,
            'descripcion' => $request->descripcion,
            'marca_id' => $request->marca_id,
        ]);
        
        return Redirect()->route('admin.vehiculo.index')->with('info', 'El nuevo VEHICULO se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return view('vehiculos.show',compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        $marcas = Marca::all();
        return view('vehiculos.edit', compact('vehiculo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $messages = [
            
            'matricula.unique' => 'La matrícula ya está en uso.',
            'descripcion.required' => 'El campo Descripción es obligatorio.',
            'año.required' => 'El campo Año es obligatorio.',
            'marca_id.required' => 'Debe seleccionar una marca.',
        ];
        
        $request->validate([
            'descripcion' => 'required',
            'año' => 'required',
            'marca_id' => 'required',
        ], $messages);

  
        $vehiculo->descripcion = $request->descripcion; 
        $vehiculo->año = $request->año;   
        $vehiculo->marca_id = $request->marca_id;      
        $vehiculo->save();
        return redirect()->route('admin.vehiculo.index')->with('info', 'Datos actualizados!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('admin.vehiculo.index')->with('info', 'El VEHICULO se eliminó con éxito!');
    }
}

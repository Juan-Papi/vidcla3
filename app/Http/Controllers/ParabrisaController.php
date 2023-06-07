<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Parabrisa;
use App\Models\Posicion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ParabrisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('parabrisas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posiciones = Posicion::all();
        $categorias = Categoria::all();
        $vehiculos = Vehiculo::all();
        return view('parabrisas.create', compact('posiciones','categorias','vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'precio' => 'required|numeric',
            'abajo' => 'required|string',
            'arriba' => 'required|string',
            'costado' => 'required|string',
            'medio' => 'required|string',
            'observacion' => 'nullable|string',
            'posicion_id' => 'required|exists:posicions,id',
            'categoria_id' => 'required|exists:categorias,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        // Crear una nueva instancia de Parabrisa y asignar los valores
        $parabrisa = new Parabrisa();
        $parabrisa->precio = $validatedData['precio'];
        $parabrisa->abajo = $validatedData['abajo'];
        $parabrisa->arriba = $validatedData['arriba'];
        $parabrisa->costado = $validatedData['costado'];
        $parabrisa->medio = $validatedData['medio'];
        $parabrisa->observacion = $validatedData['observacion'];
        $parabrisa->posicion_id = $validatedData['posicion_id'];
        $parabrisa->categoria_id = $validatedData['categoria_id'];
        $parabrisa->vehiculo_id = $validatedData['vehiculo_id'];

        // Guardar el nuevo parabrisa en la base de datos
        $parabrisa->save();

        // Redireccionar a una página de éxito o mostrar un mensaje
        return redirect()->route('admin.parabrisa.index')->with('info', 'El nuevo PARABRISA se creo satisfactoriamente!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Parabrisa $parabrisa)
    {
        return view('parabrisas.show',compact('parabrisa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parabrisa $parabrisa)
    {
        $posiciones = Posicion::all();
        $categorias = Categoria::all();
        $vehiculos = Vehiculo::all();
        return view('parabrisas.edit',compact('posiciones','categorias','vehiculos','parabrisa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parabrisa $parabrisa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

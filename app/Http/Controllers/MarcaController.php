<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Listar marca')->only('index');
        $this->middleware('can:Editar marca')->only('edit', 'update');
        $this->middleware('can:Crear marca')->only('create', 'store');
        $this->middleware('can:Eliminar marca')->only('destroy');
    }

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
            'nombre' => 'required|unique:marcas'
        ]);
    
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->save();

        $bitacora = new Bitacora();
        $bitacora->accion = '+++CREAR MARCA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
    
        return redirect()->route('admin.marca.index')->with('info', '¡La MARCA se creó satisfactoriamente!');
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
            'nombre' => 'required|unique:marcas,nombre,'.$marca->id
        ]);
    
        $marca->nombre = $request->nombre;
        $marca->save();

        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR MARCA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
    
        return redirect()->route('admin.marca.index')->with('info', '¡La MARCA se actualizó satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR MARCA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.marca.index')->with('info', 'La MARCA se eliminó con éxito!');
    }
}

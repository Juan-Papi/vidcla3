<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Posicion;
use Illuminate\Http\Request;

class PosicionController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Listar posicion')->only('index');
        $this->middleware('can:Editar posicion')->only('edit', 'update');
        $this->middleware('can:Crear posicion')->only('create', 'store');
        $this->middleware('can:Eliminar posicion')->only('destroy');
    }

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

        $bitacora = new Bitacora();
        $bitacora->accion = '+++CREAR POSICION';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

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
            'nombre' => 'required|unique:posicions,nombre,' . $posicion->id
        ]);

        $posicion->nombre = $request->nombre;
        $posicion->save();

        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR POSICION';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.posicion.index')->with('info', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posicion $posicion)
    {
        $posicion->delete();

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR POSICION';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.posicion.index')->with('info', 'La POSICION se eliminó con éxito!');
    }
}

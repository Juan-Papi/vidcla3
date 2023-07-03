<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Listar proveedor')->only('index');
        $this->middleware('can:Editar proveedor')->only('edit', 'update');
        $this->middleware('can:Crear proveedor')->only('create', 'store');
        $this->middleware('can:Eliminar proveedor')->only('destroy');
    }
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
        $request->validate([
            'nombre' => 'required|unique:proveedors',
            'email' => 'required|email|unique:proveedors',
            'telefono' => 'required',
            'ciudad' => 'required',
            'pais' => 'required'
        ]);
    
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->email = $request->email;
        $proveedor->telefono = $request->telefono;
        $proveedor->ciudad = $request->ciudad;
        $proveedor->pais = $request->pais;
        $proveedor->save();

        $bitacora = new Bitacora();
        $bitacora->accion = '+++CREAR PROVEEDOR';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
        
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
        $request->validate([
            'nombre' => 'required|unique:proveedors,nombre,'.$proveedor->id,
            'email' => 'required|email|unique:proveedors,email,'.$proveedor->id,
            'telefono' => 'required',
            'ciudad' => 'required',
            'pais' => 'required'
        ]);
    
        $proveedor->nombre = $request->nombre;
        $proveedor->email = $request->email;
        $proveedor->telefono = $request->telefono;
        $proveedor->ciudad = $request->ciudad;
        $proveedor->pais = $request->pais;
        $proveedor->save();

        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR PROVEEDOR';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.proveedor.index')->with('info', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR PROVEEDOR';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
        
        return redirect()->route('admin.proveedor.index')->with('info', 'El PROVEEDOR se eliminó con éxito!');

    }
}

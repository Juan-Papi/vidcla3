<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use PDF;

class AlmacenController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Listar almacen')->only('index');
        $this->middleware('can:Editar almacen')->only('edit', 'update');
        $this->middleware('can:Crear almacen')->only('create', 'store');
        $this->middleware('can:Eliminar almacen')->only('destroy');
    }
    public function index()
    {
        return view('almacen.index');
    }
    public function generarPDF($id)
    {
        $almacen = Almacen::find($id);
        $parabrisas = $almacen->parabrisas;

        $totalOcupado = 0;
        foreach ($parabrisas as $parabrisa) {
            $totalOcupado += $parabrisa->pivot->stock;
        }
        //interpretacion del loadview
        /*Con referencia a view, la vista pdf que esta dentro de la carpeta almacen*/
        $pdf = PDF::loadView('almacen.pdf', compact('almacen', 'parabrisas', 'totalOcupado'));

      /*  $filename = 'almacen_' . $almacen->nombre . '_' . $almacen->id . '.pdf';*/
        $filename = 'almacen_' . $almacen->id . '.pdf';
        return $pdf->download($filename);
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
        
        $bitacora = new Bitacora();
        $bitacora->accion = '+++CREAR ALMACEN';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
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

        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR ALMACEN';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return Redirect()->route('admin.almacen.index')->with('info', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Almacen $almacen)
    {
        $almacen->delete();

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR ALMACEN';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return Redirect()->route('admin.almacen.index')->with('info', 'Almacen eliminado!');
    }
}

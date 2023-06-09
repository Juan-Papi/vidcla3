<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\NotaCompra;
use App\Models\Parabrisa;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class NotaCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('nota-compra.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $almacenes = Almacen::all();
        $proveedores = Proveedor::all();
        $parabrisas = Parabrisa::all();
        return view('nota-compra.create', compact('almacenes', 'proveedores', 'parabrisas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //esto ya no esta en uso , se creo un componente de livewire para mayor dinamica y calculo del total
        $request->validate([
            'cantidad' => 'required|integer',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'almacen_id' => 'required|exists:almacens,id',
            'parabrisa_id' => 'required|exists:parabrisas,id',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);
    
        $notaCompra = new NotaCompra();
        $notaCompra->cantidad = $request->cantidad;
        $notaCompra->fecha = $request->fecha;
        $notaCompra->total = $request->total;
        $notaCompra->almacen_id = $request->almacen_id;
        $notaCompra->parabrisa_id = $request->parabrisa_id;
        $notaCompra->proveedor_id = $request->proveedor_id;
        $notaCompra->save();
        return redirect()->route('admin.nota_compra.index')->with('info', 'Nota de compra creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaCompra $nota_compra)
    {
        return view('nota-compra.show', compact('nota_compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaCompra $nota_compra)
    {
        $almacenes = Almacen::all();
        $proveedores = Proveedor::all();
        $parabrisas = Parabrisa::all();
        return view('nota-compra.edit', compact('almacenes', 'proveedores', 'parabrisas', 'nota_compra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaCompra $nota_compra)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'almacen_id' => 'required|exists:almacens,id',
            'parabrisa_id' => 'required|exists:parabrisas,id',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);
    
        $nota_compra->cantidad = $request->cantidad;
        $nota_compra->fecha = $request->fecha;
        $nota_compra->total = $request->total;
        $nota_compra->almacen_id = $request->almacen_id;
        $nota_compra->parabrisa_id = $request->parabrisa_id;
        $nota_compra->proveedor_id = $request->proveedor_id;
        $nota_compra->save();
        return redirect()->route('admin.nota_compra.index')->with('info', 'Nota de compra actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaCompra $nota_compra)
    {
        $nota_compra->delete();
        return redirect()->route('admin.nota_compra.index')->with('info', 'Nota de compra eliminada!');
    }
}

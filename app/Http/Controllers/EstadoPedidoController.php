<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoPedido;
class EstadoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = EstadoPedido::all();
        return view('estado-pedido.index', compact('estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estado-pedido.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:estado_pedidos'
        ]);
    
        $estadoPedido = new EstadoPedido();
        $estadoPedido->nombre = $request->nombre;
        $estadoPedido->save();
        return Redirect()->route('admin.estado-pedido.index')->with('info', 'El ESTADO se creo satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoPedido $estado)
    {
        return view('estado-pedido.show', compact('estado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstadoPedido $estado_pedido)
    {
        return view('estado-pedido.edit', compact('estado_pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstadoPedido $estado_pedido)
    {
        $request->validate([
            'nombre' => 'required|unique:estado_pedidos,nombre,'.$estado_pedido->id
        ]);
    
        $estado_pedido->nombre = $request->nombre;
        $estado_pedido->save();
    
        return redirect()->route('admin.estado-pedido.index')->with('info', '¡El estado del pedido se actualizó satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoPedido $estado_pedido)
    {
        $estado_pedido->delete();
        return redirect()->route('admin.estado-pedido.index')->with('info', 'El ESTADO se eliminó con éxito!');
    }
}

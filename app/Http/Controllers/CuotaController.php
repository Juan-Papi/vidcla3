<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Models\PlanPago;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cuotas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pagos = PlanPago::all();
        return view('cuotas.create', compact('pagos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'pago_id' => 'required|exists:plan_pagos,id',
        ]);

        Cuota::create([
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'pago_id' => $request->pago_id,
        ]);

        // Código adicional o redireccionamiento después de guardar la cuota

        return redirect()->route('cuota.index')->with('info', 'Cuota creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuota $cuota)
    {
        return view('cuotas.show', compact('cuota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuota $cuota)
    {
        $pagos = PlanPago::all();
        return view('cuotas.edit', compact('cuota', 'pagos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuota $cuota)
    {
        $request->validate([
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
            'pago_id' => 'required|exists:plan_pagos,id',
        ]);

        $cuota->update([
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'pago_id' => $request->pago_id,
        ]);

        // Código adicional o redireccionamiento después de actualizar la cuota

        return redirect()->route('cuota.index')->with('info', 'Cuota actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuota $cuota)
    {
        $cuota->delete();
        return redirect()->route('cuota.index')->with('info', 'La CUOTA se eliminó con éxito!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PlanPago;
use Illuminate\Http\Request;

class PlanPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plan-pago.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plan-pago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'plazo' => 'required',
            'monto_total' => 'required|numeric',
        ]);

        PlanPago::create([
            'fecha' => $request->fecha,
            'plazo' => $request->plazo,
            'monto_total' => $request->monto_total,
        ]);

        // Código adicional o redireccionamiento después de guardar el plan de pago

        return redirect()->route('plan-pago.index')->with('info', 'Plan de pago creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanPago $plan_pago)
    {
        return view('plan-pago.show', compact('plan_pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanPago $pago)
    {
        return view('plan-pago.edit', compact('pago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanPago $pago)
    {
        $request->validate([
            'fecha' => 'required|date',
            'plazo' => 'required',
            'monto_total' => 'required|numeric',
        ]);

        $pago->update([
            'fecha' => $request->fecha,
            'plazo' => $request->plazo,
            'monto_total' => $request->monto_total,
        ]);

        // Código adicional o redireccionamiento después de actualizar el plan de pago

        return redirect()->route('plan-pago.index')->with('info', 'Plan de pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanPago $pago)
    {
        $pago->delete();
        return redirect()->route('plan-pago.index')->with('info', 'El PLAN DE PAGO se eliminó con éxito!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use Illuminate\Http\Request;
use PDF;

class NotaVentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Listar ventas')->only('index');
        $this->middleware('can:Actualizar ventas')->only('edit');
        $this->middleware('can:Crear ventas')->only('create');
    }
    public function index()
    {
        return view('nota-venta.index');
    }
    public function generarPDF($id)
    {
        $nota_venta = NotaVenta::find($id);
        $parabrisas = $nota_venta->parabrisas;

        //interpretacion del loadview
        /*Con referencia a view, la vista pdf que esta dentro de la carpeta almacen*/
        $pdf = PDF::loadView('nota-venta.reporte', compact('nota_venta', 'parabrisas'));

        /*  $filename = 'almacen_' . $almacen->nombre . '_' . $almacen->id . '.pdf';*/
        $filename = 'venta_' . $nota_venta->id . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nota-venta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nota_venta_id)
    {
        return view('nota-venta.edit', compact('nota_venta_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
    public function generarReporte(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;
        $usuario = $request->usuario;
        $cliente = $request->cliente;
        $almacen = $request->almacen;

        $query = NotaVenta::query();

        if (!empty($usuario)) {
            $query = $query->where('user_id', $usuario);
        }
        if (!empty($cliente)) {
            $query = $query->where('cliente_id', $cliente);
        }
        if (!empty($almacen)) {
            $query = $query->where('almacen_id', $almacen);
        }
        if (!empty($desde)) {
            $query = $query->whereDate('fecha', '>=', $desde);
        }
        if (!empty($hasta)) {
            $query = $query->whereDate('fecha', '<=', $hasta);
        }

        $nota_ventas = $query->orderBy('id', 'DESC')->get();

        // Crear la vista del informe y convertirla a PDF
        $pdf = PDF::loadView('nota-venta.pdf', ['nota_ventas' => $nota_ventas]);
        // return view('nota-venta.pdf', ['nota_ventas' => $nota_ventas]);// para probar que la vista este funcionando!!

        // Retornar el PDF como una descarga
        return $pdf->download('nota_venta_reporte.pdf');
    }
}

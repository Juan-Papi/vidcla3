<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\NotaVenta;
use App\Models\Parabrisa;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditNotaVentaComponent extends Component
{
    public $almacenes;
    public $parabrisas;
    public $almacen_id;
    public $lineasVenta = [];
    public $total = 0;
    public $cliente_id;
    public $cliente_nombre = null;
    public $factura = "0";
    public $nit = '';
    public $notaVenta;
    public $notaVenta_id;


    public $lineasVentaOriginales = [];
    public $almacenOriginal_id;

    protected $listeners = ['clienteSeleccionado' => 'seleccionarCliente'];

    public function mount($id)
    {
        $this->almacenes = Almacen::all();
        $this->parabrisas = Parabrisa::all();

        $this->notaVenta = NotaVenta::findOrFail($id);
        $this->cliente_id = $this->notaVenta->cliente_id;
        $this->notaVenta_id = $this->notaVenta->id;
        $this->almacen_id = $this->notaVenta->almacen_id;
        $this->total = $this->notaVenta->monto_total;

        $cliente = Cliente::findOrFail($this->cliente_id);
        $this->cliente_nombre = $cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno;

        // Se asigna el valor de factura como "1" si la nota de venta tiene factura, y "0" si no la tiene.
        $this->factura = $this->notaVenta->factura ? "1" : "0";
        // Se asigna el NIT si la nota de venta tiene factura, y se deja vacío si no la tiene.
        $this->nit = $this->notaVenta->factura ? $this->notaVenta->factura->nit : '';

        $this->lineasVentaOriginales = [];
        $this->almacenOriginal_id = $this->notaVenta->almacen->id;

        foreach ($this->notaVenta->parabrisas as $parabrisa) {
            $almacenParabrisa = $parabrisa->almacenes()->where('almacen_id', $this->almacenOriginal_id)->first();
            $stockOriginal = $almacenParabrisa ? $almacenParabrisa->pivot->stock : 0;

            $this->lineasVentaOriginales[] = [
                'parabrisa_id' => $parabrisa->id,
                'cantidad' => $parabrisa->pivot->cantidad,
                'precio_venta' => $parabrisa->pivot->precio_venta,
                'importe' => $parabrisa->pivot->importe,
                'stock_original' => $stockOriginal
            ];
        }


        foreach ($this->notaVenta->parabrisas as $parabrisa) {
            $this->lineasVenta[] = [
                'parabrisa_id' => $parabrisa->id,
                'cantidad' => $parabrisa->pivot->cantidad,
                'precio_venta' => $parabrisa->pivot->precio_venta,
                'importe' => $parabrisa->pivot->importe
            ];
        }
    }

    public function seleccionarCliente($clienteId)
    {
        $this->cliente_id = $clienteId;
        $cliente = Cliente::findOrFail($clienteId);
        $this->cliente_nombre = $cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'almacen_id' => 'required',
            'lineasVenta.*.parabrisa_id' => 'required',
            'lineasVenta.*.cantidad' => 'required|integer',
            'lineasVenta.*.precio_venta' => 'required|numeric',
        ]);

        $this->calculateTotal();
    }

    public function addLineaVenta()
    {
        $this->lineasVenta[] = ['parabrisa_id' => '', 'cantidad' => '', 'precio_venta' => '', 'importe' => 0];
    }

    public function removeLineaVenta($index)
    {
        unset($this->lineasVenta[$index]);
        $this->lineasVenta = array_values($this->lineasVenta);  // Reindexa el array
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->lineasVenta as $index => $lineaVenta) {
            if (isset($lineaVenta['cantidad'], $lineaVenta['precio_venta'])) { //cond. para que reconozca al 0(el valor)
                $cantidad = floatval($lineaVenta['cantidad']); //convertido a float para evitar error string*string
                $precioVenta = floatval($lineaVenta['precio_venta']);
                $this->lineasVenta[$index]['importe'] = $cantidad * $precioVenta;
                $this->total += $this->lineasVenta[$index]['importe'];
            }
        }
    }

    public function updateNotaVenta()
    {
        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            // Actualiza la Factura si se seleccionó
            if ($this->factura === "1" && $this->notaVenta->factura_id) {
                Factura::where('id', $this->notaVenta->factura_id)->update([
                    'fecha' => now(),
                    'nit' => $this->nit,
                    'monto' => $this->total,
                ]);
            }

            // Actualiza la NotaVenta
            $this->notaVenta->update([
                'user_id' => auth()->id(),
                'fecha' => Carbon::now(),
                'cliente_id' => $this->cliente_id,
                'monto_total' => $this->total,
                'almacen_id' => $this->almacen_id,
            ]);
            // Recorre cada línea de venta original y restablece el stock
            foreach ($this->lineasVentaOriginales as $lineaVentaOriginal) {
                $parabrisaOriginal = Parabrisa::findOrFail($lineaVentaOriginal['parabrisa_id']);
                $relacionParabrisaAlmacenOriginal = $parabrisaOriginal->almacenes()->where('almacen_id', $this->almacenOriginal_id)->first();

                if ($relacionParabrisaAlmacenOriginal) {
                    $stockOriginal = $lineaVentaOriginal['stock_original'];
                    $stockDespuesVenta = $stockOriginal + $lineaVentaOriginal['cantidad'];

                    // Restablece el stock al valor después de la venta original
                    $parabrisaOriginal->almacenes()->updateExistingPivot($this->almacenOriginal_id, [
                        'stock' => $stockDespuesVenta,
                    ]);
                }
            }
            $nuevosParabrisasIds = collect($this->lineasVenta)->pluck('parabrisa_id')->toArray();

            $lineasVentaParaEliminar = $this->notaVenta->parabrisas()
                ->whereNotIn('parabrisas.id', $nuevosParabrisasIds)
                ->get();
            foreach ($lineasVentaParaEliminar as $lineaVentaParaEliminar) {
                $this->notaVenta->parabrisas()->detach($lineaVentaParaEliminar->id);
            }

            // Recorre cada linea de venta y la actualiza
            foreach ($this->lineasVenta as $lineaVenta) {
                $parabrisa = Parabrisa::findOrFail($lineaVenta['parabrisa_id']);

                $relacionParabrisaAlmacen = $parabrisa->almacenes()->where('almacen_id', $this->almacen_id)->first();

                if ($relacionParabrisaAlmacen === null) {
                    throw new Exception('El parabrisa con ID: ' . $parabrisa->id . ' con descripcion:' . $parabrisa->descripcion . ' no está asociado al almacén seleccionado.');
                }

                $stock = $relacionParabrisaAlmacen->pivot->stock;

                if ($stock < $lineaVenta['cantidad']) {
                    throw new Exception('Stock insuficiente para el parabrisa con ID: ' . $parabrisa->id . ' con descripcion:' . $parabrisa->descripcion . '. ID almacen asociado: ' . $this->almacen_id . ', pruebe a seleccionar otro almacen o suministrar mas parabrisas a los almacenes. STOCK DISPONIBLE : ' . $stock);
                }

                // Actualiza la relación en la tabla intermedia entre NotaVenta y Parabrisa
                $this->notaVenta->parabrisas()->updateExistingPivot($parabrisa->id, [
                    'cantidad' => $lineaVenta['cantidad'],
                    'precio_venta' => $lineaVenta['precio_venta'],
                    'importe' => $lineaVenta['importe'],
                ]);

                // Actualiza el stock en la tabla intermedia entre Parabrisa y Almacen
                $parabrisa->almacenes()->updateExistingPivot($this->almacen_id, [
                    'stock' => $stock - $lineaVenta['cantidad'],
                ]);
            }

            // Si todo va bien, se confirma la transacción
            DB::commit();
           /* return redirect()->route('nota_venta.index')->with('info', 'Venta actualizada!!');*/
        } catch (\Exception $e) {
            // En caso de error, se revierte la transacción
            DB::rollback();

            // Agrega aquí el manejo de errores, por ejemplo:
            session()->flash('error', 'Ha ocurrido un error al actualizar la nota de venta: ' . $e->getMessage());
        }

        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR NOTA DE VENTA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('nota_venta.index')->with('info', 'Venta actualizada!!');
    }

    public function render()
    {
        return view('livewire.edit-nota-venta-component');
    }
}

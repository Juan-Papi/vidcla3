<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\NotaCompra;
use App\Models\Parabrisa;
use App\Models\Proveedor;
use Livewire\Component;

class PurchaseNoteForm extends Component
{
    public $cantidad;
    public $fecha;
    public $precio_unitario;
    public $proveedor_id;
    public $importe_total;
    public $almacen_id;
    public $parabrisa_id;

    public function updated($propertyName)
    {
        if ($propertyName == 'cantidad' || $propertyName == 'precio_unitario') {
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        if (!empty($this->cantidad) && !empty($this->precio_unitario)) {
            $this->importe_total = $this->cantidad * $this->precio_unitario;
        }
    }

    public function save()
    {
        $this->validate([
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'precio_unitario' => 'required|numeric|min:0',
            'importe_total' => 'required|numeric|min:0',
            'almacen_id' => 'required|exists:almacens,id',
            'parabrisa_id' => 'required|exists:parabrisas,id',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);

        NotaCompra::create([
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'precio_unitario' => $this->precio_unitario,
            'importe_total' => $this->importe_total,
            'almacen_id' => $this->almacen_id,
            'parabrisa_id' => $this->parabrisa_id,
            'proveedor_id' => $this->proveedor_id,
        ]);

        $almacen = Almacen::find($this->almacen_id);

        $parabrisa = $almacen->parabrisas()->where('parabrisas.id', $this->parabrisa_id)->first();
         //el parabrisa con el almacen esta relacionado
        if ($parabrisa) {
            $stockActual = $parabrisa->pivot->stock;
            $nuevoStock = $stockActual + $this->cantidad;
            $almacen->parabrisas()->updateExistingPivot($parabrisa->id, ['stock' => $nuevoStock]);
        } else {
            $almacen->parabrisas()->attach($this->parabrisa_id, ['stock' => $this->cantidad]);
        }

        return redirect()->route('admin.nota_compra.index')->with('info', 'Nota de compra creada exitosamente');
    }

    public function render()
    {
        return view('livewire.purchase-note-form', [
            'proveedores' => Proveedor::all(),
            'almacenes' => Almacen::all(),
            'parabrisas' => Parabrisa::all(),
        ]);
    }
}

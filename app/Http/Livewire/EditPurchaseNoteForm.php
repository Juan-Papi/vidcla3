<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\NotaCompra;
use App\Models\Parabrisa;
use App\Models\Proveedor;
use Livewire\Component;

class EditPurchaseNoteForm extends Component
{
    public $notaCompraId;
    public $cantidad;
    public $fecha;
    public $proveedor_id;
    public $total;
    public $almacen_id;
    public $parabrisa_id;

    public function mount(NotaCompra $notaCompra)
    {
        $this->notaCompraId = $notaCompra->id;
        $this->cantidad = $notaCompra->cantidad;
        $this->fecha = $notaCompra->fecha;
        $this->proveedor_id = $notaCompra->proveedor_id;
        $this->total = $notaCompra->total;
        $this->almacen_id = $notaCompra->almacen_id;
        $this->parabrisa_id = $notaCompra->parabrisa_id;
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'cantidad' || $propertyName == 'parabrisa_id') {
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        if (!empty($this->cantidad) && !empty($this->parabrisa_id)) {
            $parabrisa = Parabrisa::find($this->parabrisa_id);
            if ($parabrisa) {
                $this->total = $this->cantidad * $parabrisa->precio;
            }
        }
    }

    public function save()
    {
        $this->validate([
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'almacen_id' => 'required|exists:almacens,id',
            'parabrisa_id' => 'required|exists:parabrisas,id',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);

        if ($this->notaCompraId) {
            $notaCompra = NotaCompra::find($this->notaCompraId);
            $oldCantidad = $notaCompra->cantidad; // Guardar la cantidad anterior para el cálculo del stock
            $notaCompra->update([
                'cantidad' => $this->cantidad,
                'fecha' => $this->fecha,
                'total' => $this->total,
                'almacen_id' => $this->almacen_id,
                'parabrisa_id' => $this->parabrisa_id,
                'proveedor_id' => $this->proveedor_id,
            ]);

            $almacen = Almacen::find($this->almacen_id);

            // Buscar el Parabrisa en la relación muchos a muchos
            $parabrisa = $almacen->parabrisas()->where('parabrisas.id', $this->parabrisa_id)->first();

            // Si el Parabrisa ya está asociado con el Almacén, actualiza el stock
            if ($parabrisa) {
                $stockActual = $parabrisa->pivot->stock;
                $nuevoStock = $stockActual - $oldCantidad + $this->cantidad; // Ajustar el stock basado en la cantidad anterior
                $almacen->parabrisas()->updateExistingPivot($parabrisa->id, ['stock' => $nuevoStock]);
            } else {
                // Si no, asocia el Parabrisa con el Almacén y establece el stock inicial
                $almacen->parabrisas()->attach($this->parabrisa_id, ['stock' => $this->cantidad]);
            }


            /*$this->emit('alert', ['type' => 'success', 'message' => 'Nota de compra actualizada con éxito!']);*/
            return redirect()->route('admin.nota_compra.index')->with('info', 'Nota de compra actualizada exitosamente');
        }
    }

    public function render()
    {
        return view('livewire.edit-purchase-note-form', [
            'proveedores' => Proveedor::all(),
            'almacenes' => Almacen::all(),
            'parabrisas' => Parabrisa::all(),
        ]);
    }
}

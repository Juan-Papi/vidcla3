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

        // Buscar la NotaCompra existente y actualizarla
        $notaCompra = NotaCompra::find($this->notaCompraId);
        $oldCantidad = $notaCompra->cantidad; // Guardar la cantidad anterior para el cálculo del stock
        $oldAlmacenId = $notaCompra->almacen_id; // Guardar el almacen_id anterior para ajustar el stock
        $oldParabrisaId = $notaCompra->parabrisa_id; // Guardar el parabrisa_id anterior para ajustar el stock

        $notaCompra->update([
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'total' => $this->total,
            'almacen_id' => $this->almacen_id,
            'parabrisa_id' => $this->parabrisa_id,
            'proveedor_id' => $this->proveedor_id,
        ]);

        if ($oldAlmacenId != $this->almacen_id || $oldParabrisaId != $this->parabrisa_id) {
            // Si el almacen_id o parabrisa_id han cambiado, ajusta el stock del almacén y parabrisa anteriores
            $oldAlmacen = Almacen::find($oldAlmacenId);
            $oldParabrisa = $oldAlmacen->parabrisas()->where('parabrisas.id', $oldParabrisaId)->first();
            if ($oldParabrisa) {
                $oldStock = $oldParabrisa->pivot->stock;
                $nuevoStock = $oldStock - $oldCantidad; // Resta la cantidad anterior del stock del almacén y parabrisa anteriores
                $oldAlmacen->parabrisas()->updateExistingPivot($oldParabrisa->id, ['stock' => $nuevoStock]);
            }
        }

        $almacen = Almacen::find($this->almacen_id);

        // Buscar el Parabrisa en la relación muchos a muchos
        $parabrisa = $almacen->parabrisas()->where('parabrisas.id', $this->parabrisa_id)->first();

        // Si el Parabrisa ya está asociado con el Almacén, actualiza el stock
        if ($parabrisa) {
            $stockActual = $parabrisa->pivot->stock;
            $nuevoStock = $stockActual + $this->cantidad; // Añade la nueva cantidad al stock del nuevo almacén y parabrisa
            $almacen->parabrisas()->updateExistingPivot($parabrisa->id, ['stock' => $nuevoStock]);
        } else {
            // Si no, asocia el Parabrisa con el Almacén y establece el stock inicial
            $almacen->parabrisas()->attach($this->parabrisa_id, ['stock' => $this->cantidad]);
        }

        return redirect()->route('admin.nota_compra.index')->with('info', 'Nota de compra actualizada exitosamente');
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

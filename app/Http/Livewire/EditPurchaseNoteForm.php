<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Bitacora;
use App\Models\NotaCompra;
use App\Models\Parabrisa;
use App\Models\Proveedor;
use Livewire\Component;

class EditPurchaseNoteForm extends Component
{
    public $notaCompraId;
    public $cantidad;
    public $precio_unitario;
    public $importe_total;
    public $fecha;
    public $proveedor_id;
    public $almacen_id;
    public $parabrisa_id;

    public function mount(NotaCompra $notaCompra)
    {
        $this->notaCompraId = $notaCompra->id;
        $this->cantidad = $notaCompra->cantidad;
        $this->precio_unitario = $notaCompra->precio_unitario;
        $this->importe_total = $notaCompra->importe_total;
        $this->fecha = $notaCompra->fecha;
        $this->proveedor_id = $notaCompra->proveedor_id;
        $this->almacen_id = $notaCompra->almacen_id;
        $this->parabrisa_id = $notaCompra->parabrisa_id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

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
            'precio_unitario' => 'required|numeric|min:0',
            'importe_total' => 'required|numeric|min:0',
            'fecha' => 'required|date',
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
            'precio_unitario' => $this->precio_unitario,
            'importe_total' => $this->importe_total,
            'fecha' => $this->fecha,
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
            $diferenciaCantidad = $this->cantidad - $oldCantidad;
            $stockActual = $parabrisa->pivot->stock;
    
            // Aquí calculamos el nuevo stock basándonos en la diferencia
            $nuevoStock = $stockActual + $diferenciaCantidad;
            if ($nuevoStock < 0) {
                $nuevoStock = 0;  // El stock no puede ser negativo
            }
    
            $almacen->parabrisas()->updateExistingPivot($parabrisa->id, ['stock' => $nuevoStock]);
        } else {
            // Si no, asocia el Parabrisa con el Almacén y establece el stock inicial
            $almacen->parabrisas()->attach($this->parabrisa_id, ['stock' => $this->cantidad]);
        }
        
        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR COMPRA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
        
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

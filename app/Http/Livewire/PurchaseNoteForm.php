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
    public $proveedor_id;
    public $total;
    public $almacen_id;
    public $parabrisa_id;
    
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
            if($parabrisa){
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
    
        NotaCompra::create([
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'total' => $this->total,
            'almacen_id' => $this->almacen_id,
            'parabrisa_id' => $this->parabrisa_id,
            'proveedor_id' => $this->proveedor_id,
        ]);
    
        // Restablecer las propiedades del formulario
        $this->reset(['cantidad', 'fecha', 'total', 'almacen_id', 'parabrisa_id', 'proveedor_id']);
    
        // Emitir un evento de browser para notificar al usuario
        $this->emit('alert', ['type' => 'success', 'message' => 'Nota de compra creada con éxito!']);
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

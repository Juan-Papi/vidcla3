<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\NotaCompra;
use Livewire\Component;
use Livewire\WithPagination;
class AdminNotaCompra extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function deleteCompra($nota_compra_id){
        $compra = NotaCompra::find($nota_compra_id);
    
        // Buscar el Almacén y Parabrisa asociados con la NotaCompra
        $almacen = Almacen::find($compra->almacen_id);
        $parabrisa = $almacen->parabrisas()->where('parabrisas.id', $compra->parabrisa_id)->first();
    
        if ($parabrisa) {
            // Si el Parabrisa está asociado con el Almacén, resta la cantidad de la NotaCompra del stock
            $stockActual = $parabrisa->pivot->stock;
            $nuevoStock = $stockActual - $compra->cantidad; 
            if ($nuevoStock >= 0) { // Evita tener stock negativo
                $almacen->parabrisas()->updateExistingPivot($parabrisa->id, ['stock' => $nuevoStock]);
            } else {
                return back()->with('error', 'No se puede eliminar la Nota de Compra. El stock resultante sería negativo.');
            }
        }
    
        // Ahora puedes eliminar la NotaCompra
        $compra->delete();
    
        return back()->with('info', 'Nota de Compra eliminada y stock actualizado exitosamente.');
    }
    
    public function render()
    {
        $nota_compras = NotaCompra::paginate(6);
        return view('livewire.admin-nota-compra', compact('nota_compras'));
    }
}

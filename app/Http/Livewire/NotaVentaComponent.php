<?php

namespace App\Http\Livewire;

use App\Models\NotaVenta;
use Livewire\Component;
use Livewire\WithPagination;
class NotaVentaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function deleteVenta($nota_venta_id)
    {
        $venta = NotaVenta::find($nota_venta_id);
        $venta->delete();

        return back()->with('info', 'Nota de venta eliminada y stock actualizado exitosamente.');
    }
    public function render()
    {  
        $nota_ventas = NotaVenta::orderBy('id', 'DESC')->paginate(6);
        return view('livewire.nota-venta-component', compact('nota_ventas'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Bitacora;
use App\Models\NotaCompra;
use App\Models\Proveedor;

use Livewire\Component;
use Livewire\WithPagination;

use PDF;

class AdminNotaCompra extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";


    public $filtroProveedor;
    public $filtroAlmacen;
    public $filtroDesdeFecha;
    public $filtroHastaFecha;

    public $proveedores;
    public $almacenes;

    public function mount()
    {
        $this->proveedores = Proveedor::all();
        $this->almacenes = Almacen::all();
    }

    public function deleteCompra($nota_compra_id)
    {
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

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR COMPRA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
        
        return back()->with('info', 'Nota de Compra eliminada y stock actualizado exitosamente.');
    }
    public function descargarPDF()
    {
        $nota_compras = NotaCompra::query();

        if ($this->filtroProveedor) {
            $nota_compras->where('proveedor_id', $this->filtroProveedor);
        }

        if ($this->filtroAlmacen) {
            $nota_compras->where('almacen_id', $this->filtroAlmacen);
        }

        if ($this->filtroDesdeFecha) {
            $nota_compras->whereDate('fecha', '>=', $this->filtroDesdeFecha);
        }

        if ($this->filtroHastaFecha) {
            $nota_compras->whereDate('fecha', '<=', $this->filtroHastaFecha);
        }

        $nota_compras = $nota_compras->get();


        $pdf = PDF::loadView('nota-compra.pdf',  compact('nota_compras'));
       
        //dd($nota_compras);
        return $pdf->download('reporte.pdf');
        // return redirect()->route('admin.nota_compra.pdf', ['nota_compras' => $nota_compras]);
    }


    public function aplicarFiltros()
    {
        // Este método se dispara cuando el usuario hace clic en el botón "Aplicar filtros"
        // No necesitas hacer nada aquí porque los datos se actualizan automáticamente gracias a Livewire
    }

    public function resetFiltros()
    {
        $this->reset(['filtroProveedor', 'filtroAlmacen', 'filtroDesdeFecha', 'filtroHastaFecha']);
    }
    public function updatedFiltroProveedor()
    {
        $this->limpiar_page();
    }

    public function updatedFiltroAlmacen()
    {
        $this->limpiar_page();
    }

    public function updatedFiltroDesdeFecha()
    {
        $this->limpiar_page();
    }

    public function updatedFiltroHastaFecha()
    {
        $this->limpiar_page();
    }

    public function limpiar_page()
    {
        $this->resetPage();
    }

    public function render()
    {
        $nota_compras = NotaCompra::query();

        if ($this->filtroProveedor) {
            $nota_compras->where('proveedor_id', $this->filtroProveedor);
        }

        if ($this->filtroAlmacen) {
            $nota_compras->where('almacen_id', $this->filtroAlmacen);
        }

        if ($this->filtroDesdeFecha) {
            $nota_compras->whereDate('fecha', '>=', $this->filtroDesdeFecha);
        }

        if ($this->filtroHastaFecha) {
            $nota_compras->whereDate('fecha', '<=', $this->filtroHastaFecha);
        }

        $nota_compras = $nota_compras->paginate(6);

        return view('livewire.admin-nota-compra', compact('nota_compras'));
    }
}

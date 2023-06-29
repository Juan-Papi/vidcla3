<?php

namespace App\Http\Livewire;

use App\Models\Factura;
use App\Models\NotaVenta;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class NotaVentaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function deleteVenta($nota_venta_id)
    {
        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            // Encuentra la nota de venta por ID
            $notaVenta = NotaVenta::findOrFail($nota_venta_id);

            // Recupera todas las lineas de venta (relaciones con Parabrisas)
            $lineasVenta = $notaVenta->parabrisas;

            // Recorre cada linea de venta
            foreach ($lineasVenta as $lineaVenta) {
                // Recupera la relación entre el Parabrisa y el Almacén
                $relacionParabrisaAlmacen = $lineaVenta->almacenes()->where('almacen_id', $notaVenta->almacen_id)->first();

                // Si no se encuentra la relación, lanza una excepción
                if ($relacionParabrisaAlmacen === null) {
                    throw new Exception('El parabrisa con ID: ' . $lineaVenta->id . ' no está asociado al almacén seleccionado.');
                }

                // Recupera la cantidad de parabrisas vendidos en esta linea de venta
                $cantidadVendida = $lineaVenta->pivot->cantidad;

                // Recupera el stock actual
                $stockActual = $relacionParabrisaAlmacen->pivot->stock;

                // Actualiza el stock en la tabla intermedia entre Parabrisa y Almacen
                $lineaVenta->almacenes()->updateExistingPivot($notaVenta->almacen_id, [
                    'stock' => $stockActual + $cantidadVendida,
                ]);
            }

            // Si la nota de venta tiene una factura asociada, también la borra
            if ($notaVenta->factura_id !== null) {
                Factura::destroy($notaVenta->factura_id);
            }

            // Borra la nota de venta
            $notaVenta->delete();

            // Si todo va bien, se confirma la transacción
            DB::commit();

            //session()->flash('info', 'Venta eliminada correctamente');
        } catch (\Exception $e) {
            // En caso de error, se revierte la transacción
            DB::rollback();

            // Agrega aquí el manejo de errores, por ejemplo:
            session()->flash('error', 'Ha ocurrido un error al eliminar la venta: ' . $e->getMessage());
        }

        // Recarga la página para actualizar la lista de ventas
        return redirect()->route('nota_venta.index')->with('info', 'Venta eliminada correctamente');
    }
    public function render()
    {
        $nota_ventas = NotaVenta::orderBy('id', 'DESC')->paginate(6);
        return view('livewire.nota-venta-component', compact('nota_ventas'));
    }
}

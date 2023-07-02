<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\NotaVenta;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class NotaVentaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $desde;
    public $hasta;
    public $usuario;
    public $cliente;
    public $almacen;
    public $usuarios;
    public $clientes;
    public $almacenes;

    public function mount()
    {
        $this->usuarios = User::all();
        $this->clientes = Cliente::all();
        $this->almacenes = Almacen::all();
    }

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['desde', 'hasta', 'usuario', 'cliente', 'almacen']);
    }

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
        
        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR VENTA';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        // Recarga la página para actualizar la lista de ventas
        return redirect()->route('nota_venta.index')->with('info', 'Venta eliminada correctamente');
    }
    public function render()
    {
        $query = NotaVenta::query();

        if (!empty($this->usuario)) {
            $query = $query->where('user_id', $this->usuario);
        }
        if (!empty($this->cliente)) {
            $query = $query->where('cliente_id', $this->cliente);
        }
        if (!empty($this->almacen)) {
            $query = $query->where('almacen_id', $this->almacen);
        }
        if (!empty($this->desde)) {
            $query = $query->whereDate('fecha', '>=', $this->desde);
        }
        if (!empty($this->hasta)) {
            $query = $query->whereDate('fecha', '<=', $this->hasta);
        }

        $nota_ventas = $query->orderBy('id', 'DESC')->paginate(6);

        return view('livewire.nota-venta-component', compact('nota_ventas'));
    }
}

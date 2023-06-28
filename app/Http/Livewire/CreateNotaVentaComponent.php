<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\NotaVenta;
use App\Models\Parabrisa;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateNotaVentaComponent extends Component
{
    public $almacenes;
    public $parabrisas;
    public $almacen_id;
    public $lineasVenta = [];
    public $total = 0;

    public function mount()
    {
        $this->almacenes = Almacen::all();
        $this->parabrisas = Parabrisa::all();
        $this->addLineaVenta();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'almacen_id' => 'required',
            'lineasVenta.*.parabrisa_id' => 'required',
            'lineasVenta.*.cantidad' => 'required|integer',
            'lineasVenta.*.precio_venta' => 'required|numeric',
        ]);

        $this->calculateTotal();
    }

    public function addLineaVenta()
    {
        $this->lineasVenta[] = ['parabrisa_id' => '', 'cantidad' => '', 'precio_venta' => '', 'importe' => 0];
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->lineasVenta as $index => $lineaVenta) {
            if ($lineaVenta['cantidad'] && $lineaVenta['precio_venta']) {
                $this->lineasVenta[$index]['importe'] = $lineaVenta['cantidad'] * $lineaVenta['precio_venta'];
                $this->total += $this->lineasVenta[$index]['importe'];
            }
        }
    }

    public function createNotaVenta()
    {
        $this->validate([
            'almacen_id' => 'required',
            'lineasVenta.*.parabrisa_id' => 'required',
            'lineasVenta.*.cantidad' => 'required|integer',
            'lineasVenta.*.precio_venta' => 'required|numeric',
        ]);

        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            // Crea la NotaVenta
            $notaVenta = NotaVenta::create([
                'user_id' => auth()->id(), // Usuario que realiza la venta
                'fecha' => Carbon::now(),
                'cliente_id' => 1, //para prueba
                'monto_total' => $this->total,
            ]);

            // Recorre cada linea de venta
            foreach ($this->lineasVenta as $lineaVenta) {
                // Obtiene el Parabrisa
                $parabrisa = Parabrisa::findOrFail($lineaVenta['parabrisa_id']);

                // Recupera la relación entre el Parabrisa y el Almacén
                $relacionParabrisaAlmacen = $parabrisa->almacenes()->where('almacen_id', $this->almacen_id)->first();

                // Si no se encuentra la relación, lanza una excepción
                if ($relacionParabrisaAlmacen === null) {
                    throw new Exception('El parabrisa con ID: ' . $parabrisa->id . ' con descripcion:' . $parabrisa->descripcion . ' no está asociado al almacén seleccionado.');
                }

                // Obtiene el stock de la relación
                $stock = $relacionParabrisaAlmacen->pivot->stock;

                // Comprueba que el stock sea suficiente
                if ($stock < $lineaVenta['cantidad']) {
                    throw new Exception('Stock insuficiente para el parabrisa con ID: ' . $parabrisa->id . ' con descripcion:' . $parabrisa->descripcion . '. ID almacen asociado: ' . $this->almacen_id . ', pruebe a seleccionar otro almacen o suministrar mas parabrisas a los almacenes. STOCK DISPONIBLE : ' . $stock);
                }

                // Crea la relación en la tabla intermedia entre NotaVenta y Parabrisa
                $notaVenta->parabrisas()->attach($parabrisa->id, [
                    'cantidad' => $lineaVenta['cantidad'],
                    'precio_venta' => $lineaVenta['precio_venta'],
                    'importe' => $lineaVenta['importe'],
                ]);

                // Actualiza el stock en la tabla intermedia entre Parabrisa y Almacen
                $parabrisa->almacenes()->updateExistingPivot($this->almacen_id, [
                    'stock' => $stock - $lineaVenta['cantidad'],
                ]);
            }

            // Si todo va bien, se confirma la transacción
            DB::commit();
            return redirect()->route('nota_venta.index')->with('info', 'Nueva venta registrada!!');
        } catch (\Exception $e) {
            // En caso de error, se revierte la transacción
            DB::rollback();

            // Agrega aquí el manejo de errores, por ejemplo:
            session()->flash('error', 'Ha ocurrido un error al crear la nota de venta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-nota-venta-component');
    }
}

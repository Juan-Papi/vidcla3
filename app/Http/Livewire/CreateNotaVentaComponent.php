<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Factura;
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
    public $cliente_id; //trabajo junto con el buscador cliente
    public $cliente_nombre = null; // Nombre del cliente seleccionado

    //PARA LA FACTURA
    public $factura = false;
    public $nit = '';

    //listener para el evento cliente seleccionado que se emitirá desde el componente buscador de clientes
    protected $listeners = ['clienteSeleccionado' => 'seleccionarCliente'];


    public function mount()
    {
        $this->factura = false;
        $this->nit = '';

        $this->almacenes = Almacen::all();
        $this->parabrisas = Parabrisa::all();
        $this->addLineaVenta();
    }
    //trabaja de la mano del componente buscador de clientes
    public function seleccionarCliente($clienteId)
    {
        $this->cliente_id = $clienteId;
        $cliente = Cliente::findOrFail($clienteId);
        $this->cliente_nombre = $cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno;
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
        $rules = [
            'almacen_id' => 'required',
            'lineasVenta.*.parabrisa_id' => 'required',
            'lineasVenta.*.cantidad' => 'required|integer',
            'lineasVenta.*.precio_venta' => 'required|numeric',
            'cliente_id' => 'required',  // Valida que se haya seleccionado un cliente
            'nit' => $this->factura ? 'required' : '',  // Valida el NIT si se ha seleccionado factura
        ];

        $messages = [
            'cliente_id.required' => 'Por favor, selecciona un cliente antes de crear una nota de venta.',
            'nit.required' => 'Por favor, ingresa el NIT para la factura.',
        ];

        $this->validate($rules, $messages);

        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            // Crear la factura si se seleccionó
            $factura_id = null;
            if ($this->factura) {
                $factura = Factura::create([
                    'fecha' => now(),
                    'nit' => $this->nit,
                    'monto' => $this->total,
                ]);
                $factura_id = $factura->id;
            }
            // Crea la NotaVenta
            $notaVenta = NotaVenta::create([
                'user_id' => auth()->id(), // Usuario que realiza la venta
                'fecha' => Carbon::now(),
                'cliente_id' => $this->cliente_id, // Utiliza el cliente_id seleccionado
                'monto_total' => $this->total,
                'factura_id' => $factura_id,  // Usar el ID de la factura, si se creó
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

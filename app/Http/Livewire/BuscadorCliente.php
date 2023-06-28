<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class BuscadorCliente extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $clientes = Cliente::where('carnet', 'like', '%' . $this->search . '%')->paginate(5);

        return view('livewire.buscador-cliente', ['clientes' => $clientes]);
    }
}

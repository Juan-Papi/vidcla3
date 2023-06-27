<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;
class ClienteComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $clientes = Cliente::orderBy('id', 'DESC')->paginate(6);
        return view('livewire.cliente-component', compact('clientes'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\NotaCompra;
use Livewire\Component;
use Livewire\WithPagination;
class AdminNotaCompra extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $nota_compras = NotaCompra::paginate(6);
        return view('livewire.admin-nota-compra', compact('nota_compras'));
    }
}

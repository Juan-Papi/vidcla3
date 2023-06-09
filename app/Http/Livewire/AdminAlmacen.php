<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use Livewire\Component;
use Livewire\WithPagination;
class AdminAlmacen extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $almacens = Almacen::paginate(6);
        return view('livewire.admin-almacen', compact('almacens'));
    }
}

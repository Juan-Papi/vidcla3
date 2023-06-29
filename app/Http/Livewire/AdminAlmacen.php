<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use Livewire\Component;
use Livewire\WithPagination;
class AdminAlmacen extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function getTotalOcupado($almacen)
    {
        $totalOcupado = 0;
        foreach ($almacen->parabrisas as $parabrisa) {
            $totalOcupado += $parabrisa->pivot->stock;
        }

        return $totalOcupado;
    }
    
    public function render()
    {
        $almacens = Almacen::paginate(6);
        return view('livewire.admin-almacen', compact('almacens'));
    }
}

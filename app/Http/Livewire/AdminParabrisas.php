<?php

namespace App\Http\Livewire;

use App\Models\Parabrisa;
use Livewire\Component;
use Livewire\WithPagination;
class AdminParabrisas extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public function render()
    { 
        $parabrisas = Parabrisa::paginate(6);
        return view('livewire.admin-parabrisas',compact('parabrisas'));
    }
}

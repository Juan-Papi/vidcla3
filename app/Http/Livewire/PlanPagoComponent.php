<?php

namespace App\Http\Livewire;

use App\Models\PlanPago;
use Livewire\Component;
use Livewire\WithPagination;

class PlanPagoComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public function render()
    {
        $pagos = PlanPago::paginate(5);
        return view('livewire.plan-pago-component', compact('pagos'));
    }
}

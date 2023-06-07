<?php

namespace App\Http\Livewire;

use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\WithPagination;

class AdminVehiculos extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public function render()
    {
        $vehiculos = Vehiculo::paginate(6);
        return view('livewire.admin-vehiculos',compact('vehiculos'));
    }
}

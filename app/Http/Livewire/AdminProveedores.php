<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;
class AdminProveedores extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public function render()
    {   
        $proveedores = Proveedor::paginate(6);
        return view('livewire.admin-proveedores', compact('proveedores'));
    }
}

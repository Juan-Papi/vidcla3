<?php

namespace App\Http\Livewire;

use App\Models\Telefono;
use Livewire\Component;
use Livewire\WithPagination;
class TelefonoComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $telefonos = Telefono::paginate(6);
        return view('livewire.telefono-component', compact('telefonos'));
    }
}

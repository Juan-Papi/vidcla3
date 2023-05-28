<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
class AdminUsers extends Component
{ 
    
    use WithPagination;
    public $buscar;
    protected $paginationTheme = "bootstrap";
    

    public function render()
    {  
        $users = User::where('name', 'LIKE', '%' . $this->buscar . '%')
        ->orWhere('email', 'LIKE', '%' . $this->buscar . '%')
        ->paginate(6);
        return view('livewire.admin-users', compact('users'));
    }
    public function limpiar_page(){
        $this->resetPage();
    }
}

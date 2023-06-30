<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use Livewire\Component;
use Livewire\WithPagination;
class PersonalComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $personales = Personal::paginate(6);
        return view('livewire.personal-component',compact('personales'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use Livewire\Component;
use Livewire\WithPagination;
class BitacoraComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
      /*Solo asegúrate de que estás cargando la relación user cuando obtienes las bitácoras, para evitar el problema de carga diferida (N+1). Es decir, cuando obtienes las bitácoras, debes hacer algo como esto:*/
      //$bitacoras = Bitacora::with('user')->paginate(10);

        $bitacoras = Bitacora::orderBy('id', 'ASC')->paginate(10);
        return view('livewire.bitacora-component', compact('bitacoras'));
    }
}

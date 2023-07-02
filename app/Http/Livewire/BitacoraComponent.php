<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use Livewire\Component;
use Livewire\WithPagination;

class BitacoraComponent extends Component
{
  use WithPagination;
  protected $paginationTheme = "bootstrap";

  public $search;
  public $fecha_desde;
  public $fecha_hasta;

  public function updatingSearch()
  {
    $this->resetPage();
  }

  public function render()
  {
    /*Solo asegúrate de que estás cargando la relación user cuando obtienes las bitácoras, para evitar el problema de carga diferida (N+1). Es decir, cuando obtienes las bitácoras, debes hacer algo como esto:*/
    //$bitacoras = Bitacora::with('user')->paginate(10);

    $bitacoras = Bitacora::query();

    // Search for user name or email.
    if ($this->search) {
      $bitacoras = $bitacoras->whereHas('user', function ($q) {
        $q->where('name', 'like', '%' . $this->search . '%')
          ->orWhere('email', 'like', '%' . $this->search . '%');
      });
    }

    // Filter date range
    if ($this->fecha_desde) {
      $bitacoras = $bitacoras->where('fecha', '>=', $this->fecha_desde);
    }

    if ($this->fecha_hasta) {
      $bitacoras = $bitacoras->where('fecha', '<=', $this->fecha_hasta);
    }

    $bitacoras = $bitacoras->with('user')->orderBy('id', 'DESC')->paginate(10);

    return view('livewire.bitacora-component', compact('bitacoras'));
  }
}

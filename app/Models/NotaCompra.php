<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedor;
use App\Models\Almacen;
use App\Models\Parabrisa;
class NotaCompra extends Model
{
    use HasFactory;

     /*cuando tiene muchos campos(atributos)
    los sgts no se asignan masivamente*/  
    protected $guarded =['id','created_at','updated_at'];

    //Relacion de uno a muchos inversa
    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }
    //Relacion de uno a muchos inversa
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    //Relacion de uno a muchos inversa
    public function parabrisa()
    {
        return $this->belongsTo(Parabrisa::class);
    }
 
}

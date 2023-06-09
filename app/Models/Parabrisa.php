<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posicion;
use App\Models\Vehiculo;
use App\Models\Categoria;
class Parabrisa extends Model
{
    use HasFactory;
     /*cuando tiene muchos campos(atributos)
    los sgts no se asignan masivamente*/  
    protected $guarded =['id','created_at','updated_at'];

     //Relacion de uno a muchos inversa
     public function posicion(){
        return $this->BelongsTo(Posicion::class);
    }
    //Relacion de uno a muchos inversa
    public function vehiculo(){
        return $this->BelongsTo(Vehiculo::class);
    }
     //Relacion de uno a muchos inversa
     public function categoria(){
        return $this->BelongsTo(Categoria::class);
    }
     //Relacion de uno a muchos
     public function notasCompra()
     {
         return $this->hasMany(NotaCompra::class);
     }

}

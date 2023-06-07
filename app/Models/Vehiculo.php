<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Marca;
use App\Models\Parabrisa;
class Vehiculo extends Model
{
    use HasFactory;
     /*cuando tiene muchos campos(atributos)
    los sgts no se asignan masivamente*/  
    protected $guarded =['id','created_at','updated_at'];


    //Relacion de uno a muchos inversa
    public function marca(){
        return $this->BelongsTo(Marca::class);
    }
    //Relacion de uno a muchos
    public function parabrisas(){
        return $this->hasMany(Parabrisa::class);
    }
}

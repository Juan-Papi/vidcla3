<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    /*cuando tiene muchos campos(atributos)
    los sgts no se asignan masivamente*/
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //relacion de uno a muchos
    public function telefonos(){
        return $this->hasMany(Telefono::class);
    }
     //relacion de uno a muchos
     public function notasVenta(){
        return $this->hasMany(NotaVenta::class);
    }
}

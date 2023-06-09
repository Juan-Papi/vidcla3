<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NotaCompra;

class Almacen extends Model
{
    use HasFactory;
    /*cuando tiene muchos campos(atributos)
    los sgts no se asignan masivamente*/
    protected $guarded = ['id', 'created_at', 'updated_at'];


    //Relacion de uno a muchos
    public function notasCompra()
    {
        return $this->hasMany(NotaCompra::class);
    }
}

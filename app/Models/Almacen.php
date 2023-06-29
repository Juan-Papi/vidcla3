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

    protected $table = 'almacens';//proviene de la rel muchos a muchos gpt-01

    //Relacion de uno a muchos
    public function notasCompra()
    {
        return $this->hasMany(NotaCompra::class);
    }

    
    //relacion muchos a muchos gpt-01
    public function parabrisas()
    {
        return $this->belongsToMany(Parabrisa::class, 'almacen_parabrisa')
                    ->withPivot('stock');
    }
    //relacion de uno a muchos con NotaVenta
    public function notasVenta(){
        return $this->hasMany(NotaVenta::class);
    }
}

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
    protected $table = 'parabrisas';//proviene de la rel muchos a muchos gpt-01

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
     
    //Relacion muchos a muchos gpt-01
     public function almacenes()
     {
         return $this->belongsToMany(Almacen::class, 'almacen_parabrisa')
                     ->withPivot('stock');
     }
     public function notasVenta()
    {
        return $this->belongsToMany(NotaVenta::class, 'nota_venta_parabrisa')
                    ->withPivot('cantidad', 'precio_venta', 'importe')
                    ->withTimestamps();
    }
}

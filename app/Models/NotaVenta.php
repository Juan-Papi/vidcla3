<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;
    /*cuando tiene muchos campos(atributos)
    los sgts no se asignan masivamente*/
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'nota_ventas';
   
    //relacion muchos a muchos
    public function parabrisas()
    {
        return $this->belongsToMany(Parabrisa::class, 'nota_venta_parabrisa')
                    ->withPivot('cantidad', 'precio_venta', 'importe')
                    ->withTimestamps();
    }
    //relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //relacion de uno a muchos inversa
    public function cliente(){
        return $this->belongsTo(Cliente::class);;
    }

    //relacion de uno a uno
    public function factura(){
        return $this->belongsTo(Factura::class);
    }
    //relacion de uno a uno
    public function plan_pago(){
        return $this->belongsTo(PlanPago::class);
    }
     //relacion de uno a muchos inversa with Almacen
     public function almacen(){
        return $this->belongsTo(Almacen::class);
    }

}

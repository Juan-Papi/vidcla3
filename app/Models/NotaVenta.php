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

    public function parabrisas()
    {
        return $this->belongsToMany(Parabrisa::class, 'nota_venta_parabrisa')
                    ->withPivot('cantidad', 'precio_venta', 'importe')
                    ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    use HasFactory;
 
    //Asignacion masiva
    protected $fillable = [
        'nombre',
    ];
}

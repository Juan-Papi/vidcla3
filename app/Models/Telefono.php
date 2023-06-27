<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
     //Asignacion masiva
     protected $fillable = ['telefono', 'cliente_id'];

     //relacion de uno a muchos inversa
     public function cliente(){
        return $this->BelongsTo(Cliente::class);
     }
}

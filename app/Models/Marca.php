<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehiculo;
class Marca extends Model
{
    use HasFactory;

     //Asignacion masiva
     protected $fillable = [ 'nombre',];

     //Relacion de uno a muchos
     public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
     }
}

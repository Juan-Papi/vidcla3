<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parabrisa;
class Posicion extends Model
{
    use HasFactory;
    //Asignacion masiva
    protected $fillable = [ 'nombre',];

    //Relacion de uno a muchos
    public function parabrisas(){
        return $this->hasMany(Parabrisa::class);
    }
}

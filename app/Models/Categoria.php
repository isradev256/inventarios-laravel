<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

use App\Models\Servicio;
class Categoria extends Model
{
   protected $fillable = [
        'nombre',
        'descripcion'
   ];

   public function servicios(){
    return $this->hasMany(Servicio::class);
   }
}

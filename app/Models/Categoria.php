<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
   protected $fillable = [
        'nombre',
        'descripcion'
   ];
}

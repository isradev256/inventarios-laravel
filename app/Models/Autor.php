<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $fillable = [
        'nombre',
        'apellidos',
        'nacionalidad',
        'fecha_nacimiento',
    ];
}

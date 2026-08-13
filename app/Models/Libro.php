<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    protected $fillable = [
        'titulo',
        'autor',
        'precio',
        'stock',
        'fecha_publicacion',
    ];
    protected $casts = [
    'fecha_publicacion' => 'date',
];
}

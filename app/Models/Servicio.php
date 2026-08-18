<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Categoria;
class Servicio extends Model
{
    //
    protected $fillable = [

        'nombre',
        'descripcion',
        'precio',
        'duracion_minutos',
        'estado',
        'foto',
        'categoria_id',
    ];

    public function categoria(){
        return $this -> belongsTo(Categoria::class);
    }
}

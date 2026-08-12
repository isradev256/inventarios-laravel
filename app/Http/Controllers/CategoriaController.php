<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CategoriaController extends Controller
{
    public function index(){

        $categorias = Categoria::all();
        // dd($categorias);


        return view('sistema.categoria.vista',
        compact('categorias'));

    }
    public function store(Request $request){
        // dd($request -> all());

        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion'=> 'required|string',
        ]);

        $categoria = Categoria::create([
            //esto es de la tabla
            'nombre' => $request->nombre,
            'descripcion' => $request -> descripcion,
        ]);

        return redirect()->back();

    }

    public function destroy($id){
        // dd($id);
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->back();


    }
public function update(Request $request, $id)
{
    // Buscar la categoría que queremos editar
    $categoria = Categoria::findOrFail($id);

    // Validar los datos recibidos
    $request->validate([
        'nombre' => [
            'required',
            'string',
            'max:255',

            // El nombre debe ser único,
            // pero ignoramos la categoría que estamos editando.
            Rule::unique('categorias', 'nombre')
                ->ignore($categoria->id),
        ],

        // La descripción NO es única.
        // Puede repetirse en varias categorías.
        'descripcion' => [
            'required',
            'string',
        ],
    ]);

    // Actualizar nombre
    $categoria->nombre = $request->nombre;

    // Actualizar descripción
    $categoria->descripcion = $request->descripcion;

    // Guardar cambios
    $categoria->save();

    // Volver a la página anterior
    return redirect()->back();
}
}

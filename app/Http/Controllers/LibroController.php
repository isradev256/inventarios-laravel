<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Libro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LibroController extends Controller
{

    public function index(){
        $libros =Libro::all();
        // dd($libros);
        return view('sistema.libro.vista_libro',
        compact('libros'));

    }

    public function store(Request $request){
        // dd($request->all());

       try {
            $request->validate([
                'titulo' => 'required|string|max:255|unique:libros,titulo',
                'autor' => 'required|string|max:255',
                'precio' => 'required|min:0',
                'stock' => 'required|numeric|min:0',
                'fecha_publicacion' => 'required',

            ]);
            $libro = Libro::create([
                //esto es la tabla

                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'fecha_publicacion' => $request->fecha_publicacion,
        ]);
        return redirect()->back()->with('success','Libro Agregado con Exito');

       } catch (\Exception $e) {

        return redirect()->back()->with('error','error'.$e->getMessage());
       }

    }

    public function destroy($id){
        // dd($id);
        $libro = Libro::findOrFail($id);
        $libro -> delete();
        return redirect()->back()->with('success','Libro Eliminado con Exito');


    }

   public function update(Request $request, $id)
{
   try {
     $libro = Libro::findOrFail($id);

    $request->validate([
        'titulo' => [
            'required',
            'string',
            'max:255',
            Rule::unique('libros', 'titulo')->ignore($libro->id),
        ],
        'autor' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|numeric|min:0',
        'fecha_publicacion' => 'required|date',
    ]);

    $libro->titulo = $request->titulo;
    $libro->autor = $request->autor;
    $libro->precio = $request->precio;
    $libro->stock = $request->stock;
    $libro->fecha_publicacion = $request->fecha_publicacion;

    $libro->save();

    return redirect()->back()->with('success','Libro Actualizado con Exito');
   } catch (\Exception $e) {
    return redirect()->back()->with('error','error :'.$e->getMessage());
   }
}
}

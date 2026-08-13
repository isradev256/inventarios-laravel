<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    //
    public function index(){
        $autores=Autor::all();
        // dd($autores);
        return view('sistema.autor.autor',
        compact('autores'));

    }
    public function store(Request $request)  {
        try {
            $request ->validate([
                'nombre'=> 'required|string|max:255',
                'apellidos'=> 'required|string|max:255',
                'nacionalidad'=> 'required|string|max:255',
                'fecha_nacimiento'=> 'required|date',
            ]);
            $autor = Autor::create([
                'nombre'=> $request->nombre,
                'apellidos'=> $request->apellidos,
                'nacionalidad'=> $request->nacionalidad,
                'fecha_nacimiento'=> $request->fecha_nacimiento,
            ]);
            return redirect()->back()->with('success','autor agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','error : '.$e -> getMessage());
            //throw $th;
        }

    }

    public function destroy($id){
        $autor = Autor::findOrFail($id);
        $autor->delete();
        return redirect()->back()->with('success','Autor Eliminado Correctamente');


    }

    public function update (Request $request, $id){
        // dd($request);
        try {
            $autor = Autor::findOrFail($id);
            $request->validate([
                'nombre'=> 'required|string|max:255',
                'apellidos'=> 'required|string|max:255',
                'nacionalidad'=> 'required|string|max:255',
                'fecha_nacimiento'=> 'required|date',
            ]);
            $autor->nombre = $request->nombre;
            $autor->apellidos = $request->apellidos;
            $autor->nacionalidad = $request->nacionalidad;
            $autor->fecha_nacimiento = $request->fecha_nacimiento;
            $autor->save();
            return redirect()->back()->with('success','Autor Actualizado Exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','error : '.$e->getMessage());
            //throw $th;
        }
    }

}

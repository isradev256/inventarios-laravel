<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        $categorias = Categoria::all();

        return view(
            'sistema.servicio.servicio',
            compact('servicios', 'categorias')
        );
    }
    public function crear_servicio(Request $request)
    {

        // dd($request->all());
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'duracion_minutos' => 'required|integer',
                'categoria' => 'required|exists:categorias,id',
                'descripcion' => 'required|string',
                'foto'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $ruta='';
            if ($request->hasFile('foto')) {
                $ruta = $request->file('foto')->store('servicios','public');
            }
            $servicio = Servicio::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'duracion_minutos' => $request->duracion_minutos,
                'categoria_id' => $request->categoria,
                'descripcion' => $request->descripcion,
                'foto'=>$ruta,
            ]);
            return redirect()->back()->with('success', 'creado con exito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error :' . $e->getMessage());
            //throw $th;
        }
    }

    public function destroy($id)  {
        //dd($id);
       try {
         $servicio = Servicio::findOrFail($id);
        if ($servicio->foto && Storage::disk('public')->exists($servicio->foto)) {

        Storage::disk('public')->delete($servicio->foto);
            # code...
        }
        $servicio->delete();
        return redirect()->back()->with('success','Eliminado con Exito');

       } catch (\Exception $e) {
        return redirect()->back()->with('error','Error : '.$e->getMessage());

       }
    }

    // editar servicio
    public function actualizar_servicio(Request $request, $id)
{
    try {
        // 1. Validar los campos de entrada
        // Nota: La foto es opcional (nullable). Si no suben una nueva, se conserva la actual.
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'precio'           => 'required|numeric',
            'duracion_minutos' => 'required|integer',
            'categoria'        => 'required|exists:categorias,id',
            'descripcion'      => 'required|string',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Buscar el servicio a editar
        $servicio = Servicio::findOrFail($id);

        // 3. Manejar la imagen (si el usuario seleccionó un nuevo archivo)
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior del almacenamiento si existe
            if ($servicio->foto && Storage::disk('public')->exists($servicio->foto)) {
                Storage::disk('public')->delete($servicio->foto);
            }

            // Subir la nueva foto y guardar su ruta
            $servicio->foto = $request->file('foto')->store('servicios', 'public');
        }

        // 4. Actualizar los demás campos en la base de datos
        $servicio->nombre           = $request->nombre;
        $servicio->precio           = $request->precio;
        $servicio->duracion_minutos = $request->duracion_minutos;
        $servicio->categoria_id     = $request->categoria;
        $servicio->descripcion      = $request->descripcion;

        $servicio->save(); // Guardar cambios

        return redirect()->back()->with('success', 'Servicio actualizado con éxito');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}
}

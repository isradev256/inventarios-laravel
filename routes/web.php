<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);
// cada ruta tiene metodos http get, post, put,  delete


// Route::get('/categorias', function(){
//     return 'hola categoria';
// })->name('lista_categoria');
//**metodo Servicio */

Route::get('servivios',[ServicioController::class,'index'])->name('Lista_servicio');
//**metodo autores */
Route::get('autores',[AutorController::class,'index'])->name('lista_autor');
Route::post('autor/crear',[AutorController::class, 'store'])->name('crear_autor');
Route::delete('/autor/eliminar/{id}',[AutorController::class,'destroy'])->name('eliminar_autor');
Route::put('/autor/editar/{id}',[AutorController::class, 'update']);
/** metodos de libro */
Route::get('/libros',[LibroController::class,'index'])->name('lista_libro');
Route::post('libro/crear',[LibroController::class, 'store'])->name('crear_libro');

Route::delete('/libro/eliminar/{id}',[LibroController::class,'destroy'])->name('eliminar_libro');

Route::put('/libro/editar/{id}',[LibroController::class, 'update']);
/**metodos de categorias */
Route::get('/categorias',[CategoriaController::class,'index'])->name('lista_categoria');
Route::post('categoria/crear',[CategoriaController::class, 'store'])->name('crear_categoria');

Route::delete('/categoria/eliminar/{id}',[CategoriaController::class,'destroy'])->name('eliminar_categoria');

Route::put('/categoria/editar/{id}',[CategoriaController::class, 'update']);

//**Servicio */
Route::post('servicio/crear', [ServicioController::class, 'crear_servicio'])->name('crear_servicio');
Route::delete('servicio/eliminar/{id}',[ServicioController::class, 'destroy'])->name('eliminar_servicio');
// Ruta para actualizar un servicio por su ID (usa PUT)
Route::put('servicio/actualizar/{id}', [ServicioController::class, 'actualizar_servicio'])->name('actualizar_servicio');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);

//Language Translation

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');


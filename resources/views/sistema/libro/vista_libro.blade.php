@extends('layouts.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Tables
        @endslot
        @slot('title')
            Datatables
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Lista de Libros</h4>
                            <p class="card-title-desc">actualiza tus Libros: <code>crear , actualizar, lista y elimina
                                </code>.
                            </p>
                        </div>


                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#modalAgregarLibro">
                            Agregar Un Libro
                        </button>

                    </div>



                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>titulo</th>
                                <th>autor</th>
                                <th>precio</th>
                                <th>stock </th>
                                <th>fecha de publicacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libros as $libro)
                                <tr>
                                    <td>{{ $libro->id }}</td>
                                    <td>{{ $libro->titulo }}</td>
                                    <td>{{ $libro->autor }}</td>
                                    <td>{{ $libro->precio }}</td>
                                    <td>{{ $libro->stock }}</td>
                                   <td>{{ $libro->fecha_publicacion->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="">
                                                <!-- El tooltip se coloca en el div contenedor o se maneja por JS, eliminando el doble toggle -->
                                                <button type="button"
                                                    class="btn btn-outline-success btn-sm btn-editar-libro"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditarLibro"
                                                    data-id="{{ $libro->id }}"
                                                    data-titulo="{{ $libro->titulo }}"
                                                    data-autor="{{ $libro->autor }}"
                                                    data-precio="{{ $libro->precio }}"
                                                    data-stock="{{ $libro->stock }}"
                                                     data-fecha_publicacion="{{ $libro->fecha_publicacion->format('Y-m-d') }}"


                                                    title="Editar">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            </div>

                                            <div class="">
                                               <form action="{{ route('eliminar_libro', $libro->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                 <button
                                                    class="btn btn-outline-danger btn-sm btn-eliminar-libro"
                                                    type="submit"
                                                    title="Eliminar"
                                                    >
                                                     <i class="uil uil-trash-alt"></i>
                                                </button>
                                               </form>


                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    {{-- * MODAL AGREGAR LIBRO --}}

    <div class="modal fade" id="modalAgregarLibro" tabindex="-1" aria-labelledby="modalAgregarLibroLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarLibroLabel">Agregar un Libro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                {{-- MODAL CREAR --}}
                <form action="{{ route('crear_libro') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="" class="form-label">Titulo</label>
                                <input type="text" class="form-control" name="titulo" id=""
                                    aria-describedby="helpId" placeholder="agrega un titulo" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Autor</label>
                                <input type="text" class="form-control" name="autor" id=""
                                    aria-describedby="helpId" placeholder="agregar nombre del autor" required />
                            </div>
                            <div class="col-md-6">

                                <label for="" class="form-label">precio</label>
                                <input type="number" class="form-control" name="precio" id=""
                                    aria-describedby="helpId" placeholder="0.00" step="0.01" required />
                            </div>

                            <div class="col-md-6">

                                <label for="" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id=""
                                    aria-describedby="helpId" placeholder="stock disponible" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Fecha de Publicacion</label>
                                <input type="date" class="form-control" name="fecha_publicacion" id=""
                                    aria-describedby="helpId" placeholder="" required />
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    {{-- * MODAL EDITAR LIBRO --}}

    <div class="modal fade" id="modalEditarLibro" tabindex="-1" aria-labelledby="modalEditarLibroLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLibroLabel">Editar un Libro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                {{-- FORMULARIO EDITAR --}}
                <form action=""  id="formEditar" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="" class="form-label">Titulo</label>
                                <input type="text" class="form-control" name="titulo" id="edit_titulo"
                                    aria-describedby="helpId" placeholder="agrega un titulo" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Autor</label>
                                <input type="text" class="form-control" name="autor" id="edit_autor"
                                    aria-describedby="helpId" placeholder="agregar nombre del autor" required />
                            </div>
                            <div class="col-md-6">

                                <label for="" class="form-label">precio</label>
                                <input type="number" class="form-control" name="precio" id="edit_precio"
                                    aria-describedby="helpId" placeholder="0.00" step="0.01" required />
                            </div>

                            <div class="col-md-6">

                                <label for="" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="edit_stock"
                                    aria-describedby="helpId" placeholder="stock disponible" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Fecha de Publicacion</label>
                                <input type="date" class="form-control" name="fecha_publicacion" id="edit_fecha_publicacion"
                                    aria-describedby="helpId" placeholder="" required />
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Buscamos todos los botones que tengan la clase
            // "btn-editar-categoria"
            const botonesEditar = document.querySelectorAll('.btn-editar-libro');
            // Recorremos todos los botones encontrados
            botonesEditar.forEach(btn => {
                // Agregamos un evento para detectar cuando
                // el usuario haga clic en un botón
                btn.addEventListener('click', function() {
                    // ==============================
                    // 1. OBTENER LOS DATOS DEL BOTÓN
                    // ==============================
                    // Obtenemos el ID desde data-id
                    const id = this.dataset.id;
                    console.log(id);
                    // 2. MOSTRAR LOS DATOS EN EL FORMULARIO
                    // ==============================
                    // Buscamos el input del nombre
                    const titulo = document.getElementById('edit_titulo').value=this.dataset.titulo;
                    const autor = document.getElementById('edit_autor').value=this.dataset.autor;
                    const precio = document.getElementById('edit_precio').value=this.dataset.precio;
                    const stock = document.getElementById('edit_stock').value=this.dataset.stock;
                    const fecha_publicacion = document.getElementById('edit_fecha_publicacion').value=this.dataset.fecha_publicacion;


                    // ==============================
                    // 3. CAMBIAR LA URL DEL FORMULARIO
                    // ==============================
                    // utilizando el ID de libro
                    //
                    // Por ejemplo, si id = 5:
                    // /libro/editar/5
                    formulario.action = `/libro/editar/${id}`;


                });


            });

        });
    </script>  // Buscamos el formulario
                    const formulario = document.getElementById('formEditar');
                    // Cambiamos dinámicamente el atributo "action"
                    // utilizando el ID de libro
                    //
                    // Por ejemplo, si id = 5:
                    // /libro/editar/5
                    formulario.action = `/libro/editar/${id}`;


                });


            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                title: '{{ session('success') }}',
                icon: "success",
                showConfirmButton: false,
                timer: 3000,

            });
        @elseif(session('error'))
              Swal.fire({
                title: 'Ups Ocurrio un Error!',
                text: '{{ session('error') }}',
                icon: "error",
                showConfirmButton: true,

            });
        @endif
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection

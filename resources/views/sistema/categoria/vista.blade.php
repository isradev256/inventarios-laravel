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

    <h1>hola isradev</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- @dump($categorias) --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Lista de Categorias</h4>
                            <p class="card-title-desc">actualiza tus categorias: <code>crear , actualizar, lista y elimina
                                </code>.
                            </p>
                        </div>


                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#modalCrear">
                            Crear Categoria
                        </button>

                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->id }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->descripcion }}</td>
                                    <td>
                                        <form action="{{ route('eliminar_categoria', $categoria->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">
                                                Eliminar
                                            </button>

                                        </form>
                                        <button class="btn btn-outline-primary btn-sm btn-editar-categoria"
                                            data-bs-toggle="modal" data-bs-target="#modalEditar"
                                            data-id="{{ $categoria->id }}" data-nombre="{{ $categoria->nombre }}"
                                            data-descripcion="{{ $categoria->descripcion }}">
                                            editar
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    {{-- MODAL CREAR --}}

    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCrearLabel">Crear Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                {{-- MODAL CREAR --}}
                <form action="{{ route('crear_categoria') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="" class="form-label">Nombre Categoria</label>
                                <input type="text" class="form-control" name="nombre" id=""
                                    aria-describedby="helpId" placeholder="agregar categoria" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id=""
                                    aria-describedby="helpId" placeholder="agregar descripcion" required />
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

    {{-- MODAL EDITAR --}}

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Editar Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                {{-- MODAL CREAR --}}
                <form id="formEditar" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="" class="form-label">Nombre Categoria</label>
                                <input type="text" class="form-control" name="nombre" id="edit_nombre"
                                    aria-describedby="helpId" placeholder="agregar categoria" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="edit_descripcion"
                                    aria-describedby="helpId" placeholder="agregar descripcion" required />
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
            const botonesEditar = document.querySelectorAll('.btn-editar-categoria');
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
                    // Obtenemos el nombre desde data-nombre
                    const nombre = this.dataset.nombre;
                    // Obtenemos la descripción desde data-descripcion
                    const descripcion = this.dataset.descripcion;
                    // ==============================
                    // 2. MOSTRAR LOS DATOS EN EL FORMULARIO
                    // ==============================
                    // Buscamos el input del nombre
                    const inputNombre = document.getElementById('edit_nombre');
                    // Colocamos el nombre de la categoría
                    inputNombre.value = nombre;
                    // Buscamos el textarea de la descripción
                    const inputDescripcion = document.getElementById('edit_descripcion');
                    // Colocamos la descripción de la categoría
                    inputDescripcion.value = descripcion;
                    // ==============================
                    // 3. CAMBIAR LA URL DEL FORMULARIO
                    // ==============================
                    // Buscamos el formulario
                    const formulario = document.getElementById('formEditar');
                    // Cambiamos dinámicamente el atributo "action"
                    // utilizando el ID de la categoría
                    //
                    // Por ejemplo, si id = 5:
                    // /categoria/editar/5
                    formulario.action = `/categoria/editar/${id}`;


                });

            });

        });
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection

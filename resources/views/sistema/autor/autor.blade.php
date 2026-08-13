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
                            <h4 class="card-title">Lista de Autores</h4>
                            <p class="card-title-desc">Gestiona a tus Autores: <code>crea , actualiza, lista y elimina
                                </code>.
                            </p>
                        </div>


                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#modalAgregarAutor">
                            Agregar un Autor
                        </button>

                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nombre</th>
                                <th>apellidos</th>
                                <th>nacionalidad</th>
                                <th>fecha de nacimiento</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($autores as $autor)
                                <tr>
                                    <td>{{ $autor->id }}</td>
                                    <td>{{ $autor->nombre }}</td>
                                    <td>{{ $autor->apellidos }}</td>
                                    <td>{{ $autor->nacionalidad }}</td>
                                    <td>{{ $autor->fecha_nacimiento }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="">
                                                <!-- El tooltip se coloca en el div contenedor o se maneja por JS, eliminando el doble toggle -->
                                                <button type="button"
                                                    class="btn btn-outline-success btn-sm btn-editar-autor"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditarAutor"
                                                    data-id="{{ $autor->id }}"
                                                    data-nombre="{{ $autor->nombre }}"
                                                    data-apellidos="{{ $autor->apellidos }}"
                                                    data-nacionalidad="{{ $autor->nacionalidad }}"
                                                    data-fecha_nacimiento="{{ $autor->fecha_nacimiento }}" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            </div>

                                            <div class="">
                                                <form action="{{ route('eliminar_autor', $autor->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm btn-eliminar-autor"
                                                        type="submit" title="Eliminar">
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

    {{-- *Modal  Agregar autor --}}
    <div class="modal fade" id="modalAgregarAutor" tabindex="-1" aria-labelledby="modalAgregarAutorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarAutorLabel">Agregar un Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                {{-- Formulario CREAR --}}
                <form action="{{ route('crear_autor') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id=""
                                    aria-describedby="helpId" placeholder="agrega un titulo" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id=""
                                    aria-describedby="helpId" placeholder="agregar nombre del autor" required />
                            </div>
                            <div class="col-md-6">

                                <label for="" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control" name="nacionalidad" id=""
                                    aria-describedby="helpId" placeholder="Boliviana" steprequired />
                            </div>


                            <div class="col-md-6">
                                <label for="" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" id=""
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

    {{-- *Modal  EDITAR autor --}}
    <div class="modal fade" id="modalEditarAutor" tabindex="-1" aria-labelledby="modalEditarAutorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarAutorLabel">Editar un Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                {{-- Formulario editar --}}
                <form action="" id="formEditar" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="edit_nombre"
                                    aria-describedby="helpId" placeholder="agrega un titulo" required />
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id="edit_apellidos"
                                    aria-describedby="helpId" placeholder="agregar nombre del autor" required />
                            </div>
                            <div class="col-md-6">

                                <label for="" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control" name="nacionalidad" id="edit_nacionalidad"
                                    aria-describedby="helpId" placeholder="Boliviana" steprequired />
                            </div>


                            <div class="col-md-6">
                                <label for="" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento"
                                    id="edit_fecha_nacimiento" aria-describedby="helpId" placeholder="" required />
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
            const botonesEditar = document.querySelectorAll('.btn-editar-autor');
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
                    const nombre = document.getElementById('edit_nombre').value = this.dataset
                        .nombre;
                    const apellidos = document.getElementById('edit_apellidos').value = this.dataset
                        .apellidos;
                    const nacionalidad = document.getElementById('edit_nacionalidad').value = this
                        .dataset.nacionalidad;
                    const fecha_nacimiento = document.getElementById('edit_fecha_nacimiento')
                        .value = this.dataset.fecha_nacimiento;


                    // ==============================
                    // 3. CAMBIAR LA URL DEL FORMULARIO
                    // ==============================
                    // Buscamos el formulario
                    const formulario = document.getElementById('formEditar');
                    // Cambiamos dinámicamente el atributo "action"
                    // utilizando el ID de libro
                    //
                    // Por ejemplo, si id = 5:
                    // /libro/editar/5
                    formulario.action = `/autor/editar/${id}`;


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
        @elseif (session('error'))
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

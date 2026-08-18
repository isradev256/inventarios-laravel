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
            Servicios
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Administra tus Servicios </h4>
                            <p class="card-title-desc">actualiza tus Servicios: <code>crear , actualizar, lista y elimina
                                </code>.
                            </p>
                        </div>


                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#modalCrear">
                            Agregar Servicio
                        </button>

                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nombre</th>
                                <th>descripcion</th>
                                <th>precio</th>
                                <th>duracion_minutos</th>
                                <th>estado</th>
                                <th>foto</th>
                                <th>categoria</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $servicio)
                                <tr>
                                    <td>{{ $servicio->id }}</td>
                                    <td>{{ $servicio->nombre }}</td>
                                    <td>{{ $servicio->descripcion }}</td>
                                    <td>{{ $servicio->precio }}</td>
                                    <td>{{ $servicio->duracion_minutos }}</td>
                                    <td>{{ $servicio->estado }}</td>
                                    <td>
                                        <div>
                                            <img src="{{ asset('storage/' . $servicio->foto) }}" width="50"
                                                height="50"
                                                class="rounded-circle shadow-sm d-flex justify-content-center align-items-center"
                                                alt="">
                                        </div>
                                    </td>
                                    <td>{{ $servicio->categoria->nombre }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- BOTÓN VER DETALLE -->
                                            <button type="button" class="btn btn-outline-info btn-sm btn-ver-servicio"
                                                data-bs-toggle="modal" data-bs-target="#modalVerDetalle"
                                                data-nombre="{{ $servicio->nombre }}"
                                                data-descripcion="{{ $servicio->descripcion }}"
                                                data-precio="{{ $servicio->precio }}"
                                                data-duracion="{{ $servicio->duracion_minutos }}"
                                                data-estado="{{ $servicio->estado }}"
                                                data-categoria="{{ $servicio->categoria->nombre }}"
                                                data-foto="{{ asset('storage/' . $servicio->foto) }}" title="Ver Detalle">
                                                <i class="uil uil-eye"></i>
                                            </button>

                                            <!-- BOTÓN EDITAR -->
                                            <button type="button"
                                                class="btn btn-outline-success btn-sm btn-editar-servicio"
                                                data-bs-toggle="modal" data-bs-target="#modalEditar"
                                                data-id="{{ $servicio->id }}" data-nombre="{{ $servicio->nombre }}"
                                                data-descripcion="{{ $servicio->descripcion }}"
                                                data-precio="{{ $servicio->precio }}"
                                                data-duracion="{{ $servicio->duracion_minutos }}"
                                                data-categoria="{{ $servicio->categoria_id }}"
                                                data-foto="{{ asset('storage/' . $servicio->foto) }}" title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>

                                            <!-- BOTÓN ELIMINAR -->
                                            <form action="{{ route('eliminar_servicio', $servicio->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm" type="submit"
                                                    title="Eliminar">
                                                    <i class="uil uil-trash-alt"></i>
                                                </button>
                                            </form>
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


    {{-- ══════════ MODAL CREAR ══════════ --}}
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('crear_servicio') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-primary bg-gradient">
                        <h5 class="modal-title text-white">
                            <i class="uil uil-shield-check me-2"></i>Nuevo ...
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Nombre del Servicio
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="uil uil-tag-alt"></i>
                                    </span>
                                    <input type="text" name="nombre" class="form-control" placeholder="Ej: ..."
                                        required />

                                </div>

                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Categoria
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="uil uil-tag-alt"></i>
                                    </span>
                                    <select name="categoria" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>



                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Precio
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="uil uil-tag-alt"></i>
                                    </span>
                                    <input type="number" step="0.01" name="precio" class="form-control"
                                        placeholder="Ej: ..." required />
                                </div>



                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Duracion Minutos
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="uil uil-tag-alt"></i>
                                    </span>
                                    <input type="number" name="duracion_minutos" class="form-control"
                                        placeholder="Ej: ..." required />
                                </div>


                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-medium">Descripcion
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="uil uil-tag-alt"></i>
                                    </span>
                                    <textarea name="descripcion" id="" class="form-control"></textarea>
                                </div>

                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-medium">Foto
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="uil uil-tag-alt"></i>
                                    </span>
                                    <input type="file" id="fotoInputCrear" name="foto" class="form-control"
                                        placeholder="Ej: ..." required />
                                </div>
                            </div>
                            <div class="mt-3 text-center" id="previewContainerCrear" style="display: none">
                                <img src="#" id="imagePreviewCrear" alt="Vista previa" class="img-fluid rounded"
                                    style="max-height: 200px;">
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                <i class="uil uil-times me-1"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="uil uil-check me-1"></i>Guardar ...
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="" id="formEditar" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header bg-primary bg-gradient">
                        <h5 class="modal-title text-white">
                            <i class="uil uil-edit me-2"></i>EDITAR SERVICIO
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Nombre del Servicio <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nombre" id="edit_nombre" class="form-control" required />
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Categoría <span class="text-danger">*</span></label>
                                <select name="categoria" id="edit_categoria" class="form-control" required>
                                    <option value="" disabled>Seleccione</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Precio <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="precio" id="edit_precio"
                                    class="form-control" required />
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-medium">Duración (Minutos) <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="duracion_minutos" id="edit_duracion_minutos"
                                    class="form-control" required />
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-medium">Descripción <span class="text-danger">*</span></label>
                                <textarea name="descripcion" id="edit_descripcion" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-medium">Cambiar Foto (Opcional)</label>
                                <input type="file" id="fotoInputEditar" name="foto" class="form-control" />
                            </div>

                            <div class="mt-3 text-center" id="previewContainerEditar">
                                <label class="d-block text-muted small mb-1">Imagen Actual / Previa:</label>
                                <img src="" id="imagePreviewEditar" alt="Vista previa"
                                    class="img-fluid rounded border" style="max-height: 180px;">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL VER DETALLES -->
    <div class="modal fade" id="modalVerDetalle" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info bg-gradient">
                    <h5 class="modal-title text-white">
                        <i class="uil uil-info-circle me-2"></i>DETALLE DEL SERVICIO
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="det_foto" src="" class="img-fluid rounded mb-3 shadow-sm"
                        style="max-height: 200px; object-fit: cover;">
                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item"><strong>Nombre:</strong> <span id="det_nombre"></span></li>
                        <li class="list-group-item"><strong>Categoría:</strong> <span id="det_categoria"></span></li>
                        <li class="list-group-item"><strong>Precio:</strong> $<span id="det_precio"></span></li>
                        <li class="list-group-item"><strong>Duración:</strong> <span id="det_duracion"></span> min</li>
                        <li class="list-group-item"><strong>Estado:</strong> <span id="det_estado"
                                class="badge bg-success"></span></li>
                        <li class="list-group-item"><strong>Descripción:</strong>
                            <p id="det_descripcion" class="text-muted mb-0"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>




    {{-- Comentario de plantilla Blade --}}
    <script>
        // Escuchar el evento 'change' en el input de archivo (cuando se selecciona una imagen)
        document.getElementById('fotoInputCrear').addEventListener('change', function(e) {

            // Obtener el primer archivo seleccionado del input
            const file = e.target.files[0];

            // Obtener las referencias a los elementos del DOM (contenedor e imagen)
            const previewContainer = document.getElementById('previewContainerCrear');
            const imagePreview = document.getElementById('imagePreviewCrear');

            // Comprobar si el usuario realmente seleccionó un archivo
            if (file) {
                // Instanciar el lector de archivos de la API nativa de JavaScript
                const reader = new FileReader();

                // Evento que se dispara automáticamente cuando la lectura del archivo se completa
                reader.onload = function(event) {
                    // Asignar el contenido leído (en formato Data URL / Base64) al atributo src de la imagen
                    imagePreview.src = event.target.result;

                    // Hacer visible el contenedor del preview
                    previewContainer.style.display = 'block';
                };

                // Iniciar la lectura del archivo seleccionado y convertirlo a una URL codificada
                reader.readAsDataURL(file);

            } else {
                // Si el usuario cancela la selección, ocultar el contenedor y resetear el src
                previewContainer.style.display = 'none';
                imagePreview.src = '#';
            }
        });

        // Evento de jQuery/Bootstrap que detecta cuando el modal '#modalCrear' se ha cerrado por completo
        $('#modalCrear').on('hidden.bs.modal', function() {
            // Vaciar el valor del input para que no conserve el archivo previo
            document.getElementById('fotoInputCrear').value = '';

            // Ocultar el contenedor de vista previa
            document.getElementById('previewContainerCrear').style.display = 'none';

            // Limpiar la imagen previa
            document.getElementById('imagePreviewCrear').src = '#';
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



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==========================================
            // 1. EVENTO GLOBAL PARA EDITAR Y VER DETALLES
            // ==========================================
            document.addEventListener('click', function(e) {

                // --- A. ACCIÓN PARA EDITAR ---
                const btnEditar = e.target.closest('.btn-editar-servicio');
                if (btnEditar) {
                    // Obtener datos del botón mediante dataset
                    const id = btnEditar.dataset.id;
                    const nombre = btnEditar.dataset.nombre;
                    const descripcion = btnEditar.dataset.descripcion;
                    const precio = btnEditar.dataset.precio;
                    const duracion = btnEditar.dataset.duracion;
                    const categoria = btnEditar.dataset.categoria;
                    const foto = btnEditar.dataset.foto;

                    // Llenar inputs del formulario
                    document.getElementById('edit_nombre').value = nombre;
                    document.getElementById('edit_categoria').value = categoria;
                    document.getElementById('edit_precio').value = precio;
                    document.getElementById('edit_duracion_minutos').value = duracion;
                    document.getElementById('edit_descripcion').value = descripcion;

                    // Cargar la foto actual en el elemento img
                    const imagePreview = document.getElementById('imagePreviewEditar');
                    if (foto) {
                        imagePreview.src = foto;
                    }

                    // Cambiar el action del formulario dinámicamente
                    const formulario = document.getElementById('formEditar');
                    formulario.action = `/servicio/actualizar/${id}`;
                }

                // --- B. ACCIÓN PARA VER DETALLES ---
                const btnVer = e.target.closest('.btn-ver-servicio');
                if (btnVer) {
                    document.getElementById('det_nombre').textContent = btnVer.dataset.nombre;
                    document.getElementById('det_categoria').textContent = btnVer.dataset.categoria;
                    document.getElementById('det_precio').textContent = btnVer.dataset.precio;
                    document.getElementById('det_duracion').textContent = btnVer.dataset.duracion;
                    document.getElementById('det_estado').textContent = btnVer.dataset.estado;
                    document.getElementById('det_descripcion').textContent = btnVer.dataset.descripcion;
                    document.getElementById('det_foto').src = btnVer.dataset.foto;
                }
            });

            // ==========================================
            // 2. PREVISUALIZAR NUEVA FOTO EN EL INPUT FILE
            // ==========================================
            const fotoInputEditar = document.getElementById('fotoInputEditar');
            if (fotoInputEditar) {
                fotoInputEditar.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            document.getElementById('imagePreviewEditar').src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

        });
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection

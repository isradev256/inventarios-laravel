<button
    class="btn btn-sm btn-outline-primary btn-editar-categoria"
    data-bs-toggle="modal"
    data-bs-target="#editCategoriaModal"
    data-id="{{ $categoria->id }}"
    data-nombre="{{ $categoria->nombre }}"
    data-activo="{{ $categoria->activo }}">
    <i class="uil-edit"></i> Editar
</button>

{{-- ══════════ MODAL EDITAR ══════════ --}}
<div class="modal fade" id="editCategoriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="formEditarCategoria">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary bg-gradient">
                    <h5 class="modal-title text-white">
                        <i class="uil uil-edit me-2"></i>Editar categoría
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="activo" id="edit_activo" class="form-select">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const botonesEditar = document.querySelectorAll('.btn-editar-categoria');

    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function () {

            const id = this.dataset.id;
            const nombre = this.dataset.nombre;
            const activo = this.dataset.activo;

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_activo').value = activo;

            // actualizar action dinámicamente
            document.getElementById('formEditarCategoria').action = `/categoria/${id}`;
        });
    });

});
</script>

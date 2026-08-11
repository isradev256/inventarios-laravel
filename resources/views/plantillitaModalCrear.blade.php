{{-- ══════════ MODAL CREAR ══════════ --}}
<div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="">
                @csrf

                <div class="modal-header bg-primary bg-gradient">
                    <h5 class="modal-title text-white">
                        <i class="uil uil-shield-check me-2"></i>Nuevo ...
                    </h5>
                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                    ></button>
                </div>

                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label fw-medium"
                            >Nombre del ...
                            <span class="text-danger">*</span></label
                        >
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Ej: ..."
                            required
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        <i class="uil uil-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="uil uil-check me-1"></i>Guardar ...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

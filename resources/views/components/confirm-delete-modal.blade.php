<div x-data="{ show: false, formId: null, itemName: '' }"
     x-init="window.confirmDeleteModal = { open(id, name) { formId = id; itemName = name; show = true; }, close() { show = false; } }"
     x-on:keydown.escape.window="show = false"
     x-show="show"
     x-cloak
     style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1055; background: transparent;">

    <div x-show="show"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="position: fixed; inset: 0; background: rgba(15,23,42,0.45);"
         x-on:click="show = false">
    </div>

    <div x-show="show"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="d-flex align-items-center justify-content-center"
         style="min-height: 100vh; padding: 1rem;">
        <div class="modal-content border-0 shadow-lg bg-white" style="max-width: 420px; width: 100%; border-radius: 14px;">

            <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                <h6 class="fw-bold m-0 d-flex align-items-center" style="color: #dc2626; font-size: 0.85rem; letter-spacing: 0.3px;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirmer la suppression
                </h6>
                <button type="button" class="btn-close shadow-none" style="font-size: 0.75rem;" x-on:click="show = false" aria-label="Close"></button>
            </div>

            <div class="text-center px-4 py-4">
                <div class="mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 56px; height: 56px; background: #fef2f2;">
                        <i class="bi bi-trash3" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </span>
                </div>
                <p class="fw-semibold mb-1" style="color: #1e293b; font-size: 0.9rem;">
                    Êtes-vous sûr de vouloir supprimer
                </p>
                <p class="fw-bold mb-0" style="color: #dc2626; font-size: 0.9rem; word-break: break-word;" x-text="itemName || 'cet élément'"></p>
                <p class="text-muted small mt-2 mb-0" style="font-size: 0.8rem;">Cette action est irréversible.</p>
            </div>

            <div class="d-flex justify-content-end gap-2 px-4 py-3 border-top" style="background: #f8fafc; border-radius: 0 0 14px 14px;">
                <button type="button" class="btn btn-sm fw-medium" style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 1.2rem; border: 1px solid #cbd5e1; background: #fff; color: #475569;"
                        x-on:click="show = false">
                    Annuler
                </button>
                <button type="button"
                        class="btn btn-sm fw-semibold d-inline-flex align-items-center gap-1 border-0"
                        style="border-radius: 8px; font-size: 0.8rem; padding: 0.4rem 1.2rem; background: #dc2626; color: #fff; box-shadow: 0 1px 3px rgba(220,38,38,0.25);"
                        x-on:click="if(formId) { document.getElementById(formId).submit(); } show = false">
                    <i class="bi bi-trash3"></i> Supprimer
                </button>
            </div>

        </div>
    </div>
</div>
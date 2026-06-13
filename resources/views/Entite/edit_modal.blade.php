<div class="modal fade" id="editEntiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEntiteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; background-color: #ffffff; font-family: 'Inter', sans-serif;">
            
            <!-- Modal Header -->
            <div class="modal-header border-bottom py-3 px-4" style="border-top-left-radius: 14px; border-top-right-radius: 14px; border-color: #f1f5f9 !important;">
                <h5 class="modal-title h6 fw-bold text-uppercase m-0" id="editEntiteModalLabel" style="letter-spacing: 0.5px; color: #0f172a;">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier l'entité
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form id="editEntiteForm" method="POST" class="m-0">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    <div class="mb-0">
                        <label for="edit_designationEntite" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">
                            Désignation de l'entité
                        </label>
                        <input type="text" 
                               name="designationEntite" 
                               id="edit_designationEntite" 
                               class="form-control" 
                               placeholder="Ex: Direction Technique..."
                               required
                               style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.65rem 0.85rem; font-size: 0.875rem; color: #0f172a;">
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-top p-3 px-4" style="background-color: #f8fafc; border-bottom-left-radius: 14px; border-bottom-right-radius: 14px; border-color: #f1f5f9 !important;">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2 small fw-medium" data-bs-dismiss="modal" style="border-radius: 8px; font-size: 0.8rem;">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary text-white px-4 py-2 border-0 shadow-sm fw-semibold" style="border-radius: 8px; font-size: 0.8rem; background-color: #2563eb;">
                        Enregistrer
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
    /* Focus styling */
    #edit_designationEntite:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12) !important;
    }
</style>
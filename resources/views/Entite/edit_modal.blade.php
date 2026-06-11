<div class="modal fade" id="editEntiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEntiteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border border-light-subtle shadow-lg bg-white">
            
            <div class="modal-header bg-dark text-white rounded-0 border-bottom border-secondary border-opacity-25 py-3">
                <h5 class="modal-title h6 fw-bold text-uppercase tracking-wider m-0" id="editEntiteModalLabel" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <i class="bi bi-pencil-square text-info me-2"></i> Modifier l'entité
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editEntiteForm" method="POST" class="m-0">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    <div class="mb-1">
                        <label for="edit_designationEntite" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Désignation de l'entité
                        </label>
                        <input type="text" 
                               name="designationEntite" 
                               id="edit_designationEntite" 
                               class="form-control bg-light text-dark border border-secondary-subtle rounded-0 py-2.5" 
                               placeholder="Ex: Direction Technique ou Service Informatique"
                               required
                               style="font-size: 0.9rem;">
                    </div>
                </div>

                <div class="modal-footer bg-light rounded-0 border-top border-light-subtle p-3">
                    <button type="button" class="btn btn-outline-secondary rounded-0 fw-bold px-4 border-secondary-subtle" data-bs-dismiss="modal" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                        ANNULER
                    </button>
                    <button type="submit" class="btn btn-info text-white rounded-0 fw-bold px-4 shadow-sm" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                        ENREGISTRER
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
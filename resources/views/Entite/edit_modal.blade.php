<div class="modal fade" id="editEntiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEntiteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border border-light-subtle shadow-lg bg-white">
            
            <div class="modal-header bg-dark text-white rounded-0 border-bottom border-secondary border-opacity-50 py-3">
                <h5 class="modal-title h6 fw-bold text-uppercase tracking-wider m-0" id="editEntiteModalLabel">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier l'entité
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editEntiteForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body p-4">
                    
                    <div class="mb-3">
                        <label for="edit_designationEntite" class="form-label text-dark fw-semibold small mb-1">Désignation de l'entité</label>
                        <input type="text" 
                               name="designationEntite" 
                               id="edit_designationEntite" 
                               class="form-control rounded-0" 
                               placeholder="Ex: Direction Technique ou Service Informatique"
                               required>
                    </div>

                </div>

                <div class="modal-footer bg-light rounded-0 border-top border-light-subtle p-3">
                    <button type="button" class="btn btn-outline-secondary rounded-0 fw-semibold px-4 small" data-bs-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary rounded-0 fw-semibold px-4 shadow-sm small">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
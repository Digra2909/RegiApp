<div class="modal fade" id="editPosteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPosteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-0 border border-light-subtle shadow-lg bg-white">
            
            <div class="modal-header bg-dark text-white rounded-0 border-bottom border-secondary border-opacity-50 py-3">
                <h5 class="modal-title h6 fw-bold text-uppercase tracking-wider m-0" id="editPosteModalLabel">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier le poste
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editPosteForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body p-4">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_designationPoste" class="form-label text-dark fw-semibold small mb-1">Désignation du poste</label>
                            <input type="text" 
                                   name="designationPoste" 
                                   id="edit_designationPoste" 
                                   class="form-control rounded-0" 
                                   placeholder="Ex: Chef de Station" 
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_nomResponsble" class="form-label text-dark fw-semibold small mb-1">Nom du responsable</label>
                            <input type="text" 
                                   name="nomResponsble" 
                                   id="edit_nomResponsble" 
                                   class="form-control rounded-0" 
                                   placeholder="Ex: Jean Mukendi" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="edit_poste_parent_id" class="form-label text-dark fw-semibold small mb-1">Rattaché à l'entité</label>
                        <select name="entite_id" id="edit_poste_parent_id" class="form-select rounded-0" required>
                            <option value="" disabled>Choisir l'entité...</option>
                            @foreach($entites as $entite)
                                <option value="{{ $entite->id }}">{{ $entite->designationEntite }}</option>
                            @endforeach
                        </select>
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
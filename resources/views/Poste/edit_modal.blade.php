<div class="modal fade" id="editPosteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPosteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-0 border border-light-subtle shadow-lg bg-white">
            
            <!-- En-tête épuré (Fond blanc / Texte sombre / Accent info) -->
            <div class="modal-header bg-white text-dark rounded-0 border-bottom border-light-subtle py-3 px-4">
                <h5 class="modal-title h6 fw-bold text-uppercase m-0" id="editPosteModalLabel" style="letter-spacing: 0.5px;">
                    <i class="bi bi-pencil-square text-info me-2"></i> Modifier le poste
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editPosteForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    <div class="row g-3">
                        <!-- Champ 1 : Désignation -->
                        <div class="col-md-6">
                            <label for="edit_designationPoste" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Désignation du poste</label>
                            <input type="text" 
                                   name="designationPoste" 
                                   id="edit_designationPoste" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   placeholder="Ex: Chef de Station" 
                                   required
                                   style="font-size: 0.9rem;">
                        </div>

                        <!-- Champ 2 : Responsable -->
                        <div class="col-md-6">
                            <label for="edit_nomResponsble" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Nom du responsable</label>
                            <input type="text" 
                                   name="nomResponsble" 
                                   id="edit_nomResponsble" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   placeholder="Ex: Jean Mukendi" 
                                   required
                                   style="font-size: 0.9rem;">
                        </div>

                        <!-- Champ 3 : Entité -->
                        <div class="col-12 mt-2">
                            <label for="edit_poste_parent_id" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Rattaché à l'entité</label>
                            <select name="entite_id" 
                                    id="edit_poste_parent_id" 
                                    class="form-select bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                    required
                                    style="font-size: 0.9rem;">
                                <option value="" disabled>Choisir l'entité...</option>
                                @foreach($entites as $entite)
                                    <option value="{{ $entite->id }}">
                                        {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Pied de page avec boutons rectilignes -->
                <div class="modal-footer bg-light rounded-0 border-top border-light-subtle p-3 px-4">
                    <button type="button" class="btn btn-outline-secondary rounded-0 fw-bold px-4 py-2" data-bs-dismiss="modal" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                        ANNULER
                    </button>
                    <button type="submit" class="btn btn-info text-white rounded-0 fw-bold px-4 py-2 border-0 shadow-sm" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                        ENREGISTRER
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
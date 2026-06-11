<div class="modal fade" id="editEquipementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEquipementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-0 border border-light-subtle shadow-lg bg-white">
            
            <div class="modal-header bg-white text-dark rounded-0 border-bottom border-light-subtle py-3 px-4">
                <h5 class="modal-title h6 fw-bold text-uppercase m-0" id="editEquipementModalLabel" style="letter-spacing: 0.5px;">
                    <i class="bi bi-pencil-square text-info me-2"></i> Modifier l'équipement
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editEquipementForm" method="POST" class="m-0">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    
                    <div id="modalErrorAlert" class="alert alert-danger rounded-0 d-none bg-danger bg-opacity-10 border border-danger text-danger py-3 px-4 mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Veuillez corriger les erreurs dans le formulaire.
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_designationEquipement" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Désignation de l'équipement</label>
                            <input type="text" 
                                   name="designationEquipement" 
                                   id="edit_designationEquipement" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   required
                                   style="font-size: 0.9rem;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_NserieEquipement" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Numéro de série</label>
                            <input type="text" 
                                   name="NserieEquipement" 
                                   id="edit_NserieEquipement" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   required
                                   style="font-size: 0.9rem;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_nImmoEquipement" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">N° Immatriculation / Immo</label>
                            <input type="text" 
                                   name="nImmoEquipement" 
                                   id="edit_nImmoEquipement" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   required
                                   style="font-size: 0.9rem;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_dateAcc" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Date d'acquisition</label>
                            <input type="date" 
                                   name="dateAcc" 
                                   id="edit_dateAcc" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   required
                                   style="font-size: 0.9rem;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_Observation" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">État / Observation</label>
                            <select name="Observation" id="edit_Observation" class="form-select bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" required style="font-size: 0.9rem;">
                                <option value="Bon état">Bon état</option>
                                <option value="Hors service">Hors service</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="edit_poste_id" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Rattaché au poste de travail</label>
                            <select name="poste_id" id="edit_poste_id" class="form-select bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" required style="font-size: 0.9rem;">
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}">{{ $poste->designationPoste }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="edit_autreSpecTech" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Autres spécifications techniques (Optionnel)</label>
                            <input type="text" 
                                   name="autreSpecTech" 
                                   id="edit_autreSpecTech" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3"
                                   style="font-size: 0.9rem;">
                        </div>
                    </div>

                </div>

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
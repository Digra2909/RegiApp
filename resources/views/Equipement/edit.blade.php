<div class="modal fade" id="editEquipementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEquipementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-0 border border-light-subtle shadow">
            
            <div class="modal-header bg-dark text-white rounded-0 border-bottom border-secondary border-opacity-50 py-3">
                <h5 class="modal-title h6 fw-bold text-uppercase tracking-wider m-0" id="editEquipementModalLabel">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier l'équipement
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editEquipementForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    
                    <div id="modalErrorAlert" class="alert alert-danger rounded-0 d-none" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Veuillez corriger les erreurs dans le formulaire.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_designationEquipement" class="form-label text-dark fw-semibold small mb-1">Désignation de l'équipement</label>
                            <input type="text" 
                                   name="designationEquipement" 
                                   id="edit_designationEquipement" 
                                   class="form-control rounded-0" 
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_NserieEquipement" class="form-label text-dark fw-semibold small mb-1">Numéro de série</label>
                            <input type="text" 
                                   name="NserieEquipement" 
                                   id="edit_NserieEquipement" 
                                   class="form-control rounded-0" 
                                   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nImmoEquipement" class="form-label text-dark fw-semibold small mb-1">N° Immatriculation / Immo</label>
                            <input type="text" 
                                   name="nImmoEquipement" 
                                   id="edit_nImmoEquipement" 
                                   class="form-control rounded-0" 
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_dateAcc" class="form-label text-dark fw-semibold small mb-1">Date d'acquisition</label>
                            <input type="date" 
                                   name="dateAcc" 
                                   id="edit_dateAcc" 
                                   class="form-control rounded-0" 
                                   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_Observation" class="form-label text-dark fw-semibold small mb-1">État / Observation</label>
                            <select name="Observation" id="edit_Observation" class="form-select rounded-0" required>
                                <option value="Bon état">Bon état</option>
                                <option value="Hors service">Hors service</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_poste_id" class="form-label text-dark fw-semibold small mb-1">Rattaché au poste de travail</label>
                            <select name="poste_id" id="edit_poste_id" class="form-select rounded-0" required>
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}">{{ $poste->designationPoste }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="edit_autreSpecTech" class="form-label text-dark fw-semibold small mb-1">Autres spécifications techniques (Optionnel)</label>
                        <input type="text" 
                               name="autreSpecTech" 
                               id="edit_autreSpecTech" 
                               class="form-control rounded-0">
                    </div>

                </div>

                <div class="modal-footer bg-light rounded-0 border-top border-light-subtle p-3">
                    <button type="button" class="btn btn-outline-secondary rounded-0 fw-semibold px-4" data-bs-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary rounded-0 fw-semibold px-4 shadow-sm">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="editEquipementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEquipementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; background-color: #ffffff; font-family: 'Inter', sans-serif;">
            
            <div class="modal-header bg-white border-bottom py-3 px-4" style="border-top-left-radius: 14px; border-top-right-radius: 14px; border-color: #f1f5f9 !important;">
                <h5 class="modal-title h6 fw-bold text-uppercase m-0" id="editEquipementModalLabel" style="letter-spacing: 0.5px; color: #0f172a;">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier l'équipement
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close" style="font-size: 0.85rem;"></button>
            </div>

            <form id="editEquipementForm" method="POST" class="m-0">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    
                    <div id="modalErrorAlert" class="alert alert-danger border-0 rounded-3 d-none py-3 px-4 mb-4 d-flex align-items-center" role="alert" style="background-color: #fef2f2; color: #991b1b;">
                        <i class="bi bi-exclamation-triangle-fill me-2.5 fs-5"></i>
                        <div class="small fw-medium">Veuillez corriger les erreurs détectées dans le formulaire.</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_designationEquipement" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Désignation de l'équipement</label>
                            <input type="text" 
                                   name="designationEquipement" 
                                   id="edit_designationEquipement" 
                                   class="form-control" 
                                   required
                                   style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_NserieEquipement" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Numéro de série</label>
                            <input type="text" 
                                   name="NserieEquipement" 
                                   id="edit_NserieEquipement" 
                                   class="form-control" 
                                   required
                                   style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_nImmoEquipement" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">N° Immatriculation / Immo</label>
                            <input type="text" 
                                   name="nImmoEquipement" 
                                   id="edit_nImmoEquipement" 
                                   class="form-control font-monospace" 
                                   required
                                   style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_dateAcc" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Date d'acquisition</label>
                            <input type="date" 
                                   name="dateAcc" 
                                   id="edit_dateAcc" 
                                   class="form-control" 
                                   required
                                   style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                        </div>

                        <div class="col-md-6">
                            <label for="edit_Observation" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">État / Observation</label>
                            <select name="Observation" id="edit_Observation" class="form-select" required style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                                <option value="Bon état">Bon état</option>
                                <option value="Hors service">Hors service</option>
                                <option value="En maintenance">En maintenance</option>
                                <option value="Déclassé">Déclassé</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="edit_poste_id" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Rattaché au poste de travail</label>
                            <select name="poste_id" id="edit_poste_id" class="form-select" required style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}">{{ $poste->designationPoste }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="edit_autreSpecTech" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Autres spécifications techniques (Optionnel)</label>
                            <input type="text" 
                                   name="autreSpecTech" 
                                   id="edit_autreSpecTech" 
                                   class="form-control"
                                   style="border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.55rem 0.75rem; font-size: 0.875rem; color: #0f172a;">
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-top p-3 px-4" style="background-color: #f8fafc; border-bottom-left-radius: 14px; border-bottom-right-radius: 14px; border-color: #f1f5f9 !important;">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2 small fw-medium" data-bs-dismiss="modal" style="border-radius: 8px; font-size: 0.8rem; letter-spacing: 0.3px;">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary text-white px-4 py-2 border-0 shadow-sm fw-semibold" style="border-radius: 8px; font-size: 0.8rem; letter-spacing: 0.3px; background-color: #2563eb;">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
    /* Styles dynamiques appliqués uniquement au focus des éléments de la modal */
    .modal-content .form-control:focus, 
    .modal-content .form-select:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12) !important;
        background-color: #ffffff !important;
    }
</style>
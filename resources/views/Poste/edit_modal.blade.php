<div class="modal fade" id="editPosteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPosteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; background-color: #ffffff; font-family: 'Inter', sans-serif;">
            
            <!-- En-tête -->
            <div class="modal-header border-bottom py-3 px-4" style="border-top-left-radius: 14px; border-top-right-radius: 14px; border-color: #f1f5f9 !important;">
                <h5 class="modal-title h6 fw-bold text-uppercase m-0" id="editPosteModalLabel" style="letter-spacing: 0.5px; color: #0f172a;">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier le poste
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editPosteForm" method="POST" class="m-0">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    <div class="row g-3">
                        <!-- Champ 1 : Désignation -->
                        <div class="col-md-6">
                            <label for="edit_designationPoste" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">
                                Désignation du poste
                            </label>
                            <input type="text" 
                                   name="designationPoste" 
                                   id="edit_designationPoste" 
                                   class="form-control form-control-modal" 
                                   placeholder="Ex: Chef de Station" 
                                   required>
                        </div>

                        <!-- Champ 2 : Responsable -->
                        <div class="col-md-6">
                            <label for="edit_nomResponsble" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">
                                Nom du responsable
                            </label>
                            <input type="text" 
                                   name="nomResponsble" 
                                   id="edit_nomResponsble" 
                                   class="form-control form-control-modal" 
                                   placeholder="Ex: Jean Mukendi" 
                                   required>
                        </div>

                        <!-- Champ 3 : Entité -->
                        <div class="col-12 mt-3">
                            <label for="edit_poste_parent_id" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">
                                Rattaché à l'entité
                            </label>
                            <select name="entite_id" 
                                    id="edit_poste_parent_id" 
                                    class="form-select form-select-modal" 
                                    required>
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

                <!-- Pied de page -->
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
    /* Intégration de la charte de saisie sur la modal */
    .form-control-modal, .form-select-modal {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1;
        padding: 0.65rem 0.85rem;
        font-size: 0.875rem;
        color: #0f172a;
        background-color: #ffffff;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-modal:focus, .form-select-modal:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12) !important;
        outline: none;
        background-color: #ffffff;
    }
</style>
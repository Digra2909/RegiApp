@extends('layouts.main')
@section('titre', 'Gestion des Postes')
@section('content')

<!-- Google Fonts & Icons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Cohérence avec la charte graphique globale */
    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc;
        color: #1e293b;
    }
    .custom-card {
        background: #ffffff;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05) !important;
    }
    .form-control-custom, .form-select-custom {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1;
        padding: 0.6rem 0.8rem;
        font-size: 0.875rem;
        background-color: #ffffff;
        color: #0f172a;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        outline: none;
    }
    .btn-submit-custom {
        border-radius: 8px !important;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
        height: 43px;
        transition: all 0.15s ease;
    }
    .btn-submit-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(14, 116, 144, 0.15);
    }
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px !important;
        transition: all 0.15s ease;
    }
    .custom-badge {
        background-color: #eff6ff;
        color: #1d4ed8;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
    }
</style>

<div class="container-fluid dashboard-wrapper min-vh-100 p-0">
    <div class="row g-0">
        <!-- Sidebar de Navigation -->
        <div class="col-md-3 col-lg-2 p-0 border-end" style="background: #0f172a;">
            @include('layouts.nav_box')
        </div>

        <!-- Zone de Contenu Principal -->
        <div class="col-md-9 col-lg-10 d-flex flex-column min-vh-100 px-4 py-4">
            
            <!-- SECTION 1 : BARRE SUPÉRIEURE & FORMULAIRE D'AJOUT -->
            <div class="d-flex flex-column pb-4 mb-4 border-bottom" style="border-color: #e2e8f0 !important;">
                <div class="mb-4">
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.4px;">Gestion des Postes</h3>
                    <p class="text-muted small mb-0">Configurez les postes de travail et affectez les responsables au sein de l'organisation.</p>
                </div>

                <!-- Formulaire Horizontal -->
                <form action="{{ route('Poste.store') }}" method="POST" class="m-0 w-100 custom-card p-4 shadow-sm bg-white">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <!-- Champ 1 : Désignation -->
                        <div class="col-lg-4 col-md-6">
                            <label for="designationPoste" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Désignation du poste</label>
                            <input type="text" 
                                   name="designationPoste" 
                                   id="designationPoste" 
                                   class="form-control form-control-custom @error('designationPoste') is-invalid @enderror" 
                                   placeholder="Ex: Chef de Station" 
                                   value="{{ old('designationPoste') }}"
                                   required>
                            @error('designationPoste')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ 2 : Responsable -->
                        <div class="col-lg-3 col-md-6">
                            <label for="nomResponsble" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Nom du responsable</label>
                            <input type="text" 
                                   name="nomResponsble" 
                                   id="nomResponsble" 
                                   class="form-control form-control-custom @error('nomResponsble') is-invalid @enderror" 
                                   placeholder="Ex: Jean Mukendi" 
                                   value="{{ old('nomResponsble') }}"
                                   required>
                            @error('nomResponsble')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ 3 : Entité Rattachée -->
                        <div class="col-lg-3 col-md-8">
                            <label for="entite_id" class="form-label mb-1" style="font-size: 0.725rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b;">Rattaché à l'entité</label>
                            <select name="entite_id" 
                                    id="entite_id" 
                                    class="form-select form-select-custom @error('entite_id') is-invalid @enderror" 
                                    required>
                                <option value="" selected disabled>Choisir une entité...</option>
                                @foreach($entites as $entite)
                                    <option value="{{ $entite->id }}" {{ old('entite_id') == $entite->id ? 'selected' : '' }}>
                                        {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('entite_id')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton Ajouter -->
                        <div class="col-lg-2 col-md-4 text-end">
                            <button type="submit" class="btn btn-info text-white btn-submit-custom w-100 border-0 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-plus-circle-fill"></i> AJOUTER
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- SECTION 2 : COMPOSANT ALERTES -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4 p-3 shadow-sm d-flex align-items-center" role="alert" style="background-color: #f0fdf4; color: #166534;">
                    <i class="bi bi-check2-all me-2.5 fs-5"></i>
                    <div class="fw-medium small">{{ session('success') }}</div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="padding: 1.25rem; font-size: 0.75rem;"></button>
                </div>
            @endif
            
            <!-- SECTION 3 : TABLEAU DES POSTES -->
            <div class="w-100">
                <div class="d-flex align-items-center mb-3">
                    <h6 class="text-uppercase tracking-wider text-secondary small fw-bold d-flex align-items-center m-0" style="font-size: 11px; letter-spacing: 0.5px;">
                        <span class="text-primary me-2">■</span> Postes Enregistrés ({{ count($postes) }})
                    </h6>
                </div>

                <!-- Conteneur Table -->
                <div class="table-responsive border rounded-3 shadow-sm custom-card overflow-hidden">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="table-light text-secondary border-bottom fw-semibold" style="font-size: 11px; background-color: #f8fafc; border-color: #e2e8f0 !important;">
                                <th scope="col" class="py-3 ps-4 text-uppercase border-0" style="width: 70px;">N°</th>
                                <th scope="col" class="py-3 text-uppercase border-0">Poste</th>
                                <th scope="col" class="py-3 text-uppercase border-0">Responsable</th>
                                <th scope="col" class="py-3 text-uppercase border-0">Entité rattachée</th>
                                <th scope="col" class="py-3 pe-4 text-end text-uppercase border-0" style="width: 130px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px; color: #334155;">
                            @forelse($postes as $index => $poste)
                                <tr class="border-bottom" style="border-color: #f1f5f9;">
                                    <td class="py-3 ps-4 text-muted font-monospace small border-0">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </td>
                                    <td class="py-3 fw-semibold text-dark border-0">
                                        {{ $poste->designationPoste ?? $poste->designation ?? $poste->nom }}
                                    </td>
                                    <td class="py-3 text-muted border-0">
                                        {{ $poste->nomResponsble ?? $poste->nom_responsable ?? 'Non assigné' }}
                                    </td>
                                    <td class="py-3 border-0">
                                        <span class="custom-badge">
                                            <i class="bi bi-building me-1"></i>
                                            {{ $poste->entite->designationEntite ?? $poste->entite->designation ?? $poste->entite->nom ?? 'Aucune entité' }}
                                        </span>
                                    </td>
                                    <td class="py-3 pe-4 text-end border-0">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Modifier -->
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-primary action-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editPosteModal"
                                                    data-id="{{ $poste->id }}"
                                                    data-designation="{{ $poste->designationPoste }}"
                                                    data-responsable="{{ $poste->nomResponsble }}"
                                                    data-parent="{{ $poste->entite_id }}"
                                                    title="Modifier">
                                                <i class="bi bi-pencil-square"></i> 
                                            </button>
                                            
                                            <!-- Supprimer -->
                                            <form action="{{ route('Poste.destroy', $poste->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger action-btn" title="Supprimer">
                                                    <i class="bi bi-trash3"></i> 
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted border-0">
                                        <i class="bi bi-folder-x display-6 d-block mb-3 opacity-25"></i>
                                        <span class="d-block opacity-75 small text-uppercase tracking-wider fw-semibold" style="font-size: 11px;">Aucun poste disponible pour le moment</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@include('Poste.edit_modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editPosteModal = document.getElementById('editPosteModal');
    
    if (editPosteModal) {
        editPosteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');
            const responsable = button.getAttribute('data-responsable');
            const parentId = button.getAttribute('data-parent'); // Identifiant de l'entité parente

            const form = document.getElementById('editPosteForm');
            form.setAttribute('action', `/Poste/${id}`);

            document.getElementById('edit_designationPoste').value = designation;
            document.getElementById('edit_nomResponsble').value = responsable;
            
            // Assignation de la valeur au select de la modal d'édition
            const selectParent = document.getElementById('edit_entite_id') || document.getElementById('edit_poste_parent_id');
            if (selectParent) {
                selectParent.value = parentId ? parentId : "";
            }
        });
    }
});
</script>
@endsection
@extends('layouts.main')
@section('titre', 'Gestion des Postes')
@section('content')

<!-- Inclusion des icônes Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid bg-white text-dark min-vh-100 p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2">
            @include('layouts.nav_box')
        </div>

        <!-- Zone de Contenu Principal (Fond Blanc) -->
        <div class="col-md-10 d-flex flex-column min-vh-100 px-5 py-4 bg-white">
            
            <!-- SECTION 1 : BARRE SUPÉRIEURE (Formulaire disposé en Flex sous le titre) -->
            <div class="d-flex flex-column pb-4 mb-5 border-bottom border-light-subtle">
                <!-- Titre et sous-titre -->
                <div class="mb-4">
                    <h2 class="h3 text-dark fw-bold mb-1" style="letter-spacing: -0.5px;">Gestion des Postes</h2>
                    <p class="text-muted small mb-0">Configurez les postes de travail et affectez les responsables.</p>
                </div>

                <!-- Formulaire horizontal en Flexbox pur Bootstrap -->
                <form action="{{ route('Poste.store') }}" method="POST" class="m-0 w-100">
                    @csrf
                    
                    <div class="d-flex flex-column flex-lg-row gap-3 align-items-lg-end">
                        <!-- Champ 1 : Désignation -->
                        <div class="flex-grow-1">
                            <label for="designationPoste" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Désignation du poste</label>
                            <input type="text" 
                                   name="designationPoste" 
                                   id="designationPoste" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   placeholder="Ex: Chef de Station" 
                                   value="{{ old('designationPoste') }}"
                                   required
                                   style="font-size: 0.9rem;">
                            @error('designationPoste')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ 2 : Responsable -->
                        <div class="flex-grow-1">
                            <label for="nomResponsble" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Nom du responsable</label>
                            <input type="text" 
                                   name="nomResponsble" 
                                   id="nomResponsble" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                   placeholder="Ex: Jean Mukendi" 
                                   value="{{ old('nomResponsble') }}"
                                   required
                                   style="font-size: 0.9rem;">
                            @error('nomResponsble')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ 3 : Entité -->
                        <div class="flex-grow-1" style="min-width: 250px;">
                            <label for="entite_id" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Rattaché à l'entité</label>
                            <select name="entite_id" 
                                    id="entite_id" 
                                    class="form-select bg-light text-dark border-secondary-subtle rounded-0 py-2.5 px-3" 
                                    required
                                    style="font-size: 0.9rem;">
                                <option value="" selected disabled>Choisir une entité...</option>
                                @foreach($entites as $entite)
                                    <option value="{{ $entite->id }}" {{ old('entite_id') == $entite->id ? 'selected' : '' }}>
                                        {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('entite_id')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton Ajouter -->
                        <div class="flex-shrink-0">
                            <button type="submit" class="btn btn-info text-white rounded-0 fw-bold py-2.5 px-4 border-0 shadow-sm" style="font-size: 0.85rem; letter-spacing: 0.5px; height: 43px;">
                                AJOUTER
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- SECTION 2 : COMPOSANT ALERTES -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-0 mb-4 bg-success bg-opacity-10 border border-success text-success py-3 px-4" role="alert">
                    <i class="bi bi-check2-all me-2 fw-bold"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- SECTION 3 : TABLEAU AVEC RELIEF ET OMBRE PORTÉE (SHADOW) -->
            <div class="w-100">
                <div class="mb-4">
                    <span class="text-info fw-bold" style="font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase;">
                        Postes Enregistrés ({{ count($postes) }})
                    </span>
                </div>

                <div class="table-responsive border border-light-subtle shadow rounded-0 bg-white">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="table-light border-bottom border-secondary-subtle">
                                <th scope="col" class="py-3 ps-4 text-secondary text-uppercase border-0" style="width: 80px; font-size: 0.8rem; letter-spacing: 1px;">N°</th>
                                <th scope="col" class="py-3 text-secondary text-uppercase border-0" style="font-size: 0.8rem; letter-spacing: 1px;">Poste</th>
                                <th scope="col" class="py-3 text-secondary text-uppercase border-0" style="font-size: 0.8rem; letter-spacing: 1px;">Responsable</th>
                                <th scope="col" class="py-3 text-secondary text-uppercase border-0" style="font-size: 0.8rem; letter-spacing: 1px;">Entité rattachée</th>
                                <th scope="col" class="py-3 pe-4 text-end text-secondary text-uppercase border-0" style="width: 150px; font-size: 0.8rem; letter-spacing: 1px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($postes as $index => $poste)
                                <tr class="border-bottom border-light-subtle">
                                    <td class="py-3 ps-4 text-muted small border-0">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </td>
                                    <td class="py-3 fw-semibold text-dark fs-6 border-0">
                                        {{ $poste->designationPoste ?? $poste->designation ?? $poste->nom }}
                                    </td>
                                    <td class="py-3 text-muted border-0">
                                        {{ $poste->nomResponsble ?? $poste->nom_responsable ?? 'Non assigné' }}
                                    </td>
                                    <td class="py-3 border-0">
                                        <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-0 fw-semibold" style="font-size: 0.8rem;">
                                            {{ $poste->entite->designationEntite ?? $poste->entite->designation ?? $poste->entite->nom ?? 'Aucune entité' }}
                                        </span>
                                    </td>
                                    <td class="py-3 pe-4 text-end border-0">
                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="button" 
                                                    class="btn p-0 text-muted link-info border-0 bg-transparent" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editPosteModal"
                                                    data-id="{{ $poste->id }}"
                                                    data-designation="{{ $poste->designationPoste }}"
                                                    data-responsable="{{ $poste->nomResponsble }}"
                                                    data-parent="{{ $poste->poste_id }}"
                                                    title="Modifier">
                                                <i class="bi bi-pencil-square fs-5"></i> 
                                            </button>
                                            
                                            <form action="{{ route('Poste.destroy', $poste->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0 text-muted link-danger border-0 bg-transparent" title="Supprimer">
                                                    <i class="bi bi-trash3 fs-5"></i> 
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted bg-light border-0">
                                        <i class="bi bi-folder-x display-6 d-block mb-3 opacity-50"></i>
                                        <span class="fs-6 text-muted fw-medium">Aucun poste disponible pour le moment</span>
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
            const parentId = button.getAttribute('data-parent');

            const form = document.getElementById('editPosteForm');
            form.setAttribute('action', `/Poste/${id}`);

            document.getElementById('edit_designationPoste').value = designation;
            document.getElementById('edit_nomResponsble').value = responsable;
            
            const selectParent = document.getElementById('edit_poste_parent_id');
            if (selectParent) {
                selectParent.value = parentId ? parentId : "";
            }
        });
    }
});
</script>
@endsection
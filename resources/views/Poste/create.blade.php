@extends('layouts.main')
@section('titre', 'Gestion des Postes')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 p-0">
            @include('layouts.nav_box')
        </div>

        <div class="col-md-9 col-lg-10 my-5 px-4">
            <div class="card border border-light-subtle shadow-sm rounded-0 bg-white p-4">
                
                <div class="d-flex flex-column flex-xl-row justify-content-between align-items-xl-start pb-4 mb-4 border-bottom border-light-subtle">
                    
                    <div class="mb-4 mb-xl-0 d-flex flex-column justify-content-between h-100" style="max-width: 350px;">
                        <div>
                            <h2 class="h4 text-primary fw-bold mb-1">Enregistrer un poste</h2>
                            <small class="text-muted d-block mb-4">Configurez un nouveau poste de travail et affectez son responsable.</small>
                        </div>
                        
                        <div class="text-primary opacity-25 mt-3 d-none d-xl-block" style="width: 100%; max-width: 280px; height: auto;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 80" fill="currentColor">
                                <path d="M50 25 L50 45 M50 45 L20 45 L20 55 M50 45 L80 45 L80 55" stroke="currentColor" stroke-width="1" stroke-dasharray="2,2" fill="none"/>
                                
                                <circle cx="50" cy="12" r="6"/>
                                <path d="M38 25 C38 20, 62 20, 62 25 Z"/>
                                
                                <circle cx="20" cy="58" r="5"/>
                                <path d="M10 69 C10 65, 30 65, 30 69 Z"/>
                                
                                <circle cx="80" cy="58" r="5"/>
                                <path d="M70 69 C70 65, 90 65, 90 69 Z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="w-100" style="max-width: 550px;">
                        <form action="{{ route('Poste.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="designationPoste" class="form-label text-dark fw-semibold small mb-1">Désignation du poste</label>
                                <input type="text" 
                                       name="designationPoste" 
                                       id="designationPoste" 
                                       class="form-control rounded-0 @error('designationPoste') is-invalid @enderror" 
                                       placeholder="Ex: Chef de Station" 
                                       value="{{ old('designationPoste') }}"
                                       required>
                                @error('designationPoste')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomResponsble" class="form-label text-dark fw-semibold small mb-1">Nom du responsable</label>
                                <input type="text" 
                                       name="nomResponsble" 
                                       id="nomResponsble" 
                                       class="form-control rounded-0 @error('nomResponsble') is-invalid @enderror" 
                                       placeholder="Ex: Jean Mukendi" 
                                       value="{{ old('nomResponsble') }}"
                                       required>
                                @error('nomResponsble')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="entite_id" class="form-label text-dark fw-semibold small mb-1">Rattaché à l'entité</label>
                                <select name="entite_id" 
                                        id="entite_id" 
                                        class="form-select rounded-0 @error('entite_id') is-invalid @enderror" 
                                        required>
                                    <option value="" selected disabled>Choisir une entité...</option>
                                    @foreach($entites as $entite)
                                        <option value="{{ $entite->id }}" {{ old('entite_id') == $entite->id ? 'selected' : '' }}>
                                            {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('entite_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('Poste.index') }}" class="btn btn-outline-secondary rounded-0 fw-semibold px-4">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-primary rounded-0 fw-semibold px-4 shadow-sm">
                                    Enregistrer le poste
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="pt-3">
                    <div class="mb-3">
                        <h5 class="text-uppercase tracking-wider text-secondary small fw-bold d-flex align-items-center">
                            <span class="text-primary me-2">■</span> Liste des postes enregistrés
                        </h5>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0 mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="table-responsive border border-secondary border-opacity-50 rounded-0">
                        <table class="table table-dark table-striped table-hover align-middle m-0">
                            <thead class="table-group-divider border-secondary">
                                <tr class="text-white-50 small fw-bold bg-dark">
                                    <th scope="col" class="py-3 ps-4" style="width: 70px;">N°</th>
                                    <th scope="col" class="py-3">Poste</th>
                                    <th scope="col" class="py-3">Responsable</th>
                                    <th scope="col" class="py-3">Entité rattachée</th>
                                    <th scope="col" class="py-3 pe-4 text-end" style="width: 220px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($postes as $index => $poste)
                                    <tr class="border-bottom border-secondary border-opacity-25">
                                        <td class="py-3 ps-4 text-light small">
                                            {{ sprintf('%02d', $index + 1) }}
                                        </td>
                                        <td class="py-3 fw-bold text-white">
                                            {{ $poste->designationPoste ?? $poste->designation ?? $poste->nom }}
                                        </td>
                                        <td class="py-3 text-white-50">
                                            {{ $poste->nomResponsble ?? $poste->nom_responsable ?? 'Non assigné' }}
                                        </td>
                                        <td class="py-3 text-info fw-semibold small">
                                            {{ $poste->entite->designationEntite ?? $poste->entite->designation ?? $poste->entite->nom ?? 'Aucune entité' }}
                                        </td>
                                        <td class="py-3 pe-4 text-end">
                                            <div class="d-inline-flex gap-2">
                                                    <button type="button" 
                                                        class="btn btn-sm btn-outline-primary rounded-0 px-2 py-1 small fw-semibold" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editPosteModal"
                                                        data-id="{{ $poste->id }}"
                                                        data-designation="{{ $poste->designationPoste }}"
                                                        data-responsable="{{ $poste->nomResponsble }}"
                                                        data-parent="{{ $poste->poste_id }}"
                                                        title="Modifier">
                                                    <i class="bi bi-pencil-square"></i> 
                                                </button>
                                                
                                                <form action="{{ route('Poste.destroy', $poste->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 px-2 py-1 small fw-semibold" title="Supprimer">
                                                        <i class="bi bi-trash3 me-1"></i> 
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-white-50 bg-dark">
                                            <i class="bi bi-folder-x display-6 d-block mb-3 opacity-50"></i>
                                            <span class="d-block opacity-75 small text-uppercase tracking-wide">Aucun poste disponible pour le moment</span>
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
</div>
@include('Poste.edit_modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editPosteModal = document.getElementById('editPosteModal');
    
    if (editPosteModal) {
        editPosteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton sur lequel on a cliqué
            
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');
            const responsable = button.getAttribute('data-responsable');
            const parentId = button.getAttribute('data-parent');

            // Injection dynamique de la route de mise à jour
            const form = document.getElementById('editPosteForm');
            form.setAttribute('action', `/Poste/${id}`);

            // Remplissage des champs textuels et du Select parent
            document.getElementById('edit_designationPoste').value = designation;
            document.getElementById('edit_nomResponsble').value = responsable;
            
            const selectParent = document.getElementById('edit_poste_parent_id');
            selectParent.value = parentId ? parentId : "";
        });
    }
});
</script>
@endsection
@extends('layouts.main')
@section('titre', 'Les postes')
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
            
            <!-- SECTION 1 : BARRE SUPÉRIEURE -->
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center pb-4 mb-5 border-bottom border-light-subtle">
                <div>
                    <h2 class="h3 text-dark fw-bold mb-1" style="letter-spacing: -0.5px;">Gestion des Entités</h2>
                    <p class="text-muted small mb-0">Visualisez et configurez les structures de la Regideso.</p>
                </div>

                <!-- Formulaire compact aligné à droite -->
                <div class="mt-3 mt-lg-0 w-100" style="max-width: 400px;">
                    <form action="{{ route('Entite.store') }}" method="POST" class="m-0">
                        @csrf
                        <div class="input-group border border-secondary-subtle">
                            <span class="input-group-text bg-light border-0 text-muted rounded-0 px-3">
                                <i class="bi bi-plus-square-fill text-info"></i>
                            </span>
                            <input type="text" 
                                   name="designation" 
                                   id="designation" 
                                   class="form-control bg-light text-dark border-0 rounded-0 py-2.5 px-2" 
                                   placeholder="Nouvelle entité (ex: Direction...)" 
                                   required 
                                   style="font-size: 0.9rem;">
                            <button class="btn btn-info text-white rounded-0 fw-bold px-3" type="submit" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                AJOUTER
                            </button>
                        </div>
                        @error('designation')
                            <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            <!-- SECTION 2 : ALERTES -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-0 mb-4 bg-success bg-opacity-10 border border-success text-success py-3 px-4" role="alert">
                    <i class="bi bi-check2-all me-2 fw-bold"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- SECTION 3 : TABLEAU AVEC RELIEF (SHADOW) -->
            <div class="w-100">
                <div class="d-flex align-items-center mb-4">
                    <span class="text-info fw-bold" style="font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase;">
                        Structures Enregistrées ({{ count($entites) }})
                    </span>
                </div>

                <!-- Conteneur avec ombre moyenne (shadow), bordure fine et aucun arrondi (rounded-0) -->
                <div class="table-responsive border border-light-subtle shadow rounded-0 bg-white">
                    <!-- table-hover gère le survol de ligne proprement -->
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <!-- En-tête gris très clair discret pour structurer sans assombrir -->
                            <tr class="table-light border-bottom border-secondary-subtle">
                                <th scope="col" style="width: 80%; font-size: 0.8rem; letter-spacing: 1px;" class="text-secondary text-uppercase py-3 ps-4 border-0">Désignation de l'entité</th>
                                <th scope="col" style="width: 20%; font-size: 0.8rem; letter-spacing: 1px;" class="text-secondary text-uppercase py-3 text-end pe-4 border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entites as $entite)
                                <tr class="border-bottom border-light-subtle">
                                    <td class="text-dark fw-semibold py-3 ps-4 fs-6 border-0">
                                        {{ $entite->designationEntite }}
                                    </td>
                                    <td class="text-end pe-4 py-3 border-0">
                                        <div class="d-flex justify-content-end gap-3">
                                            <!-- Modifier (Lien textuel discret) -->
                                            <button type="button" 
                                                    class="btn p-0 text-muted link-info border-0 bg-transparent" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editEntiteModal"
                                                    data-id="{{ $entite->id }}"
                                                    data-designation="{{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}"
                                                    title="Modifier">
                                                <i class="bi bi-pencil-square fs-5"></i> 
                                            </button>

                                            <!-- Supprimer -->
                                            <form action="{{ route('Entite.destroy', $entite->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entité ?');">
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
                                    <td colspan="2" class="text-center text-muted py-5 bg-light border-0">
                                        <i class="bi bi-hstack display-6 d-block mb-3 text-muted opacity-50"></i>
                                        <span class="fs-6 text-muted fw-medium">Aucune entité enregistrée pour le moment.</span>
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

@include('Entite.edit_modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editEntiteModal = document.getElementById('editEntiteModal');
    
    if (editEntiteModal) {
        editEntiteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');

            const form = document.getElementById('editEntiteForm');
            form.setAttribute('action', `/Entite/${id}`); 

            document.getElementById('edit_designationEntite').value = designation;
        });
    }
});
</script>
@endsection
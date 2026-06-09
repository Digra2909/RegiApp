@extends('layouts.main')
@section('titre', 'Les postes')
@section('content')

<!-- Inclusion des icônes Bootstrap si elles ne sont pas chargées dans layouts.main -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar : prend 3 colonnes sur 12 sur écran moyen et large -->
        <div class="col-md-3 col-lg-2 p-0">
            @include('layouts.nav_box')
        </div>

        <!-- Contenu principal : prend le reste de l'espace -->
        <div class="col-md-9 col-lg-10 my-5 px-4">
            <div class="card border border-light-subtle shadow-sm rounded-0 bg-white p-4">
                
                <!-- PREMIÈRE DIVISION : En-tête avec Titre à gauche et Formulaire à droite -->
                <div class="d-flex flex-column flex-xl-row justify-content-between align-items-xl-start pb-4 mb-4 border-bottom border-light-subtle">
                    <!-- Partie gauche : Titres -->
                    <div class="mb-3 mb-xl-0">
                        <h2 class="h4 text-primary fw-bold mb-1">Enregistrer une entité</h2>
                        <small class="text-muted">Ajoutez de nouvelles structures dans le système.</small>
                    </div>
                    
                    <!-- Partie droite : Formulaire à champ unique -->
                    <div class="w-100" style="max-width: 450px;">
                        <form action="{{ route('Entite.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="designation" class="form-label text-dark fw-semibold small mb-1">Désignation entité</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="designation" 
                                           id="designation" 
                                           class="form-control rounded-0 @error('designation') is-invalid @enderror" 
                                           placeholder="Ex: Direction Générale" 
                                           required>
                                    <button class="btn btn-primary rounded-0 fw-semibold px-3" type="submit">
                                        Enregistrer
                                    </button>
                                </div>
                                @error('designation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>

                <!-- DEUXIÈME DIVISION : Liste -->
                <div class="pt-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white p-2 me-3 d-inline-block rounded-0" style="width: 4px; height: 24px;"></div>
                        <h4 class="h5 text-dark fw-semibold m-0 text-uppercase tracking-wider">Liste des entités</h4>
                    </div>
                    
                    <!-- Alertes de succès de Laravel (Flash messages) -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0 mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Tableau dynamique des entités -->
                    <div class="table-responsive border border-light-subtle rounded-0">
                        <table class="table table-striped table-dark  table-hover align-middle mb-0">
                            <thead class="table-dark rounded-0">
                                <tr>
                                    <th scope="col" style="width: 75%;" class="ps-4 py-3">Désignation</th>
                                    <th scope="col" style="width: 25%;" class="text-end pe-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entites as $entite)
                                    <tr>
                                        <td  class="ps-4 fw-medium text-light">
                                            {{ $entite->designationEntite }}
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" 
                                                    class="btn btn-sm btn-outline-primary rounded-0 px-2 py-1 small fw-semibold" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editEntiteModal"
                                                    data-id="{{ $entite->id }}"
                                                    data-designation="{{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}"
                                                    title="Modifier">
                                                <i class="bi bi-pencil-square"></i> 
                                            </button>

                                                <form action="{{ route('Entite.destroy', $entite->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entité ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-0" title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-light py-5 bg-light">
                                            <i class="bi bi-folder-x display-6 d-block mb-3 text-light-50"></i>
                                            <span class="fs-6">Aucune entité enregistrée pour le moment.</span>
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
@include('Entite.edit_modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editEntiteModal = document.getElementById('editEntiteModal');
    
    if (editEntiteModal) {
        editEntiteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton cliqué
            
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');

            // On redéfinit la route de soumission vers l'ID de la bonne entité
            const form = document.getElementById('editEntiteForm');
            form.setAttribute('action', `/Entite/${id}`); // Ajuste le préfixe selon ton web.php

            // Remplissage automatique de l'input
            document.getElementById('edit_designationEntite').value = designation;
        });
    }
});
</script>
@endsection
@extends('layouts.main')
@section('titre', 'RegiApp || Gestion des Directions')
@section('content')

<!-- Google Fonts & Icons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid bg-light min-vh-100" style="font-family: 'Inter', sans-serif;">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 p-0 border-end bg-dark">
            @include('layouts.nav_box')
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 col-lg-10 py-4 px-4">
            
            <!-- En-tête de page -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h5 class="fw-bold text-dark m-0">
                        <i class="bi bi-buildings text-primary me-2"></i>Gestion des Directions
                    </h5>
                    <small class="text-muted">Configuration de la structure managériale de la REGIDESO S.A.</small>
                </div>
            </div>

            <div class="row g-4">
                <!-- Formulaire de Création -->
                <div class="col-xl-4">
                    <div class="card bg-white border border-secondary border-opacity-10 shadow-sm rounded-3 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 me-2.5 d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                                <i class="bi bi-plus-circle-fill"></i>
                            </div>
                            <h6 class="text-uppercase fw-bold m-0 small tracking-wide text-secondary">
                                Nouvelle Direction
                            </h6>
                        </div>

                        <form action="{{ route('Direction.store') }}" method="POST" class="m-0">
                            @csrf
                            <!-- Nom de la Direction -->
                            <div class="mb-3">
                                <label for="designationDirection" class="form-label text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">
                                    Nom / Désignation
                                </label>
                                <input type="text" 
                                       name="designationDirection" 
                                       id="designationDirection" 
                                       class="form-control border-secondary border-opacity-25 py-2 rounded-2 small text-dark" 
                                       placeholder="Ex: Direction Générale, DRK-EST" 
                                       required>
                            </div>

                            <!-- Code / Sigle -->
                            <div class="mb-3">
                                <label for="codeDirection" class="form-label text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">
                                    Code / Sigle
                                </label>
                                <input type="text" 
                                       name="codeDirection" 
                                       id="codeDirection" 
                                       class="form-control border-secondary border-opacity-25 py-2 rounded-2 small text-dark" 
                                       placeholder="Ex: DG, DRKE" 
                                       required>
                            </div>

                            <!-- Directeur / Responsable -->
                            <div class="mb-4">
                                <label for="nomDirecteur" class="form-label text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">
                                    Nom du Directeur
                                </label>
                                <input type="text" 
                                       name="nomDirecteur" 
                                       id="nomDirecteur" 
                                       class="form-control border-secondary border-opacity-25 py-2 rounded-2 small text-dark" 
                                       placeholder="Ex: Antoine Mukendi" 
                                       required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 border-0 shadow-sm fw-semibold rounded-2 small">
                                <i class="bi bi-check2 me-1"></i> Enregistrer la direction
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tableau Liste des Directions -->
                <div class="col-xl-8">
                    <div class="card bg-white border border-secondary border-opacity-10 shadow-sm rounded-3 p-0 overflow-hidden">
                        <div class="px-4 py-3 bg-light border-bottom d-flex align-items-center justify-content-between">
                            <h6 class="text-uppercase text-secondary fw-bold m-0 small font-monospace">
                                Liste des Directions Répertoriées (<span class="text-primary">{{ count($directions ?? []) }}</span>)
                            </h6>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle m-0">
                                <thead>
                                    <tr class="table-light text-secondary border-bottom border-secondary border-opacity-10" style="font-size: 11px;">
                                        <th scope="col" class="py-3 ps-4 text-center" style="width: 60px;">N°</th>
                                        <th scope="col" class="py-3">Direction & Code</th>
                                        <th scope="col" class="py-3">Directeur Responsable</th>
                                        <th scope="col" class="py-3 pe-4 text-end" style="width: 140px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark" style="font-size: 13px;">
                                    @forelse($directions ?? [] as $index => $direction)
                                        <tr class="border-bottom border-secondary border-opacity-10">
                                            <td class="py-3 ps-4 text-center text-secondary font-monospace small">
                                                {{ sprintf('%02d', $index + 1) }}
                                            </td>
                                            <td class="py-3 fw-semibold">
                                                <div class="text-dark">{{ $direction->designationDirection }}</div>
                                                <span class="badge bg-dark bg-opacity-10 text-dark font-monospace rounded-1 mt-1" style="font-size: 10px;">
                                                    Code : {{ $direction->codeDirection }}
                                                </span>
                                            </td>
                                            <td class="py-3 text-secondary">
                                                <div class="fw-medium text-dark"><i class="bi bi-person me-1.5 text-muted"></i>{{ $direction->nomDirecteur }}</div>
                                            </td>
                                            <td class="py-3 pe-4 text-end">
                                                <div class="d-inline-flex gap-1">
                                                    <!-- Bouton Modifier (Déclenche le Modal) -->
                                                    <button type="button" 
                                                            class="btn btn-outline-primary btn-sm border-0 rounded-2 px-2.5 bg-light" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editDirectionModal"
                                                            data-id="{{ $direction->id }}"
                                                            data-designation="{{ $direction->designationDirection }}"
                                                            data-code="{{ $direction->codeDirection }}"
                                                            data-directeur="{{ $direction->nomDirecteur }}"
                                                            title="Modifier">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>

                                                    <!-- Bouton Supprimer (Formulaire destructif) -->
                                                    <form action="{{ route('Direction.destroy', $direction->id) }}" method="POST" class="m-0 d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer la direction {{ $direction->codeDirection }} ? Cette action est irréversible.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-outline-danger btn-sm border-0 rounded-2 px-2.5 bg-light" 
                                                                title="Supprimer">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted opacity-70">
                                                <i class="bi bi-buildings display-6 d-block mb-3 opacity-25"></i>
                                                <span>Aucune direction configurée dans l'infrastructure.</span>
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
</div>

<!-- Inclusion du Modal d'Édition -->
<div class="modal fade" id="editDirectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDirectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3 bg-white" style="font-family: 'Inter', sans-serif;">
            
            <!-- En-tête -->
            <div class="modal-header border-bottom border-secondary border-opacity-10 py-3 px-4 bg-white rounded-top-3">
                <h5 class="modal-title h6 fw-bold text-uppercase m-0 text-dark" id="editDirectionModalLabel" style="letter-spacing: 0.5px;">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Modifier la Direction
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Formulaire Dynamique -->
            <form id="editDirectionForm" method="POST" class="m-0">
                @csrf
                @method('PUT')

                <div class="modal-body p-4 bg-white">
                    <div class="row g-3">
                        <!-- Désignation -->
                        <div class="col-12">
                            <label for="edit_designationDirection" class="form-label text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">
                                Désignation de la direction
                            </label>
                            <input type="text" 
                                   name="designationDirection" 
                                   id="edit_designationDirection" 
                                   class="form-control border-secondary border-opacity-25 py-2 rounded-2 small text-dark" 
                                   required>
                        </div>

                        <!-- Code / Sigle -->
                        <div class="col-12">
                            <label for="edit_codeDirection" class="form-label text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">
                                Code / Sigle
                            </label>
                            <input type="text" 
                                   name="codeDirection" 
                                   id="edit_codeDirection" 
                                   class="form-control border-secondary border-opacity-25 py-2 rounded-2 small text-dark" 
                                   required>
                        </div>

                        <!-- Nom du Directeur -->
                        <div class="col-12">
                            <label for="edit_nomDirecteur" class="form-label text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.725rem; letter-spacing: 0.5px;">
                                Nom du directeur responsable
                            </label>
                            <input type="text" 
                                   name="nomDirecteur" 
                                   id="edit_nomDirecteur" 
                                   class="form-control border-secondary border-opacity-25 py-2 rounded-2 small text-dark" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Pied de page -->
                <div class="modal-footer border-top border-secondary border-opacity-10 p-3 px-4 bg-light rounded-bottom-3">
                    <button type="button" class="btn btn-outline-secondary border-0 text-muted fw-medium px-4 py-2 small" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary text-white px-4 py-2 border-0 shadow-sm fw-semibold rounded-2 small">
                        Mettre à jour
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Script JS d'injection des données dans le modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editDirectionModal');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function (event) {
                // Bouton qui a déclenché le modal
                const button = event.relatedTarget;
                
                // Extraction des attributs data-*
                const id = button.getAttribute('data-id');
                const designation = button.getAttribute('data-designation');
                const code = button.getAttribute('data-code');
                const directeur = button.getAttribute('data-directeur');
                
                // Injection dans les champs du formulaire
                document.getElementById('edit_designationDirection').value = designation;
                document.getElementById('edit_codeDirection').value = code;
                document.getElementById('edit_nomDirecteur').value = directeur;
                
                // Mise à jour de l'action du formulaire dynamiquement
                const form = document.getElementById('editDirectionForm');
                form.action = `/Direction/${id}`; // Ajustez l'URL selon votre ressource de route
            });
        }
    });
</script>

@endsection
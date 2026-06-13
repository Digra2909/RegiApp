@extends('layouts.main')
@section('titre', 'Gestion des Entités')
@section('content')

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
    .form-control-custom {
        border-radius: 8px 0 0 8px !important;
        border: 1px solid #cbd5e1;
        padding: 0.6rem 0.8rem;
        font-size: 0.875rem;
        background-color: #ffffff;
        color: #0f172a;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-custom:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        outline: none;
    }
    .input-group-text-custom {
        border-radius: 8px 0 0 8px !important;
        border: 1px solid #cbd5e1;
        border-end-0: none;
        background-color: #ffffff;
    }
    .btn-submit-custom {
        border-radius: 0 8px 8px 0 !important;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
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
</style>

<div class="container-fluid dashboard-wrapper min-vh-100 p-0">
    <div class="row g-0">
        <div class="col-md-3 col-lg-2 p-0 menu-sidebar border-end" style="background: #0f172a;">
            @include('layouts.nav_box')
        </div>

        <div class="col-md-9 col-lg-10 d-flex flex-column min-vh-100 px-4 py-4">
            
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center pb-3 mb-4 border-bottom" style="border-color: #e2e8f0 !important;">
                <div class="mb-3 mb-lg-0">
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.4px;">Gestion des Entités</h3>
                    <p class="text-muted small mb-0">Visualisez et configurez les structures organisationnelles de la REGIDESO S.A.</p>
                </div>

                <div class="w-100" style="max-width: 420px;">
                    <form action="{{ route('Entite.store') }}" method="POST" class="m-0">
                        @csrf
                        <div class="input-group shadow-sm">
                            <span class="input-group-text input-group-text-custom text-muted px-3">
                                <i class="bi bi-folder-plus text-primary fs-5"></i>
                            </span>
                            <input type="text" 
                                   name="designation" 
                                   id="designation" 
                                   class="form-control form-control-custom @error('designation') is-invalid @enderror" 
                                   placeholder="Nouvelle entité (ex: Direction...)" 
                                   required>
                            <button class="btn btn-info text-white btn-submit-custom px-4 border-0" type="submit">
                                AJOUTER
                            </button>
                        </div>
                        @error('designation')
                            <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4 p-3 shadow-sm d-flex align-items-center" role="alert" style="background-color: #f0fdf4; color: #166534;">
                    <i class="bi bi-check2-all me-2.5 fs-5"></i>
                    <div class="fw-medium small">{{ session('success') }}</div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="padding: 1.25rem; font-size: 0.75rem;"></button>
                </div>
            @endif

            <div class="w-100">
                <div class="d-flex align-items-center mb-3">
                    <h6 class="text-uppercase tracking-wider text-secondary small fw-bold d-flex align-items-center m-0" style="font-size: 11px; letter-spacing: 0.5px;">
                        <span class="text-primary me-2">■</span> Structures Enregistrées ({{ count($entites) }})
                    </h6>
                </div>

                <div class="table-responsive border rounded-3 shadow-sm custom-card overflow-hidden">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="table-light text-secondary border-bottom fw-semibold" style="font-size: 11px; background-color: #f8fafc; border-color: #e2e8f0 !important;">
                                <th scope="col" style="width: 80%;" class="py-3 ps-4 text-secondary text-uppercase border-0">Désignation de l'entité</th>
                                <th scope="col" style="width: 20%;" class="py-3 text-end pe-4 text-secondary text-uppercase border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px; color: #334155;">
                            @forelse($entites as $entite)
                                <tr class="border-bottom" style="border-color: #f1f5f9;">
                                    <td class="text-dark fw-semibold py-3 ps-4 border-0">
                                        {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                    </td>
                                    <td class="text-end pe-4 py-3 border-0">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-primary action-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editEntiteModal"
                                                    data-id="{{ $entite->id }}"
                                                    data-designation="{{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}"
                                                    title="Modifier">
                                                <i class="bi bi-pencil-square"></i> 
                                            </button>

                                            <form action="{{ route('Entite.destroy', $entite->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entité ?');">
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
                                    <td colspan="2" class="text-center text-muted py-5 border-0">
                                        <i class="bi bi-diagram-3 display-6 d-block mb-3 opacity-25"></i>
                                        <span class="d-block opacity-75 small text-uppercase tracking-wider fw-semibold" style="font-size: 11px;">Aucune entité enregistrée pour le moment.</span>
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
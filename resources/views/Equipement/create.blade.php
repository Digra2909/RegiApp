@extends('layouts.main')
@section('titre', 'Gestion des Équipements')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Intégration de la charte graphique moderne */
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
    .form-label-custom {
        font-size: 0.725rem !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #64748b;
    }
    .form-control-custom, .form-select-custom {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1;
        padding: 0.55rem 0.75rem;
        font-size: 0.875rem;
        background-color: #ffffff;
        color: #0f172a;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        color: #0f172a;
    }
    .btn-submit-custom {
        border-radius: 8px !important;
        font-weight: 600;
        font-size: 0.875rem;
        height: 41px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
    }
    .btn-submit-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(14, 116, 144, 0.2);
    }
</style>

<div class="container-fluid dashboard-wrapper min-vh-100 p-0">
    <div class="row g-0">
        <div class="col-md-3 col-lg-2 p-0 menu-sidebar border-end" style="background: #0f172a;">
            @include('layouts.nav_box')
        </div>

        <div class="col-md-9 col-lg-10 d-flex flex-column min-vh-100 px-4 py-4">
            
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.4px;">Gestion des Équipements</h3>
                <p class="text-muted small mb-0">Ajoutez un nouvel équipement au système et affectez-le à son poste de travail dédié.</p>
            </div>

            <div class="card custom-card p-4 mb-4">
                <form action="{{ route('Equipement.store') }}" method="POST" class="m-0 w-100">
                    @csrf
                    
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="designationEquipement" class="form-label form-label-custom mb-1">Désignation de l'équipement</label>
                            <input type="text" 
                                   name="designationEquipement" 
                                   id="designationEquipement" 
                                   class="form-control form-control-custom @error('designationEquipement') is-invalid @enderror" 
                                   placeholder="Ex: HP EliteBook i9" 
                                   value="{{ old('designationEquipement') }}"
                                   required>
                            @error('designationEquipement')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="NserieEquipement" class="form-label form-label-custom mb-1">Numéro de série</label>
                            <input type="text" 
                                   name="NserieEquipement" 
                                   id="NserieEquipement" 
                                   class="form-control form-control-custom @error('NserieEquipement') is-invalid @enderror" 
                                   placeholder="Ex: SN-987654321X" 
                                   value="{{ old('NserieEquipement') }}"
                                   required>
                            @error('NserieEquipement')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="nImmoEquipement" class="form-label form-label-custom mb-1">N° Immatriculation</label>
                            <input type="text" 
                                   name="nImmoEquipement" 
                                   id="nImmoEquipement" 
                                   class="form-control form-control-custom @error('nImmoEquipement') is-invalid @enderror" 
                                   placeholder="Ex: 4336-2026-004" 
                                   value="{{ old('nImmoEquipement') }}"
                                   required>
                            @error('nImmoEquipement')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="dateAcc" class="form-label form-label-custom mb-1">Date d'acquisition</label>
                            <input type="date" 
                                   name="dateAcc" 
                                   id="dateAcc" 
                                   class="form-control form-control-custom @error('dateAcc') is-invalid @enderror" 
                                   value="{{ old('dateAcc') }}"
                                   required>
                            @error('dateAcc')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="Observation" class="form-label form-label-custom mb-1">État / Observation</label>
                            <select name="Observation" id="Observation" class="form-select form-select-custom @error('Observation') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir un état...</option>
                                <option value="Bon état" {{ old('Observation') == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                                <option value="Hors service" {{ old('Observation') == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                                <option value="En maintenance" {{ old('Observation') == 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
                                <option value="Déclassé" {{ old('Observation') == 'Déclassé' ? 'selected' : '' }}>Déclassé</option>
                            </select>
                            @error('Observation')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="poste_id" class="form-label form-label-custom mb-1">Rattaché au poste</label>
                            <select name="poste_id" id="poste_id" class="form-select form-select-custom @error('poste_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir le poste...</option>
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}" {{ old('poste_id') == $poste->id ? 'selected' : '' }}>
                                        {{ $poste->designationPoste }}
                                    </option>
                                @endforeach
                            </select>
                            @error('poste_id')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="autreSpecTech" class="form-label form-label-custom mb-1">Spécifications (Opt.)</label>
                            <input type="text" 
                                   name="autreSpecTech" 
                                   id="autreSpecTech" 
                                   class="form-control form-control-custom @error('autreSpecTech') is-invalid @enderror" 
                                   placeholder="Ex: i9, 32GB, SSD 1TB" 
                                   value="{{ old('autreSpecTech') }}">
                            @error('autreSpecTech')
                                <div class="invalid-feedback d-block small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-info text-white btn-submit-custom w-100 border-0 shadow-sm">
                                <i class="bi bi-plus-lg fs-5"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-100 card custom-card p-0 overflow-hidden">
                <livewire:equipement-table />
            </div>

        </div>
    </div>
</div>

@include('Equipement.edit') 
@endsection 

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editEquipementModal');
    
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');
            const serie = button.getAttribute('data-serie');
            const immo = button.getAttribute('data-immo');
            const date = button.getAttribute('data-date');
            const observation = button.getAttribute('data-observation');
            const poste = button.getAttribute('data-poste');
            const spectech = button.getAttribute('data-spectech');

            const form = document.getElementById('editEquipementForm');
            form.setAttribute('action', `/Equipement/${id}`); 

            document.getElementById('edit_designationEquipement').value = designation;
            document.getElementById('edit_NserieEquipement').value = serie;
            document.getElementById('edit_nImmoEquipement').value = immo;
            document.getElementById('edit_dateAcc').value = date;
            document.getElementById('edit_Observation').value = observation;
            document.getElementById('edit_poste_id').value = poste;
            document.getElementById('edit_autreSpecTech').value = spectech;
        });
    }
});
</script>
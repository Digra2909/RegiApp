@extends('layouts.main')
@section('titre', 'Gestion des Équipements')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid bg-white text-dark min-vh-100 p-0">
    <div class="row g-0">
        <div class="col-md-2">
            @include('layouts.nav_box')
        </div>

        <div class="col-md-10 d-flex flex-column min-vh-100 px-5 py-4 bg-white">
            
            <div class="d-flex flex-column pb-4 mb-5 border-bottom border-light-subtle">
                <div class="mb-4">
                    <h2 class="h3 text-dark fw-bold mb-1" style="letter-spacing: -0.5px;">Gestion des Équipements</h2>
                    <p class="text-muted small mb-0">Ajoutez un nouvel équipement au système et affectez-le à son poste de travail.</p>
                </div>

                <form action="{{ route('Equipement.store') }}" method="POST" class="m-0 w-100">
                    @csrf
                    
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="designationEquipement" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Désignation de l'équipement</label>
                            <input type="text" 
                                   name="designationEquipement" 
                                   id="designationEquipement" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2" 
                                   placeholder="Ex: Hp elite book i9" 
                                   value="{{ old('designationEquipement') }}"
                                   required
                                   style="font-size: 0.9rem;">
                            @error('designationEquipement')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="NserieEquipement" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Numéro de série</label>
                            <input type="text" 
                                   name="NserieEquipement" 
                                   id="NserieEquipement" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2" 
                                   placeholder="Ex: SN-987654321X" 
                                   value="{{ old('NserieEquipement') }}"
                                   required
                                   style="font-size: 0.9rem;">
                            @error('NserieEquipement')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="nImmoEquipement" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">N° Immatriculation</label>
                            <input type="text" 
                                   name="nImmoEquipement" 
                                   id="nImmoEquipement" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2" 
                                   placeholder="Ex: 4336-2026-004" 
                                   value="{{ old('nImmoEquipement') }}"
                                   required
                                   style="font-size: 0.9rem;">
                            @error('nImmoEquipement')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="dateAcc" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Date d'acquisition</label>
                            <input type="date" 
                                   name="dateAcc" 
                                   id="dateAcc" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2" 
                                   value="{{ old('dateAcc') }}"
                                   required
                                   style="font-size: 0.9rem;">
                            @error('dateAcc')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="Observation" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">État / Observation</label>
                            <select name="Observation" id="Observation" class="form-select bg-light text-dark border-secondary-subtle rounded-0 py-2" required style="font-size: 0.9rem;">
                                <option value="" selected disabled>Choisir un état...</option>
                                <option value="Bon état" {{ old('Observation') == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                                <option value="Hors service" {{ old('Observation') == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                            </select>
                            @error('Observation')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="poste_id" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Rattaché au poste</label>
                            <select name="poste_id" id="poste_id" class="form-select bg-light text-dark border-secondary-subtle rounded-0 py-2" required style="font-size: 0.9rem;">
                                <option value="" selected disabled>Choisir le poste...</option>
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}" {{ old('poste_id') == $poste->id ? 'selected' : '' }}>
                                        {{ $poste->designationPoste }}
                                    </option>
                                @endforeach
                            </select>
                            @error('poste_id')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="autreSpecTech" class="form-label text-muted fw-bold small mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Spécifications (Opt.)</label>
                            <input type="text" 
                                   name="autreSpecTech" 
                                   id="autreSpecTech" 
                                   class="form-control bg-light text-dark border-secondary-subtle rounded-0 py-2" 
                                   placeholder="Ex: i9, 32GB" 
                                   value="{{ old('autreSpecTech') }}"
                                   style="font-size: 0.9rem;">
                            @error('autreSpecTech')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-info text-white rounded-0 fw-bold w-100 py-2 border-0 shadow-sm" style="font-size: 0.85rem; letter-spacing: 0.5px; height: 38px;">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-100 table-responsive-wrapper">
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
@extends('layouts.main')
@section('titre', 'Gestion des Équipements')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 p-0">
            @include('layouts.nav_box')
        </div>

        <div class="col-md-9 col-lg-10 my-5 px-4">
            <div class="card border border-light-subtle shadow-sm rounded-0 bg-white p-4">
                
                <div class="pb-4 mb-4 border-bottom border-light-subtle">
                    <div class="mb-4">
                        <h2 class="h4 text-primary fw-bold mb-1">Enregistrer un équipement</h2>
                        <small class="text-muted d-block">Ajoutez un nouvel équipement au système et affectez-le à son poste de travail.</small>
                    </div>
                    
                    <div class="w-100">
                        <form action="{{ route('Equipement.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="designationEquipement" class="form-label text-dark fw-semibold small mb-1">Désignation de l'équipement</label>
                                    <input type="text" 
                                           name="designationEquipement" 
                                           id="designationEquipement" 
                                           class="form-control rounded-0 @error('designationEquipement') is-invalid @enderror" 
                                           placeholder="Ex: Hp elite book i9" 
                                           value="{{ old('designationEquipement') }}"
                                           required>
                                    @error('designationEquipement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="NserieEquipement" class="form-label text-dark fw-semibold small mb-1">Numéro de série</label>
                                    <input type="text" 
                                           name="NserieEquipement" 
                                           id="NserieEquipement" 
                                           class="form-control rounded-0 @error('NserieEquipement') is-invalid @enderror" 
                                           placeholder="Ex: SN-987654321X" 
                                           value="{{ old('NserieEquipement') }}"
                                           required>
                                    @error('NserieEquipement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nImmoEquipement" class="form-label text-dark fw-semibold small mb-1">N° Immatriculation / Immo</label>
                                    <input type="text" 
                                           name="nImmoEquipement" 
                                           id="nImmoEquipement" 
                                           class="form-control rounded-0 @error('nImmoEquipement') is-invalid @enderror" 
                                           placeholder="Ex: 4336-2026-004" 
                                           value="{{ old('nImmoEquipement') }}"
                                           required>
                                    @error('nImmoEquipement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="dateAcc" class="form-label text-dark fw-semibold small mb-1">Date d'acquisition</label>
                                    <input type="date" 
                                           name="dateAcc" 
                                           id="dateAcc" 
                                           class="form-control rounded-0 @error('dateAcc') is-invalid @enderror" 
                                           value="{{ old('dateAcc') }}"
                                           required>
                                    @error('dateAcc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Observation" class="form-label text-dark fw-semibold small mb-1">État / Observation</label>
                                    <select name="Observation" id="Observation" class="form-select rounded-0 @error('Observation') is-invalid @enderror" required>
                                        <option value="" selected disabled>Choisir un état...</option>
                                        <option value="Bon état" {{ old('Observation') == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                                        <option value="Hors service" {{ old('Observation') == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                                    </select>
                                    @error('Observation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="poste_id" class="form-label text-dark fw-semibold small mb-1">Rattaché au poste de travail</label>
                                    <select name="poste_id" id="poste_id" class="form-select rounded-0 @error('poste_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>Choisir le poste...</option>
                                        @foreach($postes as $poste)
                                            <option value="{{ $poste->id }}" {{ old('poste_id') == $poste->id ? 'selected' : '' }}>
                                                {{ $poste->designationPoste }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('poste_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="autreSpecTech" class="form-label text-dark fw-semibold small mb-1">Autres spécifications techniques (Optionnel)</label>
                                <input type="text" 
                                       name="autreSpecTech" 
                                       id="autreSpecTech" 
                                       class="form-control rounded-0 @error('autreSpecTech') is-invalid @enderror" 
                                       placeholder="Ex: 12 couers, 2ghz,..." 
                                       value="{{ old('autreSpecTech') }}">
                                @error('autreSpecTech')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('Equipement.create') }}" class="btn btn-outline-secondary rounded-0 fw-semibold px-4">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-primary rounded-0 fw-semibold px-4 shadow-sm">
                                    Enregistrer l'équipement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <livewire:equipement-table />

            </div>
        </div>
    </div>
</div>
@include('Equipement.edit') 
@endsection 

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Intercepter l'ouverture du modal via les boutons du tableau
    const editModal = document.getElementById('editEquipementModal');
    
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Le bouton cliqué
            
            // Extraction des données contenues dans les attributs data-*
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');
            const serie = button.getAttribute('data-serie');
            const immo = button.getAttribute('data-immo');
            const date = button.getAttribute('data-date');
            const observation = button.getAttribute('data-observation');
            const poste = button.getAttribute('data-poste');
            const spectech = button.getAttribute('data-spectech');

            // Mise à jour de l'action du formulaire (URL dynamique)
            const form = document.getElementById('editEquipementForm');
            form.setAttribute('action', `/Equipement/${id}`); // Ajuste l'URL selon tes routes

            // Remplissage des champs du formulaire
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
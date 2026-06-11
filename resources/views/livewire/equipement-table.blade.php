<div>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-3">
        <h5 class="text-uppercase tracking-wider text-secondary small fw-bold d-flex align-items-center m-0">
            <span class="text-primary me-2">■</span> Liste des équipements
        </h5>

        <div class="d-flex gap-2 xml-w-auto w-100" style="max-width: 550px;">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-dark text-white-50 border-secondary rounded-0"><i class="bi bi-card-text"></i></span>
                <input type="text" 
                       wire:model.live.debounce.300ms="searchImmatriculation" 
                       class="form-control border-secondary rounded-0 small" 
                       placeholder="N° Immatriculation...">
            </div>

            <div class="input-group input-group-sm">
                <span class="input-group-text bg-dark text-white-50 border-secondary rounded-0"><i class="bi bi-diagram-3"></i></span>
                <select wire:model.live="filterEntite" class="form-select border-secondary rounded-0 small">
                    <option value="">Toutes les entités</option>
                    @foreach($entites as $entite)
                        <option value="{{ $entite->id }}">
                            {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
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
                    <th scope="col" class="py-3 ps-4" style="width: 60px;">N°</th>
                    <th scope="col" class="py-3">Équipement</th>
                    <th scope="col" class="py-3">N° Immatriculation</th>
                    <th scope="col" class="py-3">Poste Affecté</th>
                    <th scope="col" class="py-3">État</th>
                    <th scope="col" class="py-3 pe-4 text-end" style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipements as $index => $equipement)
                    <tr class="border-bottom border-secondary border-opacity-25" wire:key="equip-{{ $equipement->id }}">
                        <td class="py-3 ps-4 text-light small">
                            {{ sprintf('%02d', $index + 1) }}
                        </td>
                        <td class="py-3 fw-bold text-white">
                            {{ $equipement->designationEquipement }}
                            <span class="d-block text-white-50 fw-normal small"> {{ $equipement->NserieEquipement }}</span>
                        </td>
                        <td class="py-3 text-white-50 fw-mono small">
                            {{ $equipement->nImmoEquipement }}
                        </td>
                        <td class="py-3 text-info fw-semibold small">
                            {{ $equipement->poste->designationPoste ?? 'Aucun poste' }}
                        </td>
                        <td class="py-3 small">
                            @if(($equipement->Observation ?? '') == 'Bon état')
                                <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-0 px-2 py-1">Bon état</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 rounded-0 px-2 py-1">Hors service</span>
                            @endif
                        </td>
                        <td class="py-3 pe-4 text-end">
                            <div class="d-inline-flex gap-2 justify-content-end w-100">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary rounded-0 px-2 py-1 small fw-semibold" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editEquipementModal"
                                        data-id="{{ $equipement->id }}"
                                        data-designation="{{ $equipement->designationEquipement }}"
                                        data-serie="{{ $equipement->NserieEquipement }}"
                                        data-immo="{{ $equipement->nImmoEquipement }}"
                                        data-date="{{ $equipement->dateAcc }}"
                                        data-observation="{{ $equipement->Observation }}"
                                        data-poste="{{ $equipement->poste_id }}"
                                        data-spectech="{{ $equipement->autreSpecTech }}"
                                        title="Modifier">
                                    <i class="bi bi-pencil-square"></i> 
                                </button>
                                
                                <form action="{{ route('Equipement.destroy', $equipement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">
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
                        <td colspan="6" class="text-center py-5 text-white-50 bg-dark">
                            <i class="bi bi-folder-x display-6 d-block mb-3 opacity-50"></i>
                            <span class="d-block opacity-75 small text-uppercase tracking-wide">Aucun équipement ne correspond aux critères</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
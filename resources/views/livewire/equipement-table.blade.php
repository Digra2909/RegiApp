<div class="p-4" style="font-family: 'Inter', sans-serif; background-color: #ffffff;">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <h6 class="text-uppercase tracking-wider text-secondary small fw-bold d-flex align-items-center m-0" style="font-size: 11px; letter-spacing: 0.5px;">
            <span class="text-primary me-2">■</span> Liste des équipements
        </h6>

        <div class="d-flex gap-2 xml-w-auto w-100" style="max-width: 550px;">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-secondary border-end-0" style="border-radius: 8px 0 0 8px; border: 1px solid #cbd5e1;"><i class="bi bi-card-text"></i></span>
                <input type="text" 
                       wire:model.live.debounce.300ms="searchImmatriculation" 
                       class="form-control border-start-0" 
                       placeholder="N° Immatriculation..."
                       style="border-radius: 0 8px 8px 0 !important; border: 1px solid #cbd5e1; font-size: 0.85rem;">
            </div>

            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-secondary border-end-0" style="border-radius: 8px 0 0 8px; border: 1px solid #cbd5e1;"><i class="bi bi-buildings"></i></span>
                <select wire:model.live="filterEntite" class="form-select border-start-0" style="border-radius: 0 8px 8px 0 !important; border: 1px solid #cbd5e1; font-size: 0.85rem; padding: 0.4rem 0.75rem;">
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
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-3 p-3 shadow-sm d-flex align-items-center" role="alert" style="background-color: #f0fdf4; color: #166534;">
            <i class="bi bi-check-circle-fill me-2.5 fs-5"></i>
            <div class="fw-medium small">{{ session('success') }}</div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="padding: 1.25rem; font-size: 0.75rem;"></button>
        </div>
    @endif
    
    <div class="table-responsive border rounded-3 shadow-sm" style="border: 1px solid #e2e8f0 !important;">
        <table class="table table-hover align-middle m-0">
            <thead>
                <tr class="table-light text-secondary border-bottom fw-semibold" style="font-size: 11px; background-color: #f8fafc;">
                    <th scope="col" class="py-3 ps-4 text-center text-muted" style="width: 60px;">N°</th>
                    <th scope="col" class="py-3">Équipement & S/N</th>
                    <th scope="col" class="py-3">Poste Affecté</th>
                    <th scope="col" class="py-3">N° Immatriculation</th>
                    <th scope="col" class="py-3">Spécificités Techniques</th>
                    <th scope="col" class="py-3">État</th>
                    <th scope="col" class="py-3 pe-4 text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px; color: #334155;">
                @forelse($equipements as $index => $equipement)
                    <tr class="border-bottom" style="border-color: #f1f5f9;" wire:key="equip-{{ $equipement->id }}">
                        <td class="py-3 ps-4 text-center font-monospace text-secondary small">
                            {{ sprintf('%02d', $index + 1) }}
                        </td>
                        <td class="py-3 fw-semibold text-dark">
                            <div>{{ $equipement->designationEquipement }}</div>
                            <span class="text-muted font-monospace d-block" style="font-size: 11px; font-weight: 400;">{{ $equipement->NserieEquipement }}</span>
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-slate-700">{{ $equipement->poste->designationPoste ?? 'Aucun poste' }}</span>
                        </td>
                        <td class="py-3 font-monospace text-secondary small">
                            {{ $equipement->nImmoEquipement }}
                        </td>
                        <td class="py-3 text-secondary text-wrap" style="max-width: 200px; line-height: 1.4;">
                            {{ $equipement->autreSpecTech ?? '-' }}
                        </td>
                        
                        <td class="py-3">
                            @if(($equipement->Observation ?? '') == 'Bon état')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 rounded-pill px-3 py-1" style="font-weight: 500; font-size: 11px;">Bon état</span>
                            @elseif(($equipement->Observation ?? '') == 'En maintenance')
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 rounded-pill px-3 py-1" style="font-weight: 500; font-size: 11px; color: #b45309 !important;">En maintenance</span>
                            @elseif(($equipement->Observation ?? '') == 'Déclassé')
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 rounded-pill px-3 py-1" style="font-weight: 500; font-size: 11px;">Déclassé</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 rounded-pill px-3 py-1" style="font-weight: 500; font-size: 11px;">Hors service</span>
                            @endif
                        </td>
                        <td class="py-3 pe-4 text-end">
                            <div class="d-inline-flex gap-1.5 justify-content-end w-100">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center" 
                                        style="border-radius: 6px; width: 30px; height: 30px; padding: 0;"
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
                                
                                <form action="{{ route('Equipement.destroy', $equipement->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet équipement ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" style="border-radius: 6px; width: 30px; height: 30px; padding: 0;" title="Supprimer">
                                        <i class="bi bi-trash3"></i> 
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-folder-x display-6 d-block mb-3 opacity-25"></i>
                            <span class="d-block opacity-75 small text-uppercase tracking-wider fw-semibold" style="font-size: 11px;">Aucun équipement ne correspond à vos critères</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
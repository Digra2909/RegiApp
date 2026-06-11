@extends('layouts.main')
@section('titre', 'RegiApp || Dashboard Analytique')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 p-0 menu-sidebar">
            @include('layouts.nav_box')
        </div>

        <div class="col-md-9 col-lg-10 my-5 px-4 zone-impression">
            
            <div class="titre-pdf-uniquement text-end w-100 mb-4">
                <strong>Tableau de Bord Analytique - RegiApp 2026</strong> | Date de génération : {{ date('d/m/Y H:i') }}
            </div>

            <div class="flex flex-col items-center text-center p-4 max-w-md mx-auto font-sans zone-header">
                <div class="mb-3">
                    <img src="{{ asset('logos/logoRegidesi.png') }}" 
                        alt="Logo REGIDESO S.A" 
                        class="h-5 w-auto object-contain">
                </div>

                <div class="uppercase tracking-wider">
                    <p class="text-xs font-semibold text-gray-700 mt-1 max-w-xs leading-normal normal-case italic">
                        Régie de distribution d'eau de la République Démocratique du Congo
                    </p>

                    <small class="h4 text-primary fw-bold mb-1">Tableau de Bord Analytique || Analyse croisée en temps réel des entités, postes de travail et équipements</small>

                    <p class="block text-sm font-bold text-blue-800 mt-2 border-t border-blue-900 pt-1 tracking-widest">
                        DRK-E
                    </p>
                </div>
            </div>

            <div class="texte-intro-pdf mb-4 text-justify">
                <p>Le présent document constitue le rapport analytique officiel issu de l'application RegiApp, détaillant l'état du parc des équipements et infrastructures de la REGIDESO S.A pour l'exercice en cours. Ce relevé automatisé compile les données d'analyse croisée collectées en temps réel au sein des différentes entités émettrices ainsi que des postes de travail opérationnels. L'objectif principal de cet inventaire est de fournir une visibilité claire sur la répartition technique des machines et de mettre en exergue leur statut de disponibilité. Les informations présentées ci-dessous permettent d'orienter les futures interventions de maintenance et de soutenir la planification stratégique de la Direction de l'Exploitation.</p>
            </div>

            <div class="card border border-light-subtle shadow-sm rounded-0 bg-white p-3 mb-4 zone-filtre">
                <form action="{{ route('Equipement.index') }}" method="GET" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-muted mb-1">Recherche par mot-clé</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-secondary border-opacity-50 rounded-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-secondary border-opacity-50 rounded-0" placeholder="Nom, N° Immo, Série...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Filtrer par Entité</label>
                        <select name="entite_id" class="form-select form-select-sm border-secondary border-opacity-50 rounded-0">
                            <option value="">Toutes les entités</option>
                            @foreach($entites as $entite)
                                <option value="{{ $entite->id }}" {{ request('entite_id') == $entite->id ? 'selected' : '' }}>
                                    {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Filtrer par État</label>
                        <select name="observation" class="form-select form-select-sm border-secondary border-opacity-50 rounded-0">
                            <option value="">Tous les états</option>
                            <option value="Bon état" {{ request('observation') == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                            <option value="Hors service" {{ request('observation') == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <a href="{{ route('Equipement.index') }}" class="btn btn-outline-secondary btn-sm rounded-0 fw-semibold w-100 py-2">
                            <i class="bi bi-trash me-1"></i>Effacer
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 fw-semibold w-100 py-2">
                            <i class="bi bi-filter me-1"></i> Filtrer
                        </button>
                        <button type="button" onclick="exporterPDF()" class="btn btn-success btn-sm rounded-0 fw-semibold w-100 py-2">
                            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                        </button>
                        <button type="button" onclick="exporterExcel()" class="btn btn-warning btn-sm rounded-0 fw-semibold w-100 py-2">
                            <i class="bi bi-file-earmark-excel me-1"></i> Excel
                        </button>
                    </div>
                </form>
            </div>

            <div class="row g-3 mb-4 section-kpi-row">
                <div class="col-md-6 col-xl-3">
                    <div class="card border border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase fw-bold font-monospace" style="font-size: 11px;">Équipements Filtrés</small>
                                <h3 class="fw-bold text-dark m-0 mt-1">{{ sprintf('%02d', $totalEquipements) }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 text-primary p-3 border border-primary border-opacity-10">
                                <i class="bi bi-cpu fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card border border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase fw-bold font-monospace" style="font-size: 11px;">Taux de Dispo.</small>
                                <h3 class="fw-bold text-success m-0 mt-1">{{ $tauxDispo }}%</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 text-success p-3 border border-success border-opacity-10">
                                <i class="bi bi-shield-check fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card border border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase fw-bold font-monospace" style="font-size: 11px;">Postes Impactés</small>
                                <h3 class="fw-bold text-dark m-0 mt-1">{{ sprintf('%02d', $totalPostes) }}</h3>
                            </div>
                            <div class="bg-info bg-opacity-10 text-info p-3 border border-info border-opacity-10">
                                <i class="bi bi-diagram-3 fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card border border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase fw-bold font-monospace" style="font-size: 11px;">Entités Impliquées</small>
                                <h3 class="fw-bold text-dark m-0 mt-1">{{ sprintf('%02d', $totalEntites) }}</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 text-warning p-3 border border-warning border-opacity-10">
                                <i class="bi bi-building fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4 block-chart">
                <div class="col-lg-8">
                    <div class="card border border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100">
                        <h6 class="fw-bold text-dark text-uppercase tracking-wider small mb-3"><i class="bi bi-bar-chart-steps text-primary me-2"></i> Équipements par Entité</h6>
                        <div class="position-relative size-impression-chart" style="height: 260px;">
                            <canvas id="entiteBarChart" 
                                    data-labels="{{ json_encode($barLabels) }}" 
                                    data-values="{{ json_encode($barValues) }}">
                            </canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100">
                        <h6 class="fw-bold text-dark text-uppercase tracking-wider small mb-3"><i class="bi bi-pie-chart text-primary me-2"></i> État du Parc (Sélectionné)</h6>
                        <div class="position-relative size-impression-chart d-flex align-items-center justify-content-center" style="height: 260px;">
                            <canvas id="statusDonutChart" 
                                    data-values="{{ json_encode($donutData) }}">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border border-light-subtle shadow-sm rounded-0 bg-white p-4 main-table-card">
                <h5 class="text-uppercase text-secondary small fw-bold mb-3 section-title-table">
                    <span class="text-primary me-2">■</span> Résultats de la recherche ({{ count($equipements) }})
                </h5>
                <div class="table-responsive border border-secondary border-opacity-50 rounded-0 wrap-table-print">
                    <table id="targetPrintTable" class="table table-dark table-striped table-hover align-middle m-0">
                        <thead>
                            <tr class="text-white-50 small fw-bold bg-dark printable-th">
                                <th scope="col" class="py-3 ps-3 col-print-num">N°</th>
                                <th scope="col" class="py-3 col-print-desig">Désignation</th>
                                <th scope="col" class="py-3 col-print-immo">N° Immatriculation</th>
                                <th scope="col" class="py-3 col-print-entite">Entité Émettrice</th>
                                <th scope="col" class="py-3 col-print-poste">Poste & Responsable</th>
                                <th scope="col" class="py-3 col-print-AutSpec">Autres spécificités</th>
                                <th scope="col" class="py-3 pe-3 text-center col-print-statut">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipements as $index => $item)
                                <tr class="border-bottom border-secondary border-opacity-25 printable-tr">
                                    <td class="py-2 ps-3 text-light small printable-td">{{ sprintf('%02d', $index + 1) }}</td>
                                    <td class="py-2 fw-bold text-white printable-td text-printable-black">
                                        {{ $item->designationEquipement }}
                                        <span class="d-block text-white-50 fw-normal small subtitle-printable">S/N: {{ $item->NserieEquipement }}</span>
                                    </td>
                                    <td class="py-2 text-white-50 fw-mono small printable-td subtitle-printable">{{ $item->nImmoEquipement }}</td>
                                    <td class="py-2 text-warning small fw-semibold printable-td highlight-orange">{{ $item->nom_entite ?? 'Aucune Entité' }}</td>
                                    <td class="py-2 text-info small fw-semibold printable-td highlight-blue">
                                        {{ $item->designationPoste ?? 'Aucun Poste' }}
                                        <span class="d-block text-white-50 fw-normal small subtitle-printable"><i class="bi bi-person me-1"></i>{{ $item->nomResponsble ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-2 text-light small printable-td text-printable-black text-wrap" style="max-width: 200px;">
                                        {{ $item->autreSpecTech ?? '-' }}
                                    </td>
                                    <td class="py-2 pe-3 text-center printable-td">
                                        @if($item->Observation == 'Bon état')
                                            <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-0 px-2 py-1 w-100 print-badge-green">Bon état</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 rounded-0 px-2 py-1 w-100 print-badge-red">Hors service</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-white-50 bg-dark printable-td">
                                        <i class="bi bi-clipboard-x display-6 d-block mb-2 opacity-50"></i>
                                        Aucune correspondance trouvée pour ces filtres.
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

<style>
.titre-pdf-uniquement, .texte-intro-pdf {
    display: none;
}

@media print {
    @page {
        size: landscape;
        margin: 5mm 5mm 5mm 5mm !important;
    }
    
    body {
        padding: 5mm 8mm !important;
        background-color: #ffffff !important;
    }

    .titre-pdf-uniquement {
        display: block !important;
        font-family: Arial, sans-serif;
        font-size: 10px;
        color: #555550;
    }

    .texte-intro-pdf {
        display: block !important;
        font-family: 'Times New Roman', Times, serif;
        font-size: 13px;
        line-height: 1.5;
        color: #333333;
        margin-top: 15px;
        margin-bottom: 20px;
        text-align: justify;
    }

    .menu-sidebar, form, .zone-filtre, .btn, .bi-search, .input-group-text, .section-kpi-row, .block-chart {
        display: none !important;
    }
    
    .zone-impression {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    #targetPrintTable {
        background-color: #ffffff !important;
        color: #000000 !important;
        font-size: 10.5px !important;
        width: 100% !important;
    }

    .col-print-num { width: 4% !important; }
    .col-print-desig { width: 22% !important; }
    .col-print-immo { width: 12% !important; white-space: nowrap !important; }
    .col-print-entite { width: 16% !important; }
    .col-print-poste { width: 18% !important; }
    .col-print-AutSpec { width: 18% !important; }
    .col-print-statut { width: 10% !important; white-space: nowrap !important; }

    .wrap-table-print, #targetPrintTable {
        border: 1px solid #bcbcbc !important;
    }

    #targetPrintTable th, #targetPrintTable td {
        padding: 6px 5px !important;
    }

    th.printable-th {
        background-color: #f1f1f1 !important;
        color: #000000 !important;
        font-weight: bold;
        border-bottom: 2px solid #000000 !important;
    }

    td.printable-td, .text-printable-black, .highlight-orange, .highlight-blue {
        color: #000000 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .subtitle-printable {
        color: #555555 !important;
        font-size: 9px !important;
    }

    .print-badge-green {
        background-color: #d1e7dd !important;
        color: #0f5132 !important;
        border: 1px solid #badbcc !important;
    }

    .print-badge-red {
        background-color: #f8d7da !important;
        color: #842029 !important;
        border: 1px solid #f5c2c7 !important;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="{{ asset('js/exportsVersExcel.js') }}"></script>

@endsection
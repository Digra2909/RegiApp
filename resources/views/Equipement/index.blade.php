@extends('layouts.main')
@section('titre', 'RegiApp || Dashboard Analytique')
@section('content')

<!-- Google Fonts & Icons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Global Dashboard Clean Overrides */
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
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .kpi-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
    .form-control, .form-select {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    .btn-custom {
        border-radius: 8px !important;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    /* Custom Scrollbar for inner tables */
    .table-responsive::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    /* Print Utility classes */
    .titre-pdf-uniquement, .texte-intro-pdf { display: none; }
    .sticky-top { position: sticky; top: 0; z-index: 2; }

    @media print {
        @page { size: landscape; margin: 8mm 10mm 10mm 10mm !important; }
        body { background-color: #ffffff !important; font-family: Arial, sans-serif !important; }
        .titre-pdf-uniquement, .texte-intro-pdf { display: block !important; }
        .menu-sidebar, form, .zone-filtre, .btn, .btn-custom, .section-kpi-row, .block-chart, .zone-amortissement-print, .doc-title-main { display: none !important; }
        .zone-impression { width: 100% !important; max-width: 100% !important; flex: 0 0 100% !important; margin: 0 !important; padding: 0 !important; }
        
        /* Correction de l'en-tête de direction au print pour éliminer l'espace vide */
        .zone-header { margin-bottom: 15px !important; padding: 0 !important; }
        .zone-header img { height: 45px !important; }
        
        #targetPrintTable { background-color: #ffffff !important; color: #111111 !important; font-size: 10px !important; width: 100% !important; border-collapse: collapse !important; border: 1px solid #cbd5e1 !important; margin-top: 10px !important;}
        th.printable-th { background-color: #0f172a !important; color: #ffffff !important; text-transform: uppercase; font-size: 9px !important; padding: 8px !important; }
        td.printable-td { color: #1e293b !important; border-bottom: 1px solid #e2e8f0 !important; padding: 8px !important; }
        .subtitle-printable { color: #64748b !important; font-size: 8px !important; }
        
        /* Suppression du saut de page forcé automatique qui créait le vide */
        .page-break-before { page-break-before: auto !important; }
        
        .print-badge-green { background-color: #f0fdf4 !important; color: #166534 !important; border: 1px solid #bbf7d0 !important; }
        .print-badge-red { background-color: #fef2f2 !important; color: #991b1b !important; border: 1px solid #fecaca !important; }
    }
</style>

<div class="container-fluid dashboard-wrapper">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 p-0 menu-sidebar border-end" style="background: #0f172a;">
            @include('layouts.nav_box')
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 col-lg-10 py-4 px-4 zone-impression">
            
            <!-- EXECUTIF PDF HEADER (VISIBLE UNIQUEMENT AU PRINT) -->
            <div class="titre-pdf-uniquement w-100 mb-3 border-bottom pb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-uppercase font-monospace text-muted tracking-wider" style="font-size: 10px; font-weight: 600;">
                        <i class="bi bi-shield-check text-primary me-1"></i> Document Officiel Sûreté Réseau - REGIDESO S.A
                    </span>
                    <span class="text-secondary" style="font-size: 10px;">
                        <strong>Généré par :</strong> {{ auth()->user()->name ?? 'Opérateur RegiApp' }} | 
                        <strong>Impression :</strong> {{ date('d/m/Y à H:i:s') }}
                    </span>
                </div>
            </div>

            <!-- LOGO ET ENTÊTE DE DIRECTION -->
            <div class="d-flex flex-column align-items-center text-center p-3 mx-auto zone-header mb-4" style="max-width: 500px;">
                <div class="mb-2">
                    <img src="{{ asset('logos/logoRegidesi.png') }}" alt="Logo REGIDESO S.A" class="img-fluid" style="height: 55px; object-fit: contain;">
                </div>
                <div class="text-uppercase tracking-wide">
                    <p class="text-muted font-monospace mb-1" style="font-size: 11px; max-width: 380px; line-height: 1.4; text-transform: none; font-style: italic;">
                        Régie de distribution d'eau de la République Démocratique du Congo
                    </p>
                    <div class="badge bg-dark px-3 py-1.5 rounded-pill font-monospace tracking-widest" style="font-size: 10px;">DRK-E</div>
                </div>
            </div>

            <!-- TEXTE INTRODUCTIF TECHNIQUE PDF -->
            <div class="texte-intro-pdf mb-3 text-justify p-3 border-start border-primary border-3 bg-light rounded-end">
                <p class="mb-0 text-secondary" style="font-size: 11px; line-height: 1.5;">
                    Le présent document constitue le rapport analytique officiel extrait automatiquement via l'application <strong>RegiApp</strong> pour l'exercice 2026. 
                    @if(request('search') || request('entite_id') || request('observation'))
                        Ce relevé spécifique a été généré sur base de critères de filtrage sélectifs : 
                        @if(request('search')) "Recherche par mot-clé : {{ request('search') }}" ; @endif
                        @if(request('entite_id') && $entiteSelectionnee = $entites->where('id', request('entite_id'))->first()) "Périmètre : {{ $entiteSelectionnee->designationEntite ?? $entiteSelectionnee->designation ?? $entiteSelectionnee->nom }}" ; @endif
                        @if(request('observation')) "Statut opérationnel : {{ request('observation') }}" @endif.
                    @else
                        Ce relevé consolidé compile l'intégralité des données d'analyse croisée collectées en temps réel au sein de toutes les entités émettrices.
                    @endif
                    L'objectif principal de cet inventaire émis par la Direction Générale est de fournir une visibilité rigoureuse sur la répartition des machines, d'évaluer le taux d'efficacité globale actuel (établi à <strong>{{ $tauxDispo }}%</strong>), et d'orienter stratégiquement les interventions de maintenance.
                </p>
            </div>

            <!-- STRUCTURE ANALYTIQUE HAUTE : AUDIT & STATS GLOBALES -->
            <div class="row g-3 mb-4 section-kpi-row">
                <!-- Amortis Global -->
                <div class="col-md-6">
                    <div class="card custom-card p-3 h-100 border-start border-danger border-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase tracking-wider fw-semibold font-monospace" style="font-size: 10px;">Équipements Amortis (≥ 5 ans)</small>
                                <h3 class="fw-bold text-danger m-0 mt-1 font-monospace">{{ sprintf('%02d', $totalAmortis) }}</h3>
                                <span class="text-slate-400 d-block mt-1" style="font-size: 11px;"><i class="bi bi-exclamation-triangle-fill me-1"></i>Cycle de vie technique obsolète</span>
                            </div>
                            <div class="kpi-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-hourglass-bottom fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bureau Top Outillé -->
                <div class="col-md-6">
                    <div class="card custom-card p-3 h-100 border-start border-primary border-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase tracking-wider fw-semibold font-monospace" style="font-size: 10px;">Bureau le Plus Outillé</small>
                                <h4 class="fw-bold text-primary m-0 mt-1 text-truncate" style="max-width: 280px; font-size: 1.15rem;">{{ $nomBureauPlusOutille }}</h4>
                                <span class="text-muted small d-block mt-1" style="font-size: 11px;">Volume total : <span class="badge bg-primary bg-opacity-10 text-primary font-monospace rounded-1">{{ sprintf('%02d', $maxOutils) }} outils</span></span>
                            </div>
                            <div class="kpi-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-building-gear fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REGISTRE DES AMORTISSEMENTS -->
            <div class="row g-3 mb-4 zone-amortissement-print">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-2 me-2.5 d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                                <i class="bi bi-shield-alert fs-6"></i>
                            </div>
                            <h6 class="text-uppercase font-monospace fw-bold m-0" style="font-size: 12px; letter-spacing: 0.3px;">
                                Registre d'Audit des Équipements Amortis (≥ 5 Ans)
                            </h6>
                        </div>
                        <div class="table-responsive border rounded-3" style="max-height: 240px; overflow-y: auto;">
                            <table class="table table-sm table-hover align-middle m-0 small">
                                <thead class="table-light sticky-top" style="background-color: #f8fafc;">
                                    <tr class="text-muted" style="font-size: 11px;">
                                        <th class="py-2 ps-3">N° Immo</th>
                                        <th class="py-2">Désignation</th>
                                        <th class="py-2">Acquisition</th>
                                        <th class="py-2 pe-3 text-center">Âge légal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($equipementsAmortis as $item)
                                        <tr>
                                            <td class="font-monospace fw-bold ps-3 text-danger" style="font-size:12px;">{{ $item->nImmoEquipement }}</td>
                                            <td class="fw-semibold text-dark">{{ $item->designationEquipement }}</td>
                                            <td class="text-secondary">{{ $item->dateAcc ? date('d/m/Y', strtotime($item->dateAcc)) : '-' }}</td>
                                            <td class="pe-3 text-center">
                                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-1 font-monospace" style="font-size: 10px; font-weight:600;">
                                                    {{ 2026 - date('Y', strtotime($item->dateAcc)) }} ans
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small"><i class="bi bi-check2-circle me-1 text-success"></i> Aucun équipement amorti à déplorer.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TITRE DYNAMIQUE DE SECTION PRINCIPALE -->
            <div class="d-flex align-items-center justify-content-between mb-2 mt-4 px-1 doc-title-main">
                <h5 class="fw-bold text-dark m-0" style="font-size: 1.1rem; letter-spacing: -0.3px;">
                    <i class="bi bi-layers-half text-primary me-2"></i>Rapport Analytique : 
                    @if(request('entite_id') && $entiteTitre = $entites->where('id', request('entite_id'))->first())
                        <span class="text-primary">Parc Équipements — {{ $entiteTitre->designationEntite ?? $entiteTitre->designation ?? $entiteTitre->nom }}</span>
                    @elseif(request('observation'))
                        <span class="text-primary">Inventaire Ciblé [{{ request('observation') }}]</span>
                    @else
                        <span class="text-secondary" style="font-weight: 500;">Analyse Croisée Globale du Parc</span>
                    @endif
                </h5>
            </div>

            <!-- LE FORMULAIRE DE FILTRAGE DESIGN FLUIDE -->
            <div class="card custom-card p-3 mb-4 zone-filtre bg-light bg-opacity-50">
                <form action="{{ route('Equipement.index') }}" method="GET" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-secondary mb-1">Recherche par mot-clé</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 8px 0 0 8px;"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Nom, Code Immo, S/N..." style="border-radius: 0 8px 8px 0 !important;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary mb-1">Filtrer par Entité</label>
                        <select name="entite_id" class="form-select form-select-sm">
                            <option value="">Toutes les entités émettrices</option>
                            @foreach($entites as $entite)
                                <option value="{{ $entite->id }}" {{ request('entite_id') == $entite->id ? 'selected' : '' }}>
                                    {{ $entite->designationEntite ?? $entite->designation ?? $entite->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary mb-1">Filtrer par État</label>
                        <select name="observation" class="form-select form-select-sm">
                            <option value="">Tous les états de service</option>
                            <option value="Bon état" {{ request('observation') == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                            <option value="Hors service" {{ request('observation') == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-1.5">
                        <a href="{{ route('Equipement.index') }}" class="btn btn-outline-secondary btn-custom btn-sm w-100" title="Effacer les filtres">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                        <button type="submit" class="btn btn-primary btn-custom btn-sm w-100">
                            <i class="bi bi-filter"></i> Filtrer
                        </button>
                        <button type="button" onclick="exporterPDF()" class="btn btn-danger btn-custom btn-sm" title="Exporter PDF">
                            <i class="bi bi-file-pdf"></i>
                        </button>
                        <button type="button" onclick="exporterExcel()" class="btn btn-success btn-custom btn-sm" title="Exporter Excel">
                            <i class="bi bi-file-excel"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- DYNAMIQUES D'AUDIT : MINI COCKPIT D'INDICATEURS FILTRÉS -->
            <div class="row g-3 mb-4 section-kpi-row">
                <div class="col-6 col-xl-3">
                    <div class="card custom-card p-3 h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase tracking-wider fw-semibold" style="font-size: 10px;">Équipements segmentés</small>
                                <h4 class="fw-bold text-dark m-0 mt-1 font-monospace">{{ sprintf('%02d', $totalEquipements) }}</h4>
                            </div>
                            <div class="kpi-icon bg-slate-100 text-slate-700">
                                <i class="bi bi-cpu fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-3">
                    <div class="card custom-card p-3 h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase tracking-wider fw-semibold" style="font-size: 10px;">Taux Disponibilité</small>
                                <h4 class="fw-bold text-success m-0 mt-1 font-monospace">{{ $tauxDispo }}%</h4>
                            </div>
                            <div class="kpi-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-patch-check fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-3">
                    <div class="card custom-card p-3 h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase tracking-wider fw-semibold" style="font-size: 10px;">Postes Impactés</small>
                                <h4 class="fw-bold text-dark m-0 mt-1 font-monospace">{{ sprintf('%02d', $totalPostes) }}</h4>
                            </div>
                            <div class="kpi-icon bg-indigo bg-opacity-10 text-indigo">
                                <i class="bi bi-display fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-3">
                    <div class="card custom-card p-3 h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted text-uppercase tracking-wider fw-semibold" style="font-size: 10px;">Entités Impliquées</small>
                                <h4 class="fw-bold text-dark m-0 mt-1 font-monospace">{{ sprintf('%02d', $totalEntites) }}</h4>
                            </div>
                            <div class="kpi-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-buildings fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DATA VISUALIZATION GRAPHES -->
            <div class="row g-3 mb-4 block-chart">
                <div class="col-lg-8">
                    <div class="card custom-card p-3 h-100">
                        <h6 class="fw-bold text-dark text-uppercase tracking-wider small mb-3" style="font-size:11px;"><i class="bi bi-bar-chart-steps text-primary me-2"></i> Équipements par Entité</h6>
                        <div class="position-relative size-impression-chart" style="height: 250px;">
                            <canvas id="entiteBarChart" 
                                    data-labels="{{ json_encode($barLabels) }}" 
                                    data-values="{{ json_encode($barValues) }}">
                            </canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card custom-card p-3 h-100">
                        <h6 class="fw-bold text-dark text-uppercase tracking-wider small mb-3" style="font-size:11px;"><i class="bi bi-pie-chart text-primary me-2"></i> État du Parc (Sélectionné)</h6>
                        <div class="position-relative size-impression-chart d-flex align-items-center justify-content-center" style="height: 250px;">
                            <canvas id="statusDonutChart" 
                                    data-values="{{ json_encode($donutData) }}">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLEAU GLOBAL PRO DES RÉSULTATS D'INVENTAIRE -->
            <div class="card custom-card p-0 overflow-hidden page-break-before">
                <div class="px-4 py-3 bg-light border-bottom d-flex align-items-center header-table-title">
                    <h6 class="text-uppercase text-secondary font-monospace fw-bold m-0" style="font-size: 11px; letter-spacing: 0.5px">
                        Résultats du Parc Global (<span class="text-primary font-monospace">{{ count($equipements) }}</span>)
                    </h6>
                </div>
                <div class="table-responsive wrap-table-print">
                    <table id="targetPrintTable" class="table table-hover align-middle m-0">
                        <thead>
                            <tr class="table-light text-secondary small fw-semibold border-bottom printable-th" style="font-size: 11px;">
                                <th scope="col" class="py-3 ps-4 text-center col-print-num" style="width: 50px;">N°</th>
                                <th scope="col" class="py-3 col-print-desig">Désignation & Code</th>
                                <th scope="col" class="py-3 col-print-immo">N° Immatriculation</th>
                                <th scope="col" class="py-3 col-print-entite">Entité Émettrice</th>
                                <th scope="col" class="py-3 col-print-poste">Poste & Responsable</th>
                                <th scope="col" class="py-3 col-print-AutSpec">Spécificités Techniques</th>
                                <th scope="col" class="py-3 pe-4 text-center col-print-statut" style="width: 140px;">Statut</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            @forelse($equipements as $index => $item)
                                <tr class="printable-tr">
                                    <td class="py-3 ps-4 text-center text-secondary font-monospace small printable-td">{{ sprintf('%02d', $index + 1) }}</td>
                                    <td class="py-3 fw-semibold text-dark printable-td">
                                        <div class="text-dark">{{ $item->designationEquipement }}</div>
                                        <span class="text-muted font-monospace subtitle-printable" style="font-size: 11px; font-weight: 400;">S/N: {{ $item->NserieEquipement }}</span>
                                    </td>
                                    <td class="py-3 text-secondary font-monospace small printable-td subtitle-printable">{{ $item->nImmoEquipement }}</td>
                                    <td class="py-3 printable-td">
                                        <span class="px-2.5 py-1 rounded bg-warning bg-opacity-10 small fw-semibold border border-warning border-opacity-10" style="color: #b45309;">
                                            {{ $item->nom_entite ?? 'Aucune Entité' }}
                                        </span>
                                    </td>
                                    <td class="py-3 printable-td">
                                        <div class="fw-medium text-slate-700">{{ $item->designationPoste ?? 'Aucun Poste' }}</div>
                                        <span class="text-muted subtitle-printable" style="font-size: 11px;"><i class="bi bi-person me-1"></i>{{ $item->nomResponsble ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-3 text-secondary printable-td text-wrap small" style="max-width: 220px; line-height: 1.4;">
                                        {{ $item->autreSpecTech ?? '-' }}
                                    </td>
                                    <td class="py-3 pe-4 text-center printable-td">
                                        @if($item->Observation == 'Bon état')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 rounded-pill px-3 py-1 w-100 print-badge-green" style="font-weight: 500; font-size: 11px;">Bon état</span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 rounded-pill px-3 py-1 w-100 print-badge-red" style="font-weight: 500; font-size: 11px;">Hors service</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted printable-td">
                                        <i class="bi bi-clipboard-x display-6 d-block mb-3 opacity-25"></i>
                                        <span>Aucune correspondance trouvée pour ces filtres opérationnels.</span>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="{{ asset('js/exportsVersExcel.js') }}"></script>

@endsection
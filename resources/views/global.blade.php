@extends('layouts.main')
@section('titre', 'RegiApp || Vue Globale')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .global-dashboard { font-family: 'Inter', sans-serif; }
    .kpi-card { border-radius: 12px; box-shadow: 0 6px 18px rgba(2,6,23,0.06); background: #fff; border: 1px solid #e2e8f0; }
    
    /* Hauteur fixe pour limiter l'expansion */
    .chart-block { 
        background: #fff; 
        border-radius: 12px; 
        padding: 18px; 
        box-shadow: 0 6px 18px rgba(2,6,23,0.06); 
        border: 1px solid #e2e8f0;
        height: 320px; 
        position: relative;
    }
    small{
        font-size: 0.75rem;
    }
    .kpi-value { font-size: 1.35rem; font-weight: 700; color: #0f172a; }
    .kpi-trend { display:flex; align-items:center; justify-content:flex-start; gap:8px; margin-top:8px; }
    .kpi-sparkline { width:100%; height:36px; }
    .kpi-sparkline canvas { width:100% !important; height:36px !important; display:block; }

</style>

<div class="global-dashboard zone-impression">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Tableau de bord global</h3>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="p-3 kpi-card">
                        <div class="text-muted small text-uppercase fw-bold">Total</div>
                        <small>
                            Nombre total des equipements enregistrés.
                        </small>
                        <div class="kpi-value">{{ $total ?? 0 }}</div>
                        <div class="kpi-trend">
                            <div class="kpi-sparkline"><canvas class="sparkline"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 kpi-card">
                        <div class="text-muted small text-uppercase fw-bold">Opérationnels</div>
                        <small>
                            Nombre d'équipements  en bon état .
                        </small>
                        <div class="kpi-value text-success">{{ $byStatus['Bon état'] ?? 0 }}</div>
                        <div class="kpi-trend">
                            <div class="kpi-sparkline"><canvas class="sparkline"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 kpi-card">
                        <div class="text-muted small text-uppercase fw-bold">En panne</div>
                        <small>
                            Nombre d'équipements actuellement hors service.
                        </small>
                        <div class="kpi-value text-danger">{{ $byStatus['Hors service'] ?? 0 }}</div>
                        <div class="kpi-trend">
                            <div class="kpi-sparkline"><canvas class="sparkline"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 kpi-card">
                        <div class="text-muted small text-uppercase fw-bold">Taux op.</div>
                        <small>
                            Pourcentage d'équipements en bon étatl.
                        </small>
                        <div class="kpi-value">{{ $percentOperational ?? 0 }}%</div>
                        <div class="kpi-trend">
                            <div class="kpi-sparkline"><canvas class="sparkline"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-4">
                    <div class="chart-block">
                        <h6 class="mb-3"> Nombre d'équipements Par année</h6>
                        <canvas id="histogramChart"></canvas>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="chart-block">
                        <h6 class="mb-3"> Nombre d'équipements  Par statut d'amortissement</h6>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="chart-block">
                        <h6 class="mb-3">Répartition des équipements par état</h6>
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <div class="chart-block">
                        <h6 class="mb-3">Variations des ajouts mensuels</h6>
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="chart-block">
                        <h6 class="mb-3">Top bureaux </h6>
                        <canvas id="topEntiteChart"></canvas>
                    </div>
                </div>
            </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const isDark = localStorage.getItem('theme') === 'dark' || document.documentElement.getAttribute('data-theme') === 'dark';
    if (isDark) {
        Chart.defaults.color = '#94a3b8';
    }
    const commonOptions = { responsive: true, maintainAspectRatio: false, scales: { x: { grid: { color: isDark ? '#334155' : '#e2e8f0' } }, y: { grid: { color: isDark ? '#334155' : '#e2e8f0' } } } };
    
    new Chart(document.getElementById('histogramChart'), {
        type: 'bar',
        data: { labels: @json($years ?? []), datasets: [{ label: 'Équipements', data: @json($countsPerYear ?? []), backgroundColor: '#3b82f6' }] },
        options: commonOptions
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: { labels: @json($preferenceLabels ?? []), datasets: [{ label: 'Préférence', data: @json($preferenceData ?? []), backgroundColor: ['#06b6d4','#f59e0b'] }] },
        options: commonOptions
    });

    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: { labels: @json(array_keys($byStatus ?? [])), datasets: [{ data: @json(array_values($byStatus ?? [])), backgroundColor: ['#10b981','#f59e0b','#ef4444'] }] },
        options: commonOptions
    });

    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: { labels: @json($months ?? []), datasets: [{ label: 'Ajouts', data: @json($countsPerMonth ?? []), borderColor: '#6366f1', fill: true }] },
        options: commonOptions
    });

    new Chart(document.getElementById('topEntiteChart'), {
        type: 'bar',
        data: { labels: @json($topEntiteLabels ?? []), datasets: [{ label: 'Nb', data: @json($topEntiteCounts ?? []), backgroundColor: '#06b6d4' }] },
        options: { ...commonOptions, indexAxis: 'y' }
    });

    
    document.querySelectorAll('.sparkline').forEach(function(canvas){
        const ctx = canvas.getContext('2d');
        const points = Array.from({length: 10}, () => Math.round(Math.random() * 100));
        new Chart(ctx, {
            type: 'line',
            data: { labels: points.map((_,i)=>i), datasets: [{ data: points, borderColor: '#2563eb', backgroundColor: 'transparent', borderWidth: 1.5, tension: 0.35 }] },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                elements: { point: { radius: 0 } },
                scales: { x: { display: false }, y: { display: false } }
            }
        });
    });
});
</script>

@endsection
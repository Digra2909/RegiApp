/**
 * RegiApp - Module Global de Gestion Graphique et d'Exportations
 * Centralisation JS complète - Année : 2026
 */

let barChartInstance;
let doughnutChartInstance;
let comboChartInstance;

document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // 1. INITIALISATION DU GRAPHIQUE EN BÂTONS (ENTITÉS)
    // ==========================================
    const ctxBar = document.getElementById('entiteBarChart');
    if (ctxBar) {
        const rawLabels = ctxBar.getAttribute('data-labels');
        const rawValues = ctxBar.getAttribute('data-values');

        const barLabels = rawLabels ? JSON.parse(rawLabels) : [];
        const barValues = rawValues ? JSON.parse(rawValues) : [];

        barChartInstance = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Nombre de machines',
                    data: barValues,
                    backgroundColor: '#0d6efd',
                    borderColor: '#0b5ed7',
                    borderWidth: 1,
                    barThickness: 25
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    }

    // ==========================================
    // 2. INITIALISATION DU GRAPHIQUE DONUT (STATUT COUVERTURE)
    // ==========================================
    const ctxDonut = document.getElementById('statusDonutChart');
    if (ctxDonut) {
        const rawValues = ctxDonut.getAttribute('data-values');
        const donutData = rawValues ? JSON.parse(rawValues) : [0, 0];

        doughnutChartInstance = new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Bon état', 'Hors service'],
                datasets: [{
                    data: donutData,
                    backgroundColor: ['#198754', '#dc3545'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
                cutout: '70%'
            }
        });
    }

    // ===================================================================
    // 3. INITIALISATION DU GRAPH MIXTE (HISTOGRAMME + LIGNE DE TENDANCE DES BUREAUX)
    // ===================================================================
    const ctxCombo = document.getElementById('bureauComboChart');
    if (ctxCombo) {
        const rawLabels = ctxCombo.getAttribute('data-labels');
        const rawValues = ctxCombo.getAttribute('data-values');

        const bureauLabels = rawLabels ? JSON.parse(rawLabels) : [];
        const bureauValues = rawValues ? JSON.parse(rawValues) : [];

        comboChartInstance = new Chart(ctxCombo, {
            type: 'bar',
            data: {
                labels: bureauLabels,
                datasets: [
                    {
                        // Composant 1 : Courbe dorée de liaison / tendance
                        type: 'line',
                        label: 'Ligne d\'évolution de la charge',
                        data: bureauValues,
                        borderColor: '#ffc107',
                        borderWidth: 2,
                        tension: 0.1,
                        fill: false,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#ffc107',
                        pointRadius: 4,
                        order: 1
                    },
                    {
                        // Composant 2 : Bâtons de volume d'outils
                        type: 'bar',
                        label: 'Volume total d\'outils par bureau',
                        data: bureauValues,
                        backgroundColor: 'rgba(13, 110, 253, 0.85)',
                        borderColor: '#0d6efd',
                        borderWidth: 1,
                        barThickness: 30,
                        order: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { boxWidth: 15, font: { size: 11 } } }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 10 } } },
                    x: { ticks: { font: { size: 10, weight: 'bold' } } }
                }
            }
        });
    }
});

// ==========================================
// 4. GESTION DES HOOKS D'IMPRESSION SYSTÈME
// ==========================================
window.addEventListener('beforeprint', () => {
    const table = document.getElementById('targetPrintTable');
    if (table) {
        table.classList.remove('table-dark');
        table.classList.add('table-light');
    }
});

;

function exporterPDF() {
    const originalTitle = document.title;
    document.title = "Rapport_Analytique_RegiApp_2026";
    window.print();
    document.title = originalTitle;
}

// ==========================================
// 5. INFRASTRUCTURE EXPORT EXCEL VIA SHEETJS
// ==========================================
function exporterExcel() {
    const table = document.getElementById("targetPrintTable");

    if (!table) {
        alert("Le tableau principal est introuvable.");
        return;
    }

    const tableCopy = table.cloneNode(true);

    tableCopy.querySelectorAll('tbody tr').forEach(tr => {
        // [Index 1] Désignation : Extraction et nettoyage textuel du sous-titre S/N
        const cellDesig = tr.cells[1];
        if (cellDesig) {
            const subText = cellDesig.querySelector('.subtitle-printable, span');
            if (subText) subText.remove();
            cellDesig.innerText = cellDesig.innerText.trim();
        }

        // [Index 4] Poste : Isolation de la désignation sans le nom du Responsable
        const cellPoste = tr.cells[4];
        if (cellPoste) {
            const subText = cellPoste.querySelector('.subtitle-printable, span');
            if (subText) subText.remove();
            cellPoste.innerText = cellPoste.innerText.trim();
        }

        // [Index 5] Spécificités : Trim simple
        const cellSpec = tr.cells[5];
        if (cellSpec) {
            cellSpec.innerText = cellSpec.innerText.trim();
        }

        // [Index 6] Statut : Isolation de la valeur du badge textuel brut
        const cellStatut = tr.cells[6];
        if (cellStatut) {
            const badge = cellStatut.querySelector('.badge');
            if (badge) {
                cellStatut.innerText = badge.innerText.trim();
            }
        }
    });

    const workbook = XLSX.utils.table_to_book(tableCopy, { sheet: "Spécifications Équipements" });
    // CORRECTION ICI : XLSX.writeFile au lieu de XXLSX.writeFile
    XLSX.writeFile(workbook, "Rapport_Equipements_RegiApp_2026.xlsx");
}
/**
 * RegiApp - Module Global de Gestion Graphique et d'Exportations
 * Centralisation JS complète - Année : 2026
 */

let barChartInstance;
let doughnutChartInstance;

document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // 1. INITIALISATION DU GRAPHIQUE EN BÂTONS
    // ==========================================
    const ctxBar = document.getElementById('entiteBarChart');
    if (ctxBar) {
        // Lecture et décodage des données injectées par Blade
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
    // 2. INITIALISATION DU GRAPHIQUE DONUT
    // ==========================================
    const ctxDonut = document.getElementById('statusDonutChart');
    if (ctxDonut) {
        // Lecture des valeurs de statut injectées par Blade
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
});

// ==========================================
// 3. GESTION DES HOOKS D'IMPRESSION (PDF)
// ==========================================
window.addEventListener('beforeprint', () => {
    const table = document.getElementById('targetPrintTable');
    if (table) {
        table.classList.remove('table-dark');
        table.classList.add('table-light');
    }
});

window.addEventListener('afterprint', () => {
    const table = document.getElementById('targetPrintTable');
    if (table) {
        table.classList.remove('table-light');
        table.classList.add('table-dark');
    }
});

/**
 * Lance l'impression système configurée pour le PDF (Paysage)
 */
function exporterPDF() {
    const originalTitle = document.title;
    document.title = "Rapport_Analytique_RegiApp_2026";
    window.print();
    document.title = originalTitle;
}

// ==========================================
// 4. MODULE D'EXPORTATION EXCEL (7 COLONNES)
// ==========================================
function exporterExcel() {
    const table = document.getElementById("targetPrintTable");

    if (!table) {
        alert("Le tableau est introuvable.");
        return;
    }

    // Copie isolée pour le nettoyage de texte
    const tableCopy = table.cloneNode(true);

    tableCopy.querySelectorAll('tbody tr').forEach(tr => {
        // [Index 1] Désignation : Nettoyage sous-titre S/N
        const cellDesig = tr.cells[1];
        if (cellDesig) {
            const subText = cellDesig.querySelector('.subtitle-printable, span');
            if (subText) subText.remove();
            cellDesig.innerText = cellDesig.innerText.trim();
        }

        // [Index 4] Poste & Responsable : Nettoyage sous-titre Responsable
        const cellPoste = tr.cells[4];
        if (cellPoste) {
            const subText = cellPoste.querySelector('.subtitle-printable, span');
            if (subText) subText.remove();
            cellPoste.innerText = cellPoste.innerText.trim();
        }

        // [Index 5] Autre Spécificité : Trim des espaces
        const cellSpec = tr.cells[5];
        if (cellSpec) {
            cellSpec.innerText = cellSpec.innerText.trim();
        }

        // [Index 6] Statut : Extraction du texte brut du badge Bootstrap
        const cellStatut = tr.cells[6];
        if (cellStatut) {
            const badge = cellStatut.querySelector('.badge');
            if (badge) {
                cellStatut.innerText = badge.innerText.trim();
            }
        }
    });

    // Compilation et envoi du classeur .xlsx via SheetJS
    const workbook = XLSX.utils.table_to_book(tableCopy, { sheet: "Spécifications Équipements" });
    XLSX.writeFile(workbook, "Rapport_Equipements_RegiApp_2026.xlsx");
}
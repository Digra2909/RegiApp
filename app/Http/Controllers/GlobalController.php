<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use Illuminate\Support\Facades\DB;

class GlobalController extends Controller
{
    /**
     * Display the global analytics view.
     */
    public function index()
    {
        // Aggregated data (non-invasive, read-only queries)
        $total = Equipement::count();

        $byStatus = Equipement::select('Observation', DB::raw('count(*) as total'))
            ->groupBy('Observation')
            ->pluck('total', 'Observation')
            ->toArray();

        // Equipments per year
        $perYearQuery = Equipement::selectRaw('YEAR(dateAcc) as year, count(*) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $years = $perYearQuery->pluck('year')->map(fn($y) => (string) $y)->values()->all();
        $countsPerYear = $perYearQuery->pluck('total')->values()->all();

        // Monthly additions (last 12 months)
        $start = now()->subMonths(11)->startOfMonth();
        $monthlyQuery = Equipement::selectRaw("DATE_FORMAT(dateAcc, '%Y-%m') as ym, count(*) as total")
            ->where('dateAcc', '>=', $start)
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        $months = [];
        $countsPerMonth = [];
        for ($i = 0; $i < 12; $i++) {
            $m = $start->copy()->addMonths($i)->format('Y-m');
            $months[] = $m;
            $found = $monthlyQuery->firstWhere('ym', $m);
            $countsPerMonth[] = $found ? (int) $found->total : 0;
        }

        // Percent operational
        $operational = $byStatus['Bon état'] ?? 0;
        $percentOperational = $total ? round(100 * $operational / $total, 1) : 0;

        // Equipments amortis (>=5 years)
        $amortisCount = Equipement::whereDate('dateAcc', '<=', now()->subYears(5))->count();

        // Preference chart: amortis vs non-amortis
        $nonAmortisCount = max(0, $total - $amortisCount);
        $preferenceLabels = ['Amortis', 'Non amortis'];
        $preferenceData = [$amortisCount, $nonAmortisCount];

        // Top 5 entites by equipment count
        $topEntites = DB::table('equipements')
            ->join('postes', 'equipements.poste_id', '=', 'postes.id')
            ->join('entites', 'postes.entite_id', '=', 'entites.id')
            ->select('entites.designationEntite', DB::raw('count(*) as total'))
            ->groupBy('entites.designationEntite')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topEntiteLabels = $topEntites->pluck('designationEntite')->map(fn($v)=> (string)$v)->all();
        $topEntiteCounts = $topEntites->pluck('total')->map(fn($v)=> (int)$v)->all();

        return view('global', compact(
            'total', 'byStatus', 'years', 'countsPerYear',
            'months', 'countsPerMonth', 'percentOperational', 'amortisCount',
            'topEntiteLabels', 'topEntiteCounts', 'topEntites',
            'preferenceLabels', 'preferenceData'
        ));
    }
}


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
        $total = Equipement::count();

        $byStatus = Equipement::select('Observation', DB::raw('count(*) as total'))
            ->groupBy('Observation')
            ->pluck('total', 'Observation')
            ->toArray();

        $perYearQuery = Equipement::selectRaw("strftime('%Y', dateAcc) as year, count(*) as total")
            ->groupBy(DB::raw("strftime('%Y', dateAcc)"))
            ->orderBy('year')
            ->get();

        $years = $perYearQuery->pluck('year')->map(fn($y) => (string) $y)->values()->all();
        $countsPerYear = $perYearQuery->pluck('total')->values()->all();

        $start = now()->subMonths(11)->startOfMonth();
        $monthlyQuery = Equipement::selectRaw("strftime('%Y-%m', dateAcc) as ym, count(*) as total")
            ->where('dateAcc', '>=', $start)
            ->groupBy(DB::raw("strftime('%Y-%m', dateAcc)"))
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

        $operational = $byStatus['Bon état'] ?? 0;
        $percentOperational = $total ? round(100 * $operational / $total, 1) : 0;

        $amortisCount = Equipement::whereDate('dateAcc', '<=', now()->subYears(5))->count();

        $nonAmortisCount = max(0, $total - $amortisCount);
        $preferenceLabels = ['Amortis', 'Non amortis'];
        $preferenceData = [$amortisCount, $nonAmortisCount];

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


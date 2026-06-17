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

        // Equipments per year (driver-aware for sqlite/mysql)
        $driver = DB::connection()->getDriverName();
        if ($driver === 'sqlite') {
            $yearExpr = "strftime('%Y', dateAcc)";
        } else {
            $yearExpr = "YEAR(dateAcc)";
        }

        $perYearQuery = Equipement::selectRaw("{$yearExpr} as year, count(*) as total")
            ->groupBy(DB::raw($yearExpr))
            ->orderBy(DB::raw($yearExpr))
            ->get();

        $years = $perYearQuery->pluck('year')->map(fn($y) => (string) $y)->values()->all();
        $countsPerYear = $perYearQuery->pluck('total')->values()->all();

        // Monthly additions (last 12 months)
        $start = now()->subMonths(11)->startOfMonth();
        if ($driver === 'sqlite') {
            $ymExpr = "strftime('%Y-%m', dateAcc)";
        } else {
            $ymExpr = "DATE_FORMAT(dateAcc, '%Y-%m')";
        }

        $monthlyQuery = Equipement::selectRaw("{$ymExpr} as ym, count(*) as total")
            ->where('dateAcc', '>=', $start->toDateString())
            ->groupBy(DB::raw($ymExpr))
            ->orderBy(DB::raw($ymExpr))
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
        $cutoff = now()->subYears(5)->toDateString();
        $amortisCount = Equipement::where('dateAcc', '<=', $cutoff)->count();

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


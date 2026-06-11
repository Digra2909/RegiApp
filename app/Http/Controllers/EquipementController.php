<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\Equipement;
use App\Models\Poste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Récupération des paramètres de filtrage
        $search = $request->input('search');
        $entiteId = $request->input('entite_id');
        $observation = $request->input('observation');

        // 2. Initialisation de la requête globale avec des LEFT JOIN pour ne perdre aucune donnée
        $baseQuery = DB::table('equipements')
            ->leftJoin('postes', 'equipements.poste_id', '=', 'postes.id')
            ->leftJoin('entites', 'postes.entite_id', '=', 'entites.id');

        // Application stricte et globale des filtres
        if (! empty($search)) {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('equipements.designationEquipement', 'like', "%{$search}%")
                    ->orWhere('equipements.nImmoEquipement', 'like', "%{$search}%")
                    ->orWhere('equipements.NserieEquipement', 'like', "%{$search}%");
            });
        }

        if (! empty($entiteId)) {
            $baseQuery->where('postes.entite_id', $entiteId);
        }

        // Correction ici : On filtre avec la vraie valeur textuelle attendue en Base de Données
        if (! empty($observation)) {
            $baseQuery->where('equipements.Observation', $observation);
        }

        // 3. Récupération des équipements filtrés pour le tableau principal
        $equipements = $baseQuery->clone()
            ->select(
                'equipements.*',
                'postes.designationPoste',
                'postes.nomResponsble',
                DB::raw('COALESCE(entites.designationEntite, "Aucune") as nom_entite')
            )
            ->orderBy('equipements.created_at', 'desc')
            ->get();

        // 4. CALCULS DES KPI DYNAMIQUES (Accents corrigés en UTF-8)
        $totalEquipements = $equipements->count();

        $totalPostes = $baseQuery->clone()->distinct()->count('equipements.poste_id');
        $totalEntites = $baseQuery->clone()->whereNotNull('postes.entite_id')->distinct()->count('postes.entite_id');

        // RE-CORRECTION DES ACCENTS ICI :
        $bonEtat = $equipements->where('Observation', 'Bon état')->count();
        $horsService = $equipements->where('Observation', 'Hors service')->count();
        $tauxDispo = $totalEquipements > 0 ? round(($bonEtat / $totalEquipements) * 100, 1) : 0;

        // 5. DONNÉES DU GRAPHIQUE ANNEAU
        $donutData = [$bonEtat, $horsService];

        // 6. DONNÉES DU GRAPHIQUE HISTOGRAMME
        $equipementsParEntite = $baseQuery->clone()
            ->select(
                DB::raw('COALESCE(entites.designationEntite, "Sans Entité") as label'),
                DB::raw('count(equipements.id) as total')
            )
            ->groupBy('postes.entite_id', 'entites.designationEntite')
            ->get();

        $barLabels = $equipementsParEntite->pluck('label')->toArray();
        $barValues = $equipementsParEntite->pluck('total')->toArray();

        // Liste complète des entités
        $entites = Entite::all();

        return view('Equipement.index', compact(
            'equipements', 'totalEquipements', 'totalPostes', 'totalEntites', 'tauxDispo',
            'donutData', 'barLabels', 'barValues', 'entites'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postes = Poste::with('entite')->get();
        $entites = Entite::all();
        $equipements = Equipement::with('poste')->get();

        return view('Equipement.create', compact('postes', 'entites', 'equipements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $equipement = Equipement::Create([
            'designationEquipement' => $request['designationEquipement'],
            'NserieEquipement' => $request['NserieEquipement'],
            'nImmoEquipement' => $request['nImmoEquipement'],
            'Observation' => $request['Observation'],
            'dateAcc' => $request['dateAcc'],
            'autreSpecTech' => $request['autreSpecTech'],
            'poste_id' => $request['poste_id'],
        ]);

        $postes = Poste::with('entite')->get();
        $entites = Entite::all();
        $equipements = Equipement::with('poste')->get();

        return view('Equipement.create', compact('postes', 'entites', 'equipements'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipement = Equipement::find($id);
        $equipement->designationEquipement = $request['designationEquipement'];
        $equipement->NserieEquipement = $request['NserieEquipement'];
        $equipement->nImmoEquipement = $request['nImmoEquipement'];
        $equipement->Observation = $request['Observation'];
        $equipement->dateAcc = $request['dateAcc'];
        $equipement->autreSpecTech = $request['autreSpecTech'];
        $equipement->poste_id = $request['poste_id'];
        $equipement->save();

        $postes = Poste::with('entite')->get();
        $entites = Entite::all();
        $equipements = Equipement::with('poste')->get();

        return view('Equipement.create', compact('postes', 'entites', 'equipements'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipement = Equipement::find($id);
        $equipement->delete();

        $postes = Poste::with('entite')->get();
        $entites = Entite::all();
        $equipements = Equipement::with('poste')->get();

        return view('Equipement.create', compact('postes', 'entites', 'equipements'));
    }
}

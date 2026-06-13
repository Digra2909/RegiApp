<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\Equipement;
use App\Models\Poste;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // ==========================================
        // 1. Vos filtres et requêtes de base existants
        // ==========================================
        $search = $request->input('search');
        $entiteId = $request->input('entite_id');
        $observation = $request->input('observation');

        $baseQuery = DB::table('equipements')
            ->leftJoin('postes', 'equipements.poste_id', '=', 'postes.id')
            ->leftJoin('entites', 'postes.entite_id', '=', 'entites.id');

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

        if (! empty($observation)) {
            $baseQuery->where('equipements.Observation', $observation);
        }

        $equipements = $baseQuery->clone()
            ->select(
                'equipements.*',
                'postes.designationPoste',
                'postes.nomResponsble',
                DB::raw('COALESCE(entites.designationEntite, "Aucune") as nom_entite')
            )
            ->orderBy('equipements.created_at', 'desc')
            ->get();

        // Vos KPIs globaux existants
        $totalEquipements = $equipements->count();
        $totalPostes = $baseQuery->clone()->distinct()->count('equipements.poste_id');
        $totalEntites = $baseQuery->clone()->whereNotNull('postes.entite_id')->distinct()->count('postes.entite_id');

        $bonEtat = $equipements->where('Observation', 'Bon état')->count();
        $horsService = $equipements->where('Observation', 'Hors service')->count();
        $tauxDispo = $totalEquipements > 0 ? round(($bonEtat / $totalEquipements) * 100, 1) : 0;
        $donutData = [$bonEtat, $horsService];

        $equipementsParEntite = $baseQuery->clone()
            ->select(
                DB::raw('COALESCE(entites.designationEntite, "Sans EntitÃ©") as label'),
                DB::raw('count(equipements.id) as total')
            )
            ->groupBy('postes.entite_id', 'entites.designationEntite')
            ->get();

        $barLabels = $equipementsParEntite->pluck('label')->toArray();
        $barValues = $equipementsParEntite->pluck('total')->toArray();
        $entites = Entite::all();

        // ==========================================
        // NOUVEAU : 2. ANALYSE DES ÉQUIPEMENTS AMORTIS (Seuil : 5 ans)
        // ==========================================
        // On filtre la collection actuelle : si l'année en cours (2026) - année(dateAcc) >= 5
        $equipementsAmortis = $equipements->filter(function ($item) {
            if (empty($item->dateAcc)) {
                return false;
            }
            try {
                $anneeAcquisition = Carbon::parse($item->dateAcc)->year;

                return (2026 - $anneeAcquisition) >= 5;
            } catch (\Exception $e) {
                return false;
            }
        });
        $totalAmortis = $equipementsAmortis->count();

        // ==========================================
        // NOUVEAU : 3. ANALYSE DU BUREAU LE PLUS OUTILLÉ
        // ==========================================
        // Classement de tous les postes par volume d'équipements (basé sur la requête filtrée)
        $classementBureaux = $baseQuery->clone()
            ->select(
                'postes.designationPoste as bureau',
                'postes.nomResponsble as responsable',
                'entites.designationEntite as entite',
                DB::raw('COUNT(equipements.id) as total_outils')
            )
            ->whereNotNull('equipements.poste_id')
            ->groupBy('equipements.poste_id', 'postes.designationPoste', 'postes.nomResponsble', 'entites.designationEntite')
            ->orderBy('total_outils', 'desc')
            ->get();

        // Extraction des données du premier (le plus outillé)
        $bureauPlusOutille = $classementBureaux->first();
        $nomBureauPlusOutille = $bureauPlusOutille ? $bureauPlusOutille->bureau : 'Aucun';
        $maxOutils = $bureauPlusOutille ? $bureauPlusOutille->total_outils : 0;

        // Préparation des données pour le graphique Combo des Bureaux
        $bureauLabels = $classementBureaux->pluck('bureau')->toArray();
        $bureauValues = $classementBureaux->pluck('total_outils')->toArray();

        return view('Equipement.index', compact(
            'equipements', 'totalEquipements', 'totalPostes', 'totalEntites', 'tauxDispo',
            'donutData', 'barLabels', 'barValues', 'entites',
            // Nouvelles variables injectées
            'equipementsAmortis', 'totalAmortis', 'nomBureauPlusOutille', 'maxOutils',
            'classementBureaux', 'bureauLabels', 'bureauValues'
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

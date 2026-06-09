<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\Equipement;
use App\Models\Poste;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

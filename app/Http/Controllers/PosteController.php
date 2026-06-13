<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\Poste;
use Illuminate\Http\Request;

class PosteController extends Controller
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
        $entites = Entite::all();

        $postes = Poste::with('entite')->get();

        return view('Poste.create', compact('entites', 'postes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $entite = Entite::find($request['entite_id']);

        $request['designationPoste'] = $entite->designationEntite.'-'.$request['designationPoste'];
        $poste = Poste::Create([
            'designationPoste' => $request['designationPoste'],
            'nomResponsble' => $request['nomResponsble'],
            'entite_id' => $request['entite_id'],
        ]);
        $entites = Entite::all();

        $postes = Poste::with('entite')->get();

        return view('Poste.create', compact('entites', 'postes'));
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
        $poste = Poste::find($id);
        $entite = Entite::find($request['entite_id']);

        $poste->designationPoste = $entite->designationEntite.'-'.$request['designationPoste'];
        $poste->nomResponsble = $request['nomResponsble'];
        $poste->entite_id = $request['entite_id'];
        $poste->save();

        $entites = Entite::all();

        $postes = Poste::with('entite')->get();

        return view('Poste.create', compact('entites', 'postes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poste = Poste::findOrFail($id);
        $poste->delete();

        return redirect()->route('Poste.create')
            ->with('success', 'Poste supprimé avec succès.');
    }
}

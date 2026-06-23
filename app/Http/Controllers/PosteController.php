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
        $validated = $request->validate([
            'designationPoste' => 'required|string|max:255',
            'nomResponsble' => 'required|string|max:255',
            'entite_id' => 'required|exists:entites,id',
        ]);

        $entite = Entite::findOrFail($validated['entite_id']);

        Poste::create([
            'designationPoste' => $entite->designationEntite.'-'.$validated['designationPoste'],
            'nomResponsble' => $validated['nomResponsble'],
            'entite_id' => $validated['entite_id'],
        ]);

        return redirect()->route('Poste.create')
            ->with('success', 'Poste créé avec succès.');
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
        $validated = $request->validate([
            'designationPoste' => 'required|string|max:255',
            'nomResponsble' => 'required|string|max:255',
            'entite_id' => 'required|exists:entites,id',
        ]);

        $poste = Poste::findOrFail($id);
        $entite = Entite::findOrFail($validated['entite_id']);

        $poste->designationPoste = $entite->designationEntite.'-'.$validated['designationPoste'];
        $poste->nomResponsble = $validated['nomResponsble'];
        $poste->entite_id = $validated['entite_id'];
        $poste->save();

        return redirect()->route('Poste.create')
            ->with('success', 'Poste mis à jour avec succès.');
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

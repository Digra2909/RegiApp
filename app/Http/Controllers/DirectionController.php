<?php

namespace App\Http\Controllers;

use App\Models\Direction; // Assurez-vous que le modèle existe ou adaptez le nom
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource and the creation form.
     */
    public function index()
    {
        // Récupération de toutes les directions pour alimenter le tableau Blade
        $directions = Direction::all();

        // Retourne la vue 'create' que nous avons configurée
        return view('Direction.create', compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirection vers l'index car le formulaire de création est inclus sur la même page
        return redirect()->route('Direction.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données soumises par le formulaire "Nouvelle Direction"
        $validated = $request->validate([
            'designationDirection' => 'required|string|max:255',
            'codeDirection' => 'required|string|max:50|unique:directions,codeDirection',
            'nomDirecteur' => 'required|string|max:255',
        ]);

        // Insertion dans la base de données
        Direction::create($validated);

        // Redirection avec un message de succès
        return redirect()->route('Direction.index')
            ->with('success', 'La direction a été enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Non utilisé dans notre interface actuelle
        return redirect()->route('Direction.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Non utilisé car l'édition se fait via un Modal Bootstrap sur la page index
        return redirect()->route('Direction.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Recherche de la direction à modifier
        $direction = Direction::findOrFail($id);

        // Validation des données du Modal d'édition
        // Le code de la direction doit être unique, sauf pour celle en cours de modification
        $validated = $request->validate([
            'designationDirection' => 'required|string|max:255',
            'codeDirection' => 'required|string|max:50|unique:directions,codeDirection,'.$direction->id,
            'nomDirecteur' => 'required|string|max:255',
        ]);

        // Mise à jour des données
        $direction->update($validated);

        // Redirection avec notification
        return redirect()->route('Direction.index')
            ->with('success', 'La direction a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $direction = Direction::findOrFail($id);
        $direction->delete();

        return redirect()->route('Direction.index')
            ->with('success', 'La direction a été supprimée avec succès.');
    }
}

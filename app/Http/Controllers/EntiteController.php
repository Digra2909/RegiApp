<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use Illuminate\Http\Request;

class EntiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entites = Entite::all();

        return view('Entite.create', compact('entites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designation' => 'required|string|max:255',
        ]);
        $entite = Entite::create([
            'designationEntite' => $validated['designation'],
        ]);

        return redirect()->route('Entite.create')
            ->with('success', 'Entité créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entite = Entite::findOrFail($id);

        return view('Entite.show', compact('entite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entite = Entite::findOrFail($id);

        return view('Entite.edit', compact('entite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'designationEntite' => 'required|string|max:255',
        ]);

        $entite = Entite::findOrFail($id);
        $entite->update($request->all());

        return redirect()->route('Entite.create')
            ->with('success', 'Entité mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entite = Entite::findOrFail($id);
        $entite->delete();

        return redirect()->route('Entite.create')
            ->with('success', 'Entité supprimée avec succès.');
    }
}

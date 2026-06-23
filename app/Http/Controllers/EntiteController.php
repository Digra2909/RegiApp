<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\Direction;
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
        $directions = Direction::all();

        return view('Entite.create', compact('entites', 'directions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designationEntite' => 'required|string|max:255',
            'direction_id' => 'required|exists:directions,id',
        ]);

        $entite = Entite::create([
            'designationEntite' => $validated['designationEntite'],
            'direction_id' => $validated['direction_id'],
        ]);

        return redirect()->route('Entite.create')
            ->with('success', 'Bureau créée avec succès.');
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
        $directions = Direction::all();

        return view('Entite.edit', compact('entite', 'directions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'designationEntite' => 'required|string|max:255',
            'direction_id' => 'required|exists:directions,id',
        ]);

        $entite = Entite::findOrFail($id);
        $entite->update($validated);

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

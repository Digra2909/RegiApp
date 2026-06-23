<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource and the creation form.
     */
    public function index()
    {
        $directions = Direction::all();

        return view('Direction.create', compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('Direction.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designationDirection' => 'required|string|max:255',
            'codeDirection' => 'required|string|max:50|unique:directions,codeDirection',
            'nomDirecteur' => 'required|string|max:255',
        ]);

        Direction::create($validated);

        return redirect()->route('Direction.index')
            ->with('success', 'La direction a été enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('Direction.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('Direction.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $direction = Direction::findOrFail($id);

        // Le code doit être unique, sauf pour la direction en cours de modification
        $validated = $request->validate([
            'designationDirection' => 'required|string|max:255',
            'codeDirection' => 'required|string|max:50|unique:directions,codeDirection,'.$direction->id,
            'nomDirecteur' => 'required|string|max:255',
        ]);

        $direction->update($validated);

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

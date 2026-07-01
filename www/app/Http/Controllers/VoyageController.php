<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // 1. On récupère tous les voyages stockés en Base de Données
        $voyages = Voyage::all();

        // 2. On renvoie la vue "voyages.index" en lui passant la liste
        return view('voyages.index', compact('voyages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Voyage::class);
        return view('voyages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date|after:today',
            'date_retour' => 'required|date|after:date_depart',
            'places_max' => 'required|integer|min:1|max:200',
        ]);

        $validated['user_id'] = Auth::id();
        Voyage::create($validated);

        return redirect()->route('voyages.index')
            ->with('success', 'Voyage créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voyage $voyage)
    {
        $voyage->load('participants.user');
        return view('voyages.show', compact('voyage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voyage $voyage)
    {
        $this->authorize('update', $voyage);
        return view('voyages.edit', compact('voyage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voyage $voyage)
    {
        $this->authorize('update', $voyage);
        $validated = $request->validate([
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date|after:today',
            'date_retour' => 'required|date|after:date_depart',
            'places_max' => 'required|integer|min:1|max:200',
        ]);

        $voyage->update($validated);

        return redirect()->route('voyages.index')
            ->with('success', 'Voyage mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voyage $voyage)
    {
        $this->authorize('delete', $voyage);
        $voyage->delete();

        return redirect()->route('voyages.index')
            ->with('success', 'Voyage supprimé.');
    }
}
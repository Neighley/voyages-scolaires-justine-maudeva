<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ParticipantController extends Controller
{
    
    public function store(Request $request, Voyage $voyage): RedirectResponse
    {
        // Code de validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Code d'insertion
        Participant::create([
            'voyage_id' => $voyage->id,
            'user_id' => $request->user_id,
        ]);

        return back()->with('success', 'Inscrit au voyage.');
    }

   
    public function autoriser(Participant $participant): RedirectResponse
    {
        // On vérifie que l'utilisateur a le droit de faire cette action
        $this->authorize('update', $participant);

        // On passe le statut à true
        $participant->update([
            'autorisation_parent' => true
        ]);

        return back()->with('success', 'Autorisation enregistrée.');
    }
}
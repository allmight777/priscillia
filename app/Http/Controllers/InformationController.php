<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    // Affiche le formulaire de modification (créé ou récupère la 1ère ligne)
    public function edit()
    {
        $info = Information::firstOrCreate([]);
        return view('admin.information', compact('info'));
    }

    // Met à jour les infos
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'jours_ouverture' => 'nullable|string',
            'heures_ouverture' => 'nullable|string',
        ]);

        $info = Information::first();
        $info->update($request->all());

        return redirect()->back()->with('success', 'Informations mises à jour avec succès.');
    }
}

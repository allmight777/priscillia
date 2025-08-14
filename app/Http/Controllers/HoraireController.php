<?php

namespace App\Http\Controllers;

use App\Models\Horaire;
use Illuminate\Http\Request;

class HoraireController extends Controller
{
    public function index()
    {
        $horaires = Horaire::all();
        return view('admin.horaires', compact('horaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jour' => 'required|string',
            'heure_ouverture' => 'required|string',
            'heure_fermeture' => 'required|string',
        ]);

        Horaire::create($request->only('jour', 'heure_ouverture', 'heure_fermeture'));

        return redirect()->back()->with('success', 'Horaire ajouté avec succès.');
    }

    public function destroy($id)
    {
        Horaire::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Horaire supprimé.');
    }
}

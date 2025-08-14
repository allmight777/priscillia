<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        return view('admin.configuration', [
            'seuil' => Configuration::getValeur('seuil_commande', 10000),
            'pourcentage' => Configuration::getValeur('pourcentage_avance', 75),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'seuil_commande' => 'required|numeric|min:0',
            'pourcentage_avance' => 'required|numeric|min:1|max:100',
        ]);

        Configuration::setValeur('seuil_commande', $request->seuil_commande);
        Configuration::setValeur('pourcentage_avance', $request->pourcentage_avance);

        return redirect()->back()->with('success', 'Configuration mise à jour avec succès.');
    }
}

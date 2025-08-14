<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\Configuration;
class PanierController extends Controller
{

public function index()
{
    $panier = session()->get('panier', []);
    $total = array_sum(array_column($panier, 'sous_total'));

    $montantSeuil = Configuration::getValeur('seuil_commande', 10000);
    $pourcentage = Configuration::getValeur('pourcentage_avance', 75);

    return view('client.panier.index', compact('panier', 'total', 'montantSeuil', 'pourcentage'));
}

    public function ajouter(Request $request, $produitId)
    {
        $produit = Produit::findOrFail($produitId);
        $panier = session()->get('panier', []);

        $quantite = $request->input('quantite', 1);
        $sous_total = $produit->prix * $quantite;

        $panier[$produitId] = [
            'id' => $produit->id,
            'nom' => $produit->nom,
            'prix' => $produit->prix,
            'quantite' => $quantite,
            'sous_total' => $sous_total,
        ];

        session()->put('panier', $panier);
        return redirect()->route('panier.index')->with('success', 'Produit ajouté au panier');
    }

    public function retirer($produitId)
    {
        $panier = session()->get('panier', []);
        unset($panier[$produitId]);
        session()->put('panier', $panier);

        return back()->with('success', 'Produit retiré du panier');
    }

    public function vider()
    {
        session()->forget('panier');
        return back()->with('success', 'Panier vidé');
    }
}


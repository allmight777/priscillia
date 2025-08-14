<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categorie::all();
        $produits = Produit::query();

        if ($request->filled('categorie')) {
            $produits->where('categorie_id', $request->categorie);
        }

        if ($request->filled('search')) {
            $produits->where('nom', 'like', '%' . $request->search . '%');
        }

        return view('client.produits.index', [
            'produits' => $produits->paginate(8),
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('client.produits.show', compact('produit'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index() {
        $categories = Categorie::all();
        return view('admin.produits.categorie', compact('categories'));
    }

    public function afficherProduits($id) {
        $categorie = Categorie::findOrFail($id);
        $produits = $categorie->produits;
        return view('admin.produits.liste', compact('categorie', 'produits'));
    }

   /* public function create($categorie_id) {
        $categorie = Categorie::findOrFail($categorie_id);
        return view('admin.produits.create', compact('categorie'));
    }*/
    public function create() {
    $categories = Categorie::all();
    return view('admin.produits.create', compact('categories'));
}

    /*public function store(Request $request) {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        Produit::create($request->only('nom', 'prix', 'categorie_id','image'));
        return redirect()->route('produits.categorie', $request->categorie_id)->with('success', 'Produit ajouté.');
    }*/
    public function store(Request $request) 
{
    $validatedData = $request->validate([
        'nom' => 'required',
        'prix' => 'required|numeric',
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        'categorie_id' => 'required|exists:categories,id',
    ]);

    // Traitement de l'image
    if ($request->hasFile('image')) {
        // 1. Stockage dans storage/app/public/produits
        $imagePath = $request->file('image')->store('produits', 'public');
        
        // 2. Ajout du chemin relatif aux données validées
        $validatedData['image'] = $imagePath; // "produits/nomfichier.jpg"
    }

    // Création du produit avec TOUTES les données (y compris le chemin de l'image)
    Produit::create($validatedData);

    return redirect()
           ->route('produits.categorie', $request->categorie_id)
           ->with('success', 'Produit ajouté avec succès.');
}

    public function edit($id) {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.produits.edit', compact('produit','categories'));
    }

    public function update(Request $request, $id) {
        $produit = Produit::findOrFail($id);
        $request->validate(['nom' => 'required', 'prix' => 'required|numeric']);
        $produit->update($request->only('nom', 'prix'));
        return redirect()->route('produits.categorie', $produit->categorie_id)->with('success', 'Produit mis à jour.');
    }

    public function destroy($id) {
        $produit = Produit::findOrFail($id);
        $categorieId = $produit->categorie_id;
        $produit->delete();
        return redirect()->route('produits.categorie', $categorieId)->with('success', 'Produit supprimé.');
    }
}


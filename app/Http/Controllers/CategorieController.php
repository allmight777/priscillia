<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index() {
        $categories = Categorie::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $request->validate(['nom' => 'required|string|max:255|unique:categories']);
        Categorie::create(['nom' => $request->nom]);
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée.');
    }

    public function edit($id) {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categories.edit', compact('categorie'));
    }

    public function update(Request $request, $id) {
        $categorie = Categorie::findOrFail($id);
        $request->validate(['nom' => 'required|string|max:255|unique:categories,nom,' . $categorie->id]);
        $categorie->update(['nom' => $request->nom]);
        return redirect()->route('categories.index')->with('success', 'Catégorie modifiée.');
    }
    
    public function destroy($id) {
        Categorie::findOrFail($id)->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
    }
}

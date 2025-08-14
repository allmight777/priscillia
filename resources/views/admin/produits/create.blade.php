@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un produit</h1>

    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (F CFA)</label>
            <input type="number" name="prix" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-control" required>
                <option value="">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image du produit</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

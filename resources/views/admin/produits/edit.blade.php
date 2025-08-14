@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le produit</h1>

    <form action="{{ route('produits.update', $produit) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $produit->nom }}" required>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (F CFA)</label>
            <input type="number" name="prix" class="form-control" value="{{ $produit->prix }}" required>
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $produit->categorie_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection

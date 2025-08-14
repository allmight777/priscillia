@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Produits</h1>

    <form method="GET" action="{{ route('client.produits.index') }}" class="mb-4 d-flex gap-2">
        <select name="categorie" class="form-select" style="max-width: 200px;">
            <option value="">Toutes les catégories</option>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
            @endforeach
        </select>
        <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
        <button class="btn btn-primary">Filtrer</button>
    </form>

    @if($produits->count() > 0)
    <div class="row">
        @foreach ($produits as $produit)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($produit->image)
                        <img src="{{ asset('storage/' . $produit->image) }}" class="card-img-top" alt="{{ $produit->nom }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produit->nom }}</h5>
                        <p class="card-text">{{ Str::limit($produit->description, 60) }}</p>
                        <p class="fw-bold">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                        <a href="{{ route('client.produits.show', $produit->id) }}" class="btn btn-outline-primary mt-auto">Voir détails</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $produits->withQueryString()->links() }}

    @else
        <p>Aucun produit trouvé.</p>
    @endif
</div>
@endsection

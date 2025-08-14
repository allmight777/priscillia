@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $produit->nom }}</h1>

    <div class="row">
        <div class="col-md-6">
            @if($produit->image)
                <img src="{{ asset('storage/' . $produit->image) }}" class="img-fluid" alt="{{ $produit->nom }}">
            @endif
        </div>
        <div class="col-md-6">
            <p>{{ $produit->description }}</p>

            <!-- Prix unitaire -->
            <p class="fw-bold fs-4">
                Prix unitaire : <span id="prix-unitaire" data-prix="{{ $produit->prix }}">
                    {{ number_format($produit->prix, 0, ',', ' ') }}
                </span> FCFA
            </p>

            <!-- Prix total dynamique -->
            <p class="fw-bold fs-5 text-primary">
                Total : <span id="prix-total">{{ number_format($produit->prix, 0, ',', ' ') }}</span> FCFA
            </p>

            <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                @csrf
                <label for="quantite" class="me-2">Quantité :</label>
                <input type="number" name="quantite" id="quantite" value="1" min="1" class="form-control" style="width: 80px;">
                <button type="submit" class="btn btn-success">Ajouter au panier</button>
            </form>
        </div>
    </div>

    <a href="{{ route('client.produits.index') }}" class="btn btn-link mt-4">← Retour à la liste</a>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantiteInput = document.getElementById('quantite');
        const prixUnitaire = parseFloat(document.getElementById('prix-unitaire').dataset.prix);
        const prixTotalSpan = document.getElementById('prix-total');

        function mettreAJourPrix() {
            const quantite = parseInt(quantiteInput.value) || 1;
            const total = prixUnitaire * quantite;

            // Formatage du total (ex: 1500 => "1 500")
            prixTotalSpan.textContent = total.toLocaleString('fr-FR');
        }

        quantiteInput.addEventListener('input', mettreAJourPrix);
    });
</script>
@endsection

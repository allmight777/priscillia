@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h2>Détails de la commande #{{ $commande->id }}</h2>
        <p>Statut : {{ $commande->statut }}</p>
        <p>Total : {{ $commande->total }} FCFA</p>
       <ul>
    @foreach ($commande->produits as $produit)
        <li>{{ $produit['nom'] ?? 'Produit inconnu' }}</li>
    @endforeach
</ul>

@section('content')
<div class="container">
    <h2>Détails de la commande #{{ $commande->id }}</h2>
    <p><strong>Client :</strong> {{ $commande->user->nom ?? 'Inconnu' }}</p>
    <p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>
    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    
    <p><strong>Total :</strong> {{ number_format($commande->total, 0, ',', ' ') }} FCFA</p>
    <p><strong>Montant payé :</strong> {{ number_format($commande->avance ?? 0, 0, ',', ' ') }} FCFA</p>
    <p><strong>Reste à payer :</strong> {{ number_format(($commande->total - ($commande->avance ?? 0)), 0, ',', ' ') }} FCFA</p>

    @if($commande->produits && count($commande->produits) > 0)
        <table class="table table-bordered align-middle mt-4">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commande->produits as $produit)
                    <tr>
                        <td>{{ $produit['nom'] ?? 'Produit inconnu' }}</td>
                        <td>{{ number_format($produit['prix'] ?? 0, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $produit['quantite'] ?? 1 }}</td>
                        <td>{{ number_format(($produit['prix'] ?? 0) * ($produit['quantite'] ?? 1), 0, ',', ' ') }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun produit trouvé dans cette commande.</p>
    @endif
</div>
@endsection

    </div>
@endsection

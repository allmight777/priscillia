@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Votre panier</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($panier) > 0)
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($panier as $item)
            <tr>
                <td>{{ $item['nom'] }}</td>
                <td>{{ number_format($item['prix'], 0, ',', ' ') }} FCFA</td>
                <td>{{ $item['quantite'] }}</td>
                <td>{{ number_format($item['sous_total'], 0, ',', ' ') }} FCFA</td>
                <td>
                    <form action="{{ route('panier.retirer', $item['id']) }}" method="POST" onsubmit="return confirm('Voulez-vous retirer ce produit ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($total >= $montantSeuil)
    <div class="alert alert-warning">
        Le total dépasse {{ number_format($montantSeuil, 0, ',', ' ') }} F. Vous devez payer 3/4 soit 
        {{ number_format($total * 0.75, 0, ',', ' ') }} F pour valider la commande.
    </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mt-3">
        <h4>Total : {{ number_format($total, 0, ',', ' ') }} FCFA</h4>
        <a href="{{ route('commande.valider') }}" class="btn btn-primary">Valider la commande</a>
    </div>

    @else
        <p>Votre panier est vide.</p>
    @endif
</div>
@endsection

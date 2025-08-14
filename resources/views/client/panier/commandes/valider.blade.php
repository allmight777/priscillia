@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Validation de la commande</h1>

    <p>Montant total : <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong></p>

    @if ($total >= $seuil)
        <p>Le montant dépasse le seuil de <strong>{{ number_format($seuil, 0, ',', ' ') }} FCFA</strong>.</p>
        <p>Un acompte de <strong>{{ $pourcentage }}%</strong> est requis.</p>
        <p>Montant à payer : <strong>{{ number_format($avance, 0, ',', ' ') }} FCFA</strong></p>
        <a href="{{ route('admin.paiement', $commande->id) }}" class="btn btn-success">Payer maintenant</a>
    @else
        <form action="{{ route('commande.confirmer') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Confirmer la commande</button>
        </form>
    @endif
</div>
@endsection

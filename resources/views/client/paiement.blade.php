@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Paiement de la commande</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <p>Montant total : <strong>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</strong></p>
    <p>Montant à payer (avance {{ $pourcentage }}%) : 
       <strong>{{ number_format($avance, 0, ',', ' ') }} FCFA</strong></p>

    <form action="{{ route('paiement.process', $commande->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="telephone">Numéro Mobile Money</label>
            <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Ex: 97000000" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Payer maintenant avec FedaPay</button>
    </form>
</div>
@endsection

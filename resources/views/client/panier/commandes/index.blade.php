@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($commandes->count() > 0)
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date</th>
                    <th>Montant total</th>
                    <th>Montant payé</th>
                    <th>Statut</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($commande->avance, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @if($commande->statut == 'validée')
                            <span class="badge bg-success">Validée</span>
                        @elseif($commande->statut == 'en attente')
                            <span class="badge bg-warning text-dark">En attente</span>
                        @elseif($commande->statut == 'annulée')
                            <span class="badge bg-danger">Échouée</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($commande->statut) }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('commande.details', $commande->id) }}" class="btn btn-sm btn-info">Voir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune commande passée pour le moment.</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des commandes</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Client</th>
                <th>Date</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($commandes as $commande)
                <tr>
                    <td>{{ $commande->user->nom ?? 'Client supprimé' }} {{ $commande->user->prenom ?? 'Client supprimé' }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->montant_calcule, 0, ',', ' ') }} F</td>
                   <td>
    <select class="form-select statut-select"
        data-id="{{ $commande->id }}">
        <option value="en attente" {{ $commande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
        <option value="validée" {{ $commande->statut == 'validée' ? 'selected' : '' }}>Validée</option>
        <option value="livrée" {{ $commande->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
        <option value="annulée" {{ $commande->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
    </select>
</td>

                    <td>
                        <a href="{{ route('commande.details', $commande->id) }}" class="btn btn-sm btn-info">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune commande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.statut-select').forEach(select => {
        select.addEventListener('change', function () {
            const id = this.dataset.id;
            const statut = this.value;

            fetch(`/admin/commandes/${id}/statut`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ statut })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert("Erreur lors de la mise à jour.");
                }
            })
            .catch(() => alert("Erreur réseau."));
        });
    });
});
</script>
@endsection

@endsection

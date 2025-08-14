@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tableau de bord - Administration</h1>

        <!-- Cartes de statistiques -->
        <div class="row mb-4">
            <!-- Carte Clients -->
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Clients</h5>
                                <p class="fs-3 mb-0">{{ $clientsCount }}</p>
                            </div>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                        <a href="{{ route('client.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Carte Produits -->
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-success shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Produits</h5>
                                <p class="fs-3 mb-0">{{ $produitsCount }}</p>
                            </div>
                            <i class="fas fa-boxes fa-2x opacity-50"></i>
                        </div>
                        <a href="{{ route('produits.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
<!-- Carte Commandes -->
<div class="col-md-3 mb-3">
    <div class="card text-white bg-warning shadow h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Commandes</h5>
                    <p class="fs-3 mb-0">{{ $commandesCount }}</p>
                </div>
                <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
            </div>
            <a href="{{ route('commandes.index') }}" class="stretched-link"></a>
        </div>
    </div>
</div>

<!-- Carte Admins -->
<div class="col-md-3 mb-3">
    <div class="card text-white bg-secondary shadow h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Admins</h5>
                    <p class="fs-3 mb-0">{{ $adminsCount }}</p>
                </div>
                <i class="fas fa-user-shield fa-2x opacity-50"></i>
            </div>
            <a href="{{ route('superadmin.admins') }}" class="stretched-link"></a>
        </div>
    </div>
</div>

<!-- Carte Seuil -->
<div class="col-md-3 mb-3">
    <div class="card text-white bg-info shadow h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Montant Seuil</h5>
                </div>
                <i class="fas fa-balance-scale fa-2x opacity-50"></i>
            </div>
            <a href="{{ route('admin.configuration.index') }}" class="stretched-link"></a>
        </div>
    </div>
</div>

<!-- Carte INFO -->
<div class="col-md-3 mb-3">
    <div class="card text-white bg-secondary shadow h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">INFO</h5>
                </div>
                <i class="fas fa-info-circle fa-2x opacity-50"></i>
            </div>
            <a href="{{ route('admin.informations.edit') }}" class="stretched-link"></a>
        </div>
    </div>
</div>

<!-- Carte Ventes -->
<div class="col-md-3 mb-3">
    <div class="card text-white bg-danger shadow h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Total des ventes</h5>
                    <p class="fs-3 mb-0">{{ number_format($totalVentes, 0, ',', ' ') }} F</p>
                </div>
                <i class="fas fa-chart-line fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
</div>
<!-- Carte Statistiques -->
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-danger shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('admin.statistiques') }}" class="btn btn-primary mt-3">
                                    📊 Voir les Statistiques
                                </a>

                            </div>
                            <i class="fas fa-chart-line fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Section Commandes récentes -->
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Commandes récentes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commandesRecentes as $commande)
                                <tr>
                                    <td>
                                        @if ($commande->user)
                                            {{ $commande->user->nom }} {{ $commande->user->prenom }}
                                            @if (isset($commande->user->deleted_at))
                                                <span class="badge bg-secondary">Compte inactif</span>
                                            @endif
                                        @else
                                            <span class="text-muted">Client non enregistré</span>
                                        @endif
                                    </td>
                                    <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="fw-bold">{{ number_format($commande->total, 0, ',', ' ') }} F</td>
                                    <td>
                                        <span
                                            class="badge 
                                        @if ($commande->statut == 'validée') bg-success
                                        @elseif($commande->statut == 'annulée') bg-danger
                                        @elseif($commande->statut == 'en attente') bg-warning text-dark
                                        @else bg-info text-dark @endif">
                                            {{ ucfirst($commande->statut) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('commande.details', $commande->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>

                                            @if ($commande->statut === 'en attente')
                                                <button class="btn btn-sm btn-success statut-btn"
                                                    data-id="{{ $commande->id }}" data-statut="validée"
                                                    data-url="{{ route('commande.statut', $commande->id) }}">
                                                    <i class="fas fa-check"></i> Valider
                                                </button>

                                                <button class="btn btn-sm btn-danger btn-rejeter"
                                                    data-id="{{ $commande->id }}"
                                                    data-url="{{ route('commande.statut', $commande->id) }}">
                                                    <i class="fas fa-times"></i> Rejeter
                                                </button>
                                            @endif

                                            @if ($commande->statut !== 'annulée')
                                                <button class="btn btn-sm btn-warning statut-btn"
                                                    data-id="{{ $commande->id }}" data-statut="annulée"
                                                    data-url="{{ route('commande.statut', $commande->id) }}">
                                                    <i class="fas fa-ban"></i> Annuler
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Aucune commande récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Raison Rejet -->
    <div class="modal fade" id="rejetModal" tabindex="-1" aria-labelledby="rejetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="rejetForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Motif du rejet de la commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="commandeIdRejet">
                    <input type="hidden" id="commandeUrlRejet">
                    <div class="mb-3">
                        <label for="raison" class="form-label">Motif</label>
                        <textarea class="form-control" id="raison" name="raison" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Rejeter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Boutons simples (valider / annuler)
                console.log("Script chargé !");
                document.querySelectorAll('.statut-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const commandeId = this.dataset.id;
                        const statut = this.dataset.statut;

                        fetch(`/admin/commandes/${commandeId}/statut`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    statut
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) location.reload();
                                else alert(data.message || 'Erreur');
                            });
                    });
                });

                // Bouton "rejeter" ouvre la modale
                document.querySelectorAll('.btn-rejeter').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.getElementById('commandeIdRejet').value = this.dataset.id;
                        document.getElementById('raison').value = '';
                        new bootstrap.Modal(document.getElementById('rejetModal')).show();
                    });
                });

                // Formulaire de rejet
                document.getElementById('rejetForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const id = document.getElementById('commandeIdRejet').value;
                    const raison = document.getElementById('raison').value;

                    fetch(`/admin/commandes/${id}/statut`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                statut: 'annulée',
                                raison
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) location.reload();
                            else alert(data.message || 'Erreur');
                        });
                });
            });
        </script>
    @endsection

    </div>

    <!-- CSS additionnel -->
    <style>
        .badge {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
            min-width: 120px;
            display: inline-block;
            text-align: center;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .badge {
            font-size: 0.85em;
            padding: 0.35em 0.65em;
        }
        .site-header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      background: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 15px 0;
    }
    </style>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Script chargé !");

            document.querySelectorAll('.statut-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const url = this.dataset.url;
                    const statut = this.dataset.statut;

                    fetch(url, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                statut
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) location.reload();
                            else alert(data.message || 'Erreur lors de la mise à jour.');
                        })
                        .catch(() => alert("Erreur réseau."));
                });
            });

            document.querySelectorAll('.btn-rejeter').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('commandeIdRejet').value = this.dataset.id;
                    document.getElementById('commandeUrlRejet').value = this.dataset.url;
                    document.getElementById('raison').value = '';
                    new bootstrap.Modal(document.getElementById('rejetModal')).show();
                });
            });

            document.getElementById('rejetForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('commandeIdRejet').value;
                const url = document.getElementById('commandeUrlRejet').value;
                const raison = document.getElementById('raison').value;

                fetch(url, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            statut: 'annulée',
                            raison: raison
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) location.reload();
                        else alert(data.message || 'Erreur lors du rejet.');
                    })
                    .catch(() => alert("Erreur réseau."));
            });
        });
    </script>
@endpush

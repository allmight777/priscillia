@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Gestion des comptes administrateurs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admin->nom }}</td>
                    <td>{{ $admin->prenom }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ ucfirst($admin->statut) }}</td>
                    <td>
                        @if($admin->statut === 'en attente')
                            <form method="POST" action="{{ route('admin.valider', $admin->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Valider</button>
                            </form>
                            <form method="POST" action="{{ route('admin.rejeter', $admin->id) }}" class="d-inline" onsubmit="return confirm('Supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Rejeter</button>
                            </form>
                        @elseif($admin->statut === 'actif')
                            <form method="POST" action="{{ route('admin.desactiver', $admin->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-warning btn-sm">Désactiver</button>
                            </form>
                        @elseif($admin->statut === 'désactivé')
                            <form method="POST" action="{{ route('admin.valider', $admin->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-primary btn-sm">Réactiver</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Aucun administrateur trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Horaires d'ouverture</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulaire d'ajout -->
    <form action="{{ route('admin.horaires.store') }}" method="POST" class="row g-3 mb-4">
        @csrf
        <div class="col-md-3">
            <input type="text" name="jour" class="form-control" placeholder="Ex : Lundi - Vendredi" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="heure_ouverture" class="form-control" placeholder="Ex : 07:00" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="heure_fermeture" class="form-control" placeholder="Ex : 18:00" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Ajouter</button>
        </div>
    </form>

    <!-- Liste des horaires -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Ouverture</th>
                <th>Fermeture</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($horaires as $horaire)
                <tr>
                    <td>{{ $horaire->jour }}</td>
                    <td>{{ $horaire->heure_ouverture }}</td>
                    <td>{{ $horaire->heure_fermeture }}</td>
                    <td>
                        <form action="{{ route('admin.horaires.destroy', $horaire->id) }}" method="POST" onsubmit="return confirm('Supprimer cet horaire ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Aucun horaire défini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

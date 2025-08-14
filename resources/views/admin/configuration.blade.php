@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Paramètres de Commande</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.configuration.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="seuil_commande" class="form-label">Seuil de commande (F)</label>
            <input type="number" name="seuil_commande" class="form-control" value="{{ old('seuil_commande', $seuil) }}">
        </div>

        <div class="mb-3">
            <label for="pourcentage_avance" class="form-label">Pourcentage d'avance (%)</label>
            <input type="number" name="pourcentage_avance" class="form-control" value="{{ old('pourcentage_avance', $pourcentage) }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection

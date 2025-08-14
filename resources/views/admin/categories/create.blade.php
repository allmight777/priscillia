@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une catégorie</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

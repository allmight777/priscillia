@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la catégorie</h1>

    <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom" class="form-control" value="{{ $categorie->nom }}" required>
            <label for="prix" class="form-label">Prix de la catégorie</label>
            <input type="text" name="prix" class="form-control" value="{{ $categorie->prix }}" required>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection

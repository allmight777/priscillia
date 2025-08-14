@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des catégories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Ajouter une catégorie</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $categorie)
            <tr>
                <td>{{ $categorie->nom }}</td>
                <td>
                    <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</button>
                    </form>
                    <a href="{{ route('produits.categorie', $categorie->id) }}" class="btn btn-info btn-sm">Voir Produits</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

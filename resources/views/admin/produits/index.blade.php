@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Produits</h1>

    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td>{{ number_format($produit->prix, 0, ',', ' ') }} F</td>
                <td>{{ $produit->categorie->nom ?? 'Non défini' }}</td>
                <td>
                    <a href="{{ route('produits.edit', $produit) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('produits.destroy', $produit) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Supprimer ce produit ?')" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

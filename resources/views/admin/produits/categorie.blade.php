@extends('layouts.app')

@section('content')
<div class="container">
    
    <h2 class="mb-4">Gestion des catégories</h2>

    <div class="row">
        <!-- Section des catégories existantes -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Catégories existantes</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($categories as $categorie)
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $categorie->nom }}</h5>
                                        <a href="{{ route('produits.categorie', $categorie->id) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            Voir les produits
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Section de gestion des catégories -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Gestion des catégories</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('categories.create') }}" 
                           class="btn btn-success">
                            <i class="fas fa-plus"></i> Créer une nouvelle catégorie
                        </a>
                        <a href="{{ route('categories.index') }}" 
                           class="btn btn-info">
                            <i class="fas fa-cog"></i> Gérer toutes les catégories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
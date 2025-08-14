@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Produits de la catégorie : {{ $categorie->nom }}</h2>

        <a href="{{ route('produits.index') }}" class="btn btn-secondary mb-4">
            ← Retour aux catégories
        </a>

        <div class="row">
            @forelse($produits as $produit)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm produit-card">
                        <!-- Conteneur d'image avec ratio 4:3 -->
                        <div class="image-wrapper ratio ratio-4x3 bg-light" style="overflow: hidden;">
                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}"
                                class="w-100 h-100 object-fit-cover transition-transform"
                                style="transition: transform 0.3s ease;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div>
                                <h5 class="card-title">{{ $produit->nom }}</h5>
                                <p class="card-text">Prix : {{ number_format($produit->prix, 0, ',', ' ') }} F</p>
                            </div>

                            <div class="mt-auto pt-3">
                                <div class="d-flex justify-content-between gap-2">
                                    <a href="{{ route('produits.edit', $produit->id) }}"
                                        class="btn btn-warning btn-sm flex-grow-1">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST"
                                        class="flex-grow-1" onsubmit="return confirm('Confirmer la suppression ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-trash me-1"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Aucun produit dans cette catégorie.</div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('produits.create', $categorie->id) }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus me-2"></i>Ajouter un produit
            </a>
        </div>
    </div>

    @push('styles')
        <style>
            /* Styles globaux de la carte */
            .produit-card {
                transition: all 0.3s ease;
                border-radius: 0.5rem;
                overflow: hidden;
                border: 1px solid rgba(0, 0, 0, 0.1);
            }

            /* Effet au survol */
            .produit-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
                border-color: rgba(0, 0, 0, 0.2);
            }

            .image-wrapper {
                position: relative;
                background: #f8f9fa;
            }

            .object-fit-cover {
                object-fit: cover;
                object-position: center;
            }

            /* Effet zoom au survol */
            .produit-card:hover .object-fit-cover {
                transform: scale(1.05);
            }

            /* Pour les très grandes images */
            .image-wrapper img {
                min-width: 100%;
                min-height: 100%;
            }

            /* Adaptation mobile */
            @media (max-width: 768px) {
                .card-title {
                    font-size: 1rem;
                }

                .card-text {
                    font-size: 0.9rem;
                }
            }

            /* Boutons responsive */
            @media (max-width: 576px) {
                .btn-sm {
                    padding: 0.25rem 0.5rem;
                    font-size: 0.8rem;
                }
            }
        </style>
    @endpush
@endsection

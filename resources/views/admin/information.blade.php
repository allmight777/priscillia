@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Titre -->
            <div class="mb-4 text-center">
                <h2 class="fw-bold text-primary">Modifier les Informations de Contact</h2>
                <p class="text-muted">Mettez à jour l'adresse, l'email ou le téléphone de votre poissonnerie.</p>
            </div>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <!-- Formulaire -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.informations.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Adresse Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $info->email) }}" required>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label fw-bold">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control"
                                value="{{ old('telephone', $info->telephone) }}" required>
                            @error('telephone') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label fw-bold">Adresse</label>
                            <input type="text" name="adresse" id="adresse" class="form-control"
                                value="{{ old('adresse', $info->adresse) }}" required>
                            @error('adresse') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lien vers les horaires -->
            <div class="mt-5">
                <div class="card bg-info text-white shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title fw-bold mb-1">Horaires d'ouverture</h5>
                            <p class="mb-0">Consultez ou modifiez les horaires d'ouverture de la boutique.</p>
                        </div>
                        <a href="{{ route('admin.horaires.index') }}" class="btn btn-light">Voir les horaires</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

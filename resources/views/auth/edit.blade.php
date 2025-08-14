@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier mon compte</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('compte.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}" class="form-control">
            @error('nom') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $user->prenom) }}" class="form-control">
            @error('prenom') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection

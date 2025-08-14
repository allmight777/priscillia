@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Créer un compte</h2>

    <!-- Nom -->
    <div>
        <label for="nom" class="block text-gray-600 mb-1">Nom</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required autofocus
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('nom')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Prénom -->
    <div>
        <label for="prenom" class="block text-gray-600 mb-1">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('prenom')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Téléphone -->
    <div>
        <label for="telephone" class="block text-gray-600 mb-1">Téléphone</label>
        <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('telephone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Adresse -->
    <div>
        <label for="adresse" class="block text-gray-600 mb-1">Adresse</label>
        <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('adresse')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-gray-600 mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Role -->
    <div>
        <label for="role" class="block text-gray-600 mb-1">Rôle</label>
        <select name="role" id="role" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (validation requise)</option>
        </select>
        @error('role')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Mot de passe -->
    <div>
        <label for="password" class="block text-gray-600 mb-1">Mot de passe</label>
        <input type="password" name="password" id="password" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirmation mot de passe -->
    <div>
        <label for="password_confirmation" class="block text-gray-600 mb-1">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        @error('password_confirmation')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition">
            S'inscrire
        </button>
    </div>

    <p class="text-center text-sm text-gray-600 mt-4">
        Déjà inscrit ? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Se connecter</a>
    </p>
</form>
<style>
    body {
    background: linear-gradient(90deg, #3b82f6 0%, #ecf0f1 50%, #575f5a 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

    .form-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 420px;
        padding: 30px;
    }
    form h2 {
        text-align: center;
        margin-bottom: 24px;
        color: #374151;
        font-size: 1.8rem;
        font-weight: 700;
    }
    label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #4b5563;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px 14px;
        margin-bottom: 16px;
        border: 1.5px solid #d1d5db;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 5px #3b82f6;
    }
    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: -12px;
        margin-bottom: 12px;
    }
    button[type="submit"] {
        background-color: #3b82f6;
        color: white;
        width: 100%;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
        background-color: #2563eb;
    }
    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #6b7280;
        font-size: 0.9rem;
    }
    .login-link a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
</style>

@endsection

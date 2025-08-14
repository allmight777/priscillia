@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>Connexion</h2>

    @if(session('status'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div style="color:red; font-size: 0.85rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div style="color:red; font-size: 0.85rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Se souvenir -->
        <div>
            <label>
                <input type="checkbox" name="remember"> Se souvenir de moi
            </label>
        </div>

        <!-- Soumettre -->
        <div style="margin-top: 20px;">
            <button type="submit">Se connecter</button>
        </div>
    </form>

    <div class="bottom-links">
        @if (Route::has('password.request'))
            <p><a href="{{ route('password.request') }}">Mot de passe oublié ?</a></p>
        @endif
        <p>Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></p>
    </div>
</div>
    <style>
        body {
            background: linear-gradient(to right, #3b82f6, #ecf0f1, #22c55e);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        input[type="checkbox"] {
            margin-right: 6px;
        }

        button {
            background-color: #3b82f6;
            color: white;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2563eb;
        }

        .bottom-links {
            text-align: center;
            margin-top: 16px;
            font-size: 0.9rem;
        }

        .bottom-links a {
            color: #3b82f6;
            text-decoration: none;
        }

        .bottom-links a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

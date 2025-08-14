@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Bienvenue, {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Informations de votre compte</h5>
            <p><strong>Nom :</strong> {{ Auth::user()->nom }}</p>
            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
            <p><strong>Rôle :</strong> {{ Auth::user()->role }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Actions disponibles</h5>
            <ul>
                <li><a href="{{ route('commandes.mes') }}">📦 Mes commandes</a></li>
                <li><a href="{{ route('client.produits.index') }}">🛍️ Voir les produits</a></li>
                <li><a href="{{ route('panier.index') }}">🛒 Mon panier</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-2">🚪 Se déconnecter</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
<style>
body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container {
    max-width: 900px;
    margin: auto;
}

.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-4px);
}

.card-body h5 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #007bff;
}

ul {
    list-style: none;
    padding-left: 0;
}

ul li {
    margin: 12px 0;
}

ul li a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: color 0.2s ease;
}

ul li a:hover {
    color: #007bff;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}
</style>
<script>
    document.querySelectorAll('ul li a').forEach(link => {
        link.addEventListener('mouseenter', () => {
            link.style.fontWeight = 'bold';
        });
        link.addEventListener('mouseleave', () => {
            link.style.fontWeight = '500';
        });
    });
</script>

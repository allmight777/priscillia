@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des clients</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d’inscription</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->nom }} {{ $client->prenom}}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucun client trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

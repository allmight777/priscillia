@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Administrateurs en attente de validation</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingAdmins as $admin)
            <tr>
                <td>{{ $admin->nom }} {{ $admin->prenom }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.approve', $admin->id) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Approuver</button>
                    </form>
                    <form action="{{ route('admin.reject', $admin->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Rejeter</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
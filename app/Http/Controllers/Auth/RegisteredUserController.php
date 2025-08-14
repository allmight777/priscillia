<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  /* public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:client,admin'],
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
    ]);

    // Définir le statut en fonction du rôle
    $statut = $request->role === 'admin' ? 'en attente' : 'actif';

    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'statut' => $statut,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    event(new Registered($user));

    // Si le statut est actif, on connecte l'utilisateur directement
    if ($user->statut === 'actif') {
        Auth::login($user);
        return redirect()->route('login')->with('success', 'Inscription réussie.');
    }

    // Sinon, rediriger vers login avec message
    return redirect()->route('login')->with('info', 'Votre inscription est en attente de validation par l’administrateur principal.');
}*/
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:client,admin'],
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
    ]);

    // Définir le statut: actif pour les clients, en attente pour les admins
    $statut = $request->role === 'client' ? 'actif' : 'en attente';

    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'statut' => $statut,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    event(new Registered($user));

    // Redirection différente selon le statut
    if ($user->statut === 'actif') {
        Auth::login($user);
        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'client.dashboard')
               ->with('success', 'Inscription réussie. Bienvenue!');
    }

    return redirect()->route('login')
           ->with('info', 'Votre compte est en attente de validation par l\'administrateur principal.');
}

}

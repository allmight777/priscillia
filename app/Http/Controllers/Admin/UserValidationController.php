<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserValidationController extends Controller
{
    public function index()
    {
        $adminsEnAttente = User::where('role', 'admin')->where('statut', 'en_attente')->get();
        return view('admin.validation', compact('adminsEnAttente'));
    }

    public function valider($id)
    {
        $user = User::findOrFail($id);
        $user->update(['statut' => 'actif']);
        return redirect()->back()->with('success', 'Compte activé avec succès.');
    }

    public function refuser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('error', 'Compte supprimé.');
    }
}


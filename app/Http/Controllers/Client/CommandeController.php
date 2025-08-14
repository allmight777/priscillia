<?php

namespace App\Http\Controllers\Client;

use FedaPay\FedaPay;
use FedaPay\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\Configuration;
use App\Notifications\CommandeRejeteeNotification;

class CommandeController extends Controller
{
    /*public function valide()
    {
        $panier = session()->get('panier', []);
        if (empty($panier)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        $total = array_sum(array_column($panier, 'sous_total'));
        $seuil = Configuration::getValeur('seuil_commande', 10000);
        $pourcentage = Configuration::getValeur('pourcentage_avance', 75);

        $avance = 0;
        $statut = 'validée';

        if ($total >= $seuil) {
            $statut = 'en attente';
            $avance = round(($pourcentage / 100) * $total);
        }

        // Enregistrement de la commande avec les produits en JSON
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'avance' => $avance,
            'statut' => $statut,
            'produits' => $panier, 
        ]);

        // Enregistrement dans la table pivot
        foreach ($panier as $item) {
            $commande->produits()->attach($item['id'], [
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
            ]);
        }

        session()->forget('panier');

        if ($statut === 'en attente ) {
            return view('client.panier.commandes.valider', compact('commande', 'avance', 'pourcentage', 'total', 'seuil'));
        }

        return redirect()->route('commandes.mes')->with('success', 'Commande validée.');
    }*/
    

    public function confirmer(Request $request)
    {
        return redirect()->route('commandes.mes')->with('success', 'Commande confirmée.');
    }

    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', Auth::id())->latest()->get();
        return view('client.panier.commandes.index', compact('commandes'));
    }

    public function details($id)
    {
        $commande = Commande::with('produits')->findOrFail($id);
        return view('client.panier.commandes.details', compact('commande'));
    }

   /* public function updateStatut(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->statut = $request->input('statut');
        $commande->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }*/

    public function index()
    {
       $commandes = Commande::with('user')->latest()->get();
       return view('admin.commande', compact('commandes'));
    }

/*  public function valider()
{
    $panier = session()->get('panier', []);
    if (empty($panier)) {
        return back()->with('error', 'Panier vide.');
    }

    $total = array_sum(array_column($panier, 'sous_total'));
    $seuil = Configuration::getValeur('seuil_commande', 1000);
    $pourcentage = Configuration::getValeur('pourcentage_avance', 75);
    $avance = 0;
    $statut = 'validée';

    if ($total >= $seuil) {
        $statut = 'en attente';
        $avance = round(($pourcentage / 100) * $total);
    }

    $commande = Commande::create([
        'user_id' => Auth::id(),
        'total' => $total,
        'avance' => $avance,
        'statut' => $statut,
        'produits' => $panier,
    ]);

    foreach ($panier as $item) {
        $commande->produits()->attach($item['id'], [
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix'],
        ]);
    }

    session()->forget('panier');

    // SIMULATION de FedaPay 
    if ($statut === 'en attente') {
        // Simulation : on redirige simplement vers la page de confirmation
        return redirect()->route('fedapay.callback', $commande->id)
                         ->with('info', 'Paiement simulé : compte FedaPay non validé.');
    }

    return redirect()->route('commandes.mes')->with('success', 'Commande validée.');
}*/
  
public function changerStatut(Request $request, $id)
{
    $commande = \App\Models\Commande::with('user')->findOrFail($id);

    $statut = $request->statut;
    $raison = $request->raison ?? null;

    $statutsAutorises = ['validée', 'annulée', 'en attente'];
    if (!in_array($statut, $statutsAutorises)) {
        return response()->json(['success' => false, 'message' => 'Statut invalide.'], 400);
    }

    $commande->statut = $statut;
    $commande->save();

    if ($statut === 'annulée' && $commande->user && $commande->user->email) {
        $commande->user->notify(new CommandeRejeteeNotification($commande, $raison));
    }

    return response()->json(['success' => true]);
}


/*public function valider()
{
    $panier = session()->get('panier', []);
    if (empty($panier)) {
        return back()->with('error', 'Panier vide.');
    }

    $total = array_sum(array_column($panier, 'sous_total'));
    $seuil = Configuration::getValeur('seuil_commande', 1000);
    $pourcentage = Configuration::getValeur('pourcentage_avance', 75);
    $avance = 0;
    $statut = 'validée';

    if ($total >= $seuil) {
        $statut = 'en attente';
        $avance = round(($pourcentage / 100) * $total);
    }

    $commande = Commande::create([
        'user_id' => Auth::id(),
        'total' => $total,
        'avance' => $avance,
        'statut' => $statut,
        'produits' => $panier,
    ]);

    foreach ($panier as $item) {
        $commande->produits()->attach($item['id'], [
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix'],
        ]);
    }

    session()->forget('panier');

    if ($statut === 'en attente') {
        // Redirection vers FedaPay
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        $user = Auth::user();

        $transaction = Transaction::create([
            'description' => 'Commande #' . $commande->id,
            'amount' => $avance,
            'currency' => ['iso' => 'XOF'],
            'callback_url' => route('fedapay.callback', $commande->id),
            'customer' => [
                'firstname' => $user->prenom,
                'lastname' => $user->nom,
                'email' => $user->email,
                'phone_number' => [
                    'number' => ltrim($user->telephone, '+229'),
                    'country' => 'BJ'
                ]

            ]
        ]);

        return redirect($transaction->url);
    }

    return redirect()->route('commandes.mes')->with('success', 'Commande validée.');
}
public function fedapayCallback($id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = 'validée';
    $commande->save();

    return redirect()->route('commandes.mes')->with('success', 'Paiement réussi. Commande confirmée.');
}
    public function valider()
{
    $panier = session()->get('panier', []);
    if (empty($panier)) {
        return back()->with('error', 'Panier vide.');
    }

    $total = array_sum(array_column($panier, 'sous_total'));
    $seuil = Configuration::getValeur('seuil_commande', 1000);
    $pourcentage = Configuration::getValeur('pourcentage_avance', 75);

    // Si le total dépasse le seuil => paiement obligatoire
    if ($total > $seuil) {
        $avance = round(($pourcentage / 100) * $total);

        // On stocke dans la session pour le paiement
        session()->put('commande_en_attente', [
            'user_id' => Auth::id(),
            'total' => $total,
            'avance' => $avance,
            'produits' => $panier,
        ]);

        // Redirection vers FedaPay
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        $user = Auth::user();

        $transaction = Transaction::create([
            'description' => 'Commande en attente de paiement',
            'amount' => $avance,
            'currency' => ['iso' => 'XOF'],
            'callback_url' => route('fedapay.callback'),
            'customer' => [
                'firstname' => $user->prenom,
                'lastname' => $user->nom,
                'email' => $user->email,
                'phone_number' => [
                    'number' => ltrim($user->telephone, '+229'),
                    'country' => 'BJ'
                ]
            ]
        ]);

        return redirect($transaction->url);

    } else {
        // Total <= seuil => pas besoin de paiement
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'avance' => 0,
            'statut' => 'validée',
            'produits' => $panier,
        ]);

        foreach ($panier as $item) {
            $commande->produits()->attach($item['id'], [
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
            ]);
        }

        session()->forget('panier');

        return redirect()->route('commandes.mes')->with('success', 'Commande validée.');
    }
}*/
public function valider()
{
    $panier = session()->get('panier', []);
    if (empty($panier)) {
        return back()->with('error', 'Panier vide.');
    }

    $total = array_sum(array_column($panier, 'sous_total'));
    $seuil = Configuration::getValeur('seuil_commande', 1000);
    $pourcentage = Configuration::getValeur('pourcentage_avance', 75);

    if ($total > $seuil) {
        $avance = round(($pourcentage / 100) * $total);

        // Créer la commande en attente AVANT paiement
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'avance' => $avance,
            'statut' => 'en attente',
            'produits' => $panier,
        ]);

        foreach ($panier as $item) {
            $commande->produits()->attach($item['id'], [
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
            ]);
        }

        // Lancer le paiement avec callback URL contenant l'id commande
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.env'));

        $user = Auth::user();

        $transaction = Transaction::create([
            'description' => 'Commande #' . $commande->id,
            'amount' => $avance,
            'currency' => ['iso' => 'XOF'],
            'callback_url' => route('fedapay.callback', ['id' => $commande->id]),
            'customer' => [
                'firstname' => $user->prenom,
                'lastname' => $user->nom,
                'email' => $user->email,
                'phone_number' => [
                    'number' => ltrim($user->telephone, '+229'),
                    'country' => 'BJ'
                ]
            ]
        ]);

        session()->forget('panier');

        return redirect($transaction->url);

    } else {
        // Pas besoin de paiement, création directe commande validée
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'avance' => 0,
            'statut' => 'validée',
            'produits' => $panier,
        ]);

        foreach ($panier as $item) {
            $commande->produits()->attach($item['id'], [
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
            ]);
        }

        session()->forget('panier');

        return redirect()->route('commandes.mes')->with('success', 'Commande validée.');
    }
}

public function fedapayCallback()
{
    // On récupère la commande en attente dans la session
    $data = session()->get('commande_en_attente');

    if (!$data) {
        return redirect()->route('panier.index')->with('error', 'Aucune commande en attente.');
    }

    // Ici tu peux vérifier avec FedaPay si le paiement est bien confirmé
    // (vérification de transaction selon la doc FedaPay)

    // Création de la commande en base après paiement réussi
    $commande = Commande::create([
        'user_id' => $data['user_id'],
        'total' => $data['total'],
        'avance' => $data['avance'],
        'statut' => 'validée',
        'produits' => $data['produits'],
    ]);

    foreach ($data['produits'] as $item) {
        $commande->produits()->attach($item['id'], [
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix'],
        ]);
    }

    // On vide le panier et la commande en attente
    session()->forget(['panier', 'commande_en_attente']);

    return redirect()->route('commandes.mes')->with('success', 'Paiement réussi. Commande confirmée.');
}

public function show($id)
    {
        $commande = Commande::with('produits')->findOrFail($id);
        return view('client.panier.commandes.details', compact('commande'));
    }

}

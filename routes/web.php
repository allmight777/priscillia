<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserValidationController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\PanierController;
use App\Http\Controllers\Client\CommandeController;

use App\Http\Controllers\ModifieController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\HoraireController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/healthz', function () {
    return response()->json(['status' => 'ok']);
});


// Authentification requise
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard1', [AdminController::class, 'dashboard1'])->name('admin.dashboard1');
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

    // Produits côté client
    Route::get('/produits', [\App\Http\Controllers\Client\ProduitController::class, 'index'])->name('client.produits.index');
    Route::get('/produits/{id}', [\App\Http\Controllers\Client\ProduitController::class, 'show'])->name('client.produits.show');

    // Panier
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::delete('/panier/retirer/{id}', [PanierController::class, 'retirer'])->name('panier.retirer');
    Route::post('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');

    // Commandes
    Route::get('/commande/valider', [CommandeController::class, 'valider'])->name('commande.valider');
    Route::post('/commande/confirmer', [CommandeController::class, 'confirmer'])->name('commande.confirmer');
    Route::get('/commandes', [CommandeController::class, 'mesCommandes'])->name('commandes.mes');
    Route::get('/commandes/{id}', [CommandeController::class, 'details'])->name('commande.details');

    Route::get('/fedapay/callback', [CommandeController::class, 'fedapayCallback'])->name('fedapay.callback');
        Route::get('/mon-compte', [ModifieController::class, 'edit'])->name('compte.edit');
    Route::put('/mon-compte', [ModifieController::class, 'update'])->name('compte.update');
});

// Admin uniquement
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('categories', CategorieController::class)->except(['show']);

    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/categorie/{id}', [ProduitController::class, 'afficherProduits'])->name('produits.categorie');
    Route::get('/produits/create/{categorie_id}', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');

    Route::get('/configuration', [ConfigurationController::class, 'index'])->name('admin.configuration.index');
    Route::put('/configuration', [ConfigurationController::class, 'update'])->name('admin.configuration.update');

    Route::get('/validation/utilisateurs', [UserValidationController::class, 'index'])->name('admin.utilisateurs.validation');
    Route::put('/validation/utilisateurs/{id}', [UserValidationController::class, 'valider'])->name('admin.utilisateurs.valider');
    Route::delete('/validation/utilisateurs/{id}', [UserValidationController::class, 'refuser'])->name('admin.utilisateurs.refuser');

    Route::get('/clients', [AdminController::class, 'index'])->name('client.index');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::put('/commandes/{id}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.updateStatut');
    Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');

    Route::get('/admin/informations', [InformationController::class, 'edit'])->name('admin.informations.edit');
    Route::put('/admin/informations', [InformationController::class, 'update'])->name('admin.informations.update');
    Route::get('/admin/horaires', [HoraireController::class, 'index'])->name('admin.horaires.index');
    Route::post('/admin/horaires', [HoraireController::class, 'store'])->name('admin.horaires.store');
    Route::delete('/admin/horaires/{id}', [HoraireController::class, 'destroy'])->name('admin.horaires.destroy');

    Route::get('/admin/statistiques', [AdminController::class, 'statistiques'])->name('admin.statistiques');


});

// Accessible uniquement au super admin (id == 1)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/gestion-admins', [AdminController::class, 'inde'])->name('superadmin.admins');
    Route::post('/admin/admins/{id}/valider', [AdminController::class, 'valider'])->name('admin.valider');
    Route::post('/admin/admins/{id}/desactiver', [AdminController::class, 'desactiver'])->name('admin.desactiver');
    Route::delete('/admin/admins/{id}', [AdminController::class, 'rejeter'])->name('admin.rejeter');

});

Route::put('/admin/commandes/{id}/statut', [CommandeController::class, 'changerStatut'])->name('commande.statut');

require __DIR__.'/auth.php';

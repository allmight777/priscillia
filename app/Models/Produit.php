<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['nom', 'description', 'prix', 'image', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
            ->withPivot('quantite', 'prix_unitaire')
            ->withTimestamps();
    }

}

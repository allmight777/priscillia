<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'avance',
        'statut',
        'produits',
    ];

    protected $casts = [
        'produits' => 'array', // Auto JSON encode/decode
    ];

   /* public function user()
    {
        return $this->belongsTo(User::class);
    }*/

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
            ->withPivot('quantite', 'prix_unitaire')
            ->withTimestamps();
    }
    public function user()
{
    return $this->belongsTo(User::class)->withTrashed(); 
}
    public function getMontantCalculeAttribute()
    {
        return collect($this->produits)->sum(fn($p) => $p['sous_total']);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeProduit extends Model
{
    use HasFactory;

    protected $table = 'commande_produit';

    protected $fillable = [
        'commande_id', 'produit_id', 'quantite', 'prix_unitaire'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
        public function user()
{
    return $this->belongsTo(User::class)->withTrashed(); 
}
}


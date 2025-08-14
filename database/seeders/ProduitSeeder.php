<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Produit::create([
        'nom' => 'Tilapia',
        'description' => 'Tilapia frais du jour',
        'prix' => 1500,
        'image' => 'produits/tilapia.jpg',
        'categorie_id' => 13
        ]);

        Produit::create([
        'nom' => 'Viande de boeuf',
        'description' => 'Viande de qualité',
        'prix' => 3000,
        'image' => 'produits/tilapia.jpg',
        'categorie_id' => 14
        ]);
    }
}

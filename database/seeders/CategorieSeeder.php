<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;


class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Categorie::create(['nom' => 'Poissons']);
        Categorie::create(['nom' => 'Viandes']);
        Categorie::create(['nom' => 'Fruit de mer']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom' => 'Admin',
            'prenom' => 'Principal',
            'telephone' => '00000000',
            'adresse' => 'Administration',
            'email' => 'admin@poissonnerie.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'statut' => 'actif',
        ]);
    }
}

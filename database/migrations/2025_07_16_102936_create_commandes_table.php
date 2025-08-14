<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->json('produits')->nullable(); 
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('avance', 10, 2)->default(0);
            $table->enum('statut', ['en attente', 'annulée', 'validée','livrée'])->default('en attente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};

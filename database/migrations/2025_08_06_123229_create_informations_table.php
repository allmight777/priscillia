<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('jours_ouverture')->nullable();     // ex: Lundi - Vendredi
            $table->string('heures_ouverture')->nullable();    // ex: 8h - 17h
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informations');
    }
};

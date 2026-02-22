<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //Crée la colonne qui relie à la table users
            $table->foreignId('temoignage_id')->constrained('temoignages')->onDelete('cascade');
            //Crée la colonne qui relie à la table temoignages
            $table->timestamps();
            $table->unique(['user_id', 'temoignage_id']);
            //Empêche qu'un utilisateur like 2 fois le même témoignage
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};

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
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->String('designationEquipement');
            $table->String('etatEquipement');
            $table->String('NserieEquipement');
            $table->String('nImmoEquipement');
            $table->String('autreSpecTech');
            $table->enum('Observation', ['Bon état', 'Hors service']);
            $table->date('dateAcc');
            $table->foreignId('poste_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipement');
    }
};

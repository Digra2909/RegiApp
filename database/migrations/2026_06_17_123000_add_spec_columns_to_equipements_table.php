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
        Schema::table('equipements', function (Blueprint $table) {
            $table->string('ram')->nullable()->after('autreSpecTech');
            $table->string('disque_dur')->nullable()->after('ram');
            $table->string('cpu')->nullable()->after('disque_dur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipements', function (Blueprint $table) {
            $table->dropColumn(['ram', 'disque_dur', 'cpu']);
        });
    }
};

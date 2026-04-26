<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_poli', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('master_user')->cascadeOnDelete();
            $table->foreignId('poli_id')->constrained('master_poli')->cascadeOnDelete();

            $table->unique(['user_id', 'poli_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_poli');
    }
};

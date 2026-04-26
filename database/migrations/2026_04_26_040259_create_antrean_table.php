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
        Schema::create('antrean', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poli_id')->constrained('master_poli')->cascadeOnDelete();
            $table->date('antrean_date');

            $table->integer('number'); // 1,2,3
            $table->string('queue_number'); // A001

            $table->foreignId('status_id')->constrained('master_status');

            $table->timestamp('called_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->foreignId('called_by')->nullable()->constrained('master_user');

            $table->timestamps();

            // 🔥 penting banget
            $table->unique(['poli_id', 'antrean_date', 'number']);

            // 🔥 performance
            $table->index(['poli_id', 'antrean_date']);
            $table->index(['status_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrean');
    }
};

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
        Schema::create('sets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('slot_id')->constrained('assets', 'id');
            $table->foreignId('screen_id')->constrained('assets', 'id')->nullable();
            $table->foreignId('pc_id')->constrained('assets', 'id')->nullable();
            $table->foreignId('card_id')->constrained('assets', 'id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};

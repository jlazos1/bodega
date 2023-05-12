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

            $table->foreign('slot_id')->references('id')->on('assets');
            $table->foreign('screen_id')->references('id')->on('assets');
            $table->foreign('pc_id')->references('id')->on('assets');
            $table->foreign('card_id')->references('id')->on('assets');

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

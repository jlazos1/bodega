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
        Schema::create('details_inputs', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('price');

            $table->foreignId('product_id')->constrained();
            $table->foreignId('input_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_inputs');
    }
};

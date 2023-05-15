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
        Schema::create('asset_model_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');

            $table->foreignId('order_id')->constrained();
            $table->foreignId('asset_model_id')->constrained();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_model_orders');
    }
};

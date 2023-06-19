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
        Schema::create('machine_relocations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('origin')->constrained('branches', 'id');
            $table->foreignId('destination')->constrained('branches', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_relocations');
    }
};

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
        Schema::create('karats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('stock_22k')->default(0);
            $table->string('stock_18k')->default(0);
            $table->string('stock_14k')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karats');
    }
};

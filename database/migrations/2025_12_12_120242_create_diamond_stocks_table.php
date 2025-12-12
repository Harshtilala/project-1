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
        Schema::create('diamond_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('natural')->default('0');
            $table->string('lab_grown')->default('0');
            $table->string('cvd')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_stocks');
    }
};

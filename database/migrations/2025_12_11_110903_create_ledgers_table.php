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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
             $table->date('date')->nullable();
            $table->string('particulars')->nullable();
            $table->string('type')->nullable();

            $table->string('gross_weight')->nullable();
            $table->string('less_weight')->nullable();
            $table->string('net_weight')->nullable();

            $table->string('tunch')->nullable();
            $table->string('wastage')->nullable();

            $table->string('gold_fine')->nullable();
            $table->string('silver_fine')->nullable();

            $table->string('amount')->nullable();
            $table->string('reference_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};

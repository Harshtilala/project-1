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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->text('mobile')->nullable();
            $table->text('email')->nullable();
            $table->string('account_group')->nullable();
            $table->text('remark')->nullable();
            $table->boolean('is_supplier')->default(false);
            $table->string('opening_gold');
            $table->enum('gold_type', ['debit', 'credit'])->default('debit');
            $table->string('opening_silver');
            $table->enum('silver_type', ['debit', 'credit'])->default('debit');
            $table->string('opening_rupees');
            $table->enum('rupees_type', ['debit', 'credit'])->default('debit');
            $table->string('price_per_pcs')->nullable();
            $table->json('wastage')->nullable();            
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

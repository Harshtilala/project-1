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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('type');
            $table->string('order_date');
            $table->string('date');
            $table->string('real_delivery_date')->nullable();
            $table->string('gold_price')->nullable();
            $table->string('party_name');
            $table->string('to_supplier')->nullable();
            $table->string('silver_price')->nullable();
            $table->string('delivery_date')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->boolean('status')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

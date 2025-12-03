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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
             $table->string('categoryName');
            $table->string('itemName');
            $table->string('shortItemName');
            $table->string('dleNo')->nullable();

            $table->string('designNo')->nullable();
            $table->string('minOrderQty')->nullable();
            $table->string('defaultWastage')->nullable();

            $table->enum('lessOption', ['yes', 'no'])->default('no');

            $table->string('stockTransferWastage')->nullable();
            $table->string('itemImage')->nullable();

            $table->string('stockMethod')->nullable();
            $table->string('sequenceNo')->nullable();
            $table->string('rateNo')->nullable();
            $table->decimal('rateOff', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

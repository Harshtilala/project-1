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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('category');
            $table->string('item');
            $table->string('tunch')->nullable();
            $table->string('weight');
            $table->string('pcs');
            $table->string('size')->nullable();
            $table->string('length')->nullable();
            $table->string('hook_style')->nullable();
            $table->text('remark')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

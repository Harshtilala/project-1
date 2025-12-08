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
        Schema::table('users', function (Blueprint $table) {
            $table->string('type');
            $table->string('username');
            $table->string('mobile')->unique();
            $table->string('opening_balance');
            $table->string('department')->nullable();
            $table->string('default_department')->nullable();
            $table->string('transaction_type');
            $table->string('designation')->nullable();
            $table->string('salary')->nullable();
            $table->boolean('is_cad_designer')->default(false);
            $table->boolean('otp_to_mobile')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

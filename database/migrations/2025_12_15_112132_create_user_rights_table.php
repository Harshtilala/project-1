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
        Schema::create('user_rights', function (Blueprint $table) {
            $table->id();
           
            $table->boolean('ad_master_view')->default(false);
            $table->boolean('ad_master_add')->default(false);
            $table->boolean('ad_master_edit')->default(false);
            $table->boolean('ad_master_delete')->default(false);

            $table->boolean('stamp_view')->default(false);
            $table->boolean('stamp_add')->default(false);
            $table->boolean('stamp_edit')->default(false);
            $table->boolean('stamp_delete')->default(false);

            /* =======================
             | Account
             ======================= */
            $table->boolean('account_view')->default(false);
            $table->boolean('account_add')->default(false);
            $table->boolean('account_edit')->default(false);
            $table->boolean('account_delete')->default(false);
            $table->boolean('account_approve')->default(false);
            $table->boolean('account_ledger')->default(false);
            $table->boolean('account_opening')->default(false);

            $table->boolean('account_group_view')->default(false);
            $table->boolean('account_group_add')->default(false);
            $table->boolean('account_group_edit')->default(false);
            $table->boolean('account_group_delete')->default(false);

            /* =======================
             | Order
             ======================= */
            $table->boolean('order_view')->default(false);

            $table->boolean('order_order_view')->default(false);
            $table->boolean('order_order_add')->default(false);
            $table->boolean('order_order_edit')->default(false);
            $table->boolean('order_order_delete')->default(false);
            $table->boolean('order_order_show_party')->default(false);

            $table->boolean('order_slider_view')->default(false);

            /* =======================
             | Sell / Purchase
             ======================= */
            $table->boolean('sell_purchase_view')->default(false);

            $table->boolean('sp_view')->default(false);
            $table->boolean('sp_add')->default(false);
            $table->boolean('sp_edit')->default(false);
            $table->boolean('sp_delete')->default(false);
            $table->boolean('sp_item_list')->default(false);
            $table->boolean('sp_allow_out_of_range')->default(false);
            $table->boolean('sp_allow_credit_limit')->default(false);
            $table->boolean('sp_change_wastage')->default(false);
            $table->boolean('sp_audit_suspect')->default(false);
            $table->boolean('sp_audit_pending')->default(false);
            $table->boolean('sp_change_data')->default(false);
            $table->boolean('sp_adjust_cr_amount')->default(false);

            $table->boolean('other_entry_view')->default(false);
            $table->boolean('other_entry_add')->default(false);
            $table->boolean('other_entry_edit')->default(false);
            $table->boolean('other_entry_delete')->default(false);
            $table->boolean('other_entry_change_data')->default(false);

            /* =======================
             | Stock Transfer
             ======================= */
            $table->boolean('stock_transfer_view')->default(false);
            $table->boolean('stock_transfer_add')->default(false);
            $table->boolean('stock_transfer_edit')->default(false);
            $table->boolean('stock_transfer_delete')->default(false);
            $table->boolean('stock_transfer_change_wastage')->default(false);
            $table->boolean('stock_transfer_is_guard')->default(false);
            $table->boolean('stock_transfer_audit_suspect')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rights');
    }
};

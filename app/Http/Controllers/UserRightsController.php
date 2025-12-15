<?php

namespace App\Http\Controllers;

use App\Models\UserRights;
use Illuminate\Http\Request;

class UserRightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRights = UserRights::first();
        return view('user_rights.index', compact('userRights'));
    }

    public function store(Request $request)
    {
        $permissions = [
            'ad_master_view',
            'ad_master_add',
            'ad_master_edit',
            'ad_master_delete',
            'stamp_view',
            'stamp_add',
            'stamp_edit',
            'stamp_delete',

            'account_view',
            'account_add',
            'account_edit',
            'account_delete',
            'account_approve',
            'account_ledger',
            'account_opening',

            'account_group_view',
            'account_group_add',
            'account_group_edit',
            'account_group_delete',

            'order_view',
            'order_order_view',
            'order_order_add',
            'order_order_edit',
            'order_order_delete',
            'order_order_show_party',

            'order_slider_view',

            'sell_purchase_view',

            'sp_view',
            'sp_add',
            'sp_edit',
            'sp_delete',
            'sp_item_list',
            'sp_allow_out_of_range',
            'sp_allow_credit_limit',
            'sp_change_wastage',
            'sp_audit_suspect',
            'sp_audit_pending',
            'sp_change_data',
            'sp_adjust_cr_amount',

            'other_entry_view',
            'other_entry_add',
            'other_entry_edit',
            'other_entry_delete',
            'other_entry_change_data',

            'stock_transfer_view',
            'stock_transfer_add',
            'stock_transfer_edit',
            'stock_transfer_delete',
            'stock_transfer_change_wastage',
            'stock_transfer_is_guard',
            'stock_transfer_audit_suspect',
        ];

        $data = [];
        foreach ($permissions as $permission) {
            $data[$permission] = $request->has($permission);
        }

        // Create if not exists, else update
        $rights = UserRights::first();

        if ($rights) {
            $rights->update($data);
        } else {
            UserRights::create($data);
        }

        return redirect()
            ->back()
            ->with('success', 'User rights saved successfully');
    }
}

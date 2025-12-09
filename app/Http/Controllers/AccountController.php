<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Start query with relationship
            $query = Account::get();

            return DataTables::of($query)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return '
                <button class="btn btn-primary btn-sm editBtn" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-danger btn-sm" data-action="delete" data-id="' . $row->id . '">Delete</button>
            ';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:accounts',
            'mobile' => 'nullable|string|max:500',
            'email' => 'nullable|string|max:500',
            'account_group' => 'nullable|in:customer,supplier,bank,cash',
            'remark' => 'nullable|string',
            'is_supplier' => 'nullable',

            'opening_gold' => 'nullable|numeric|min:0',
            'opening_gold_type' => 'required_with:opening_gold|in:debit,credit',

            'opening_silver' => 'nullable|numeric|min:0',
            'opening_silver_type' => 'required_with:opening_silver|in:debit,credit',

            'opening_rupees' => 'nullable|numeric|min:0',
            'opening_rupees_type' => 'required_with:opening_rupees|in:debit,credit',

            'price_per_pcs' => 'nullable|numeric|min:0',

            'wastage' => 'nullable|array',
            'wastage.*.category' => 'required_with:wastage|in:gold,silver,diamond',
            'wastage.*.item' => 'required_with:wastage|string',
            'wastage.*.percent' => 'required_with:wastage|numeric|min:0|max:100',
        ]);

        // Convert multiple mobiles to array
        if (!empty($validated['mobile'])) {
            $validated['mobile'] = array_map('trim', explode(',', $validated['mobile']));
        }

        // Convert multiple emails to array
        if (!empty($validated['email'])) {
            $validated['email'] = array_map('trim', explode(',', $validated['email']));
        }
        $wastage = $request->input('wastage', []); // This now works!
        // Final clean data for DB
        $data = [
            'name'               => $validated['name'],
            'code'               => $validated['code'] ?? null,
            'mobile'             => $validated['mobile'] ?? null,
            'email'              => $validated['email'] ?? null,
            'account_group'      => $validated['account_group'] ?? null,
            'remark'             => $validated['remark'] ?? null,
            'is_supplier'        => $request->boolean('is_supplier'),

            'opening_gold'       => $validated['opening_gold'] ?? 0,
            'gold_type'  => $validated['opening_gold_type'] ?? 'debit',

            'opening_silver'     => $validated['opening_silver'] ?? 0,
            'silver_type' => $validated['opening_silver_type'] ?? 'debit',

            'opening_rupees'     => $validated['opening_rupees'] ?? 0,
            'rupees_type' => $validated['opening_rupees_type'] ?? 'debit',

            'price_per_pcs'      => $validated['price_per_pcs'] ?? null,
            'wastage'       => $wastage,
        ];

        Account::create($data);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        return view('accounts.edit', compact('account'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $account = Account::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:accounts,code,' . $account->id,
            'mobile' => 'nullable|string|max:500',
            'email' => 'nullable|string|max:500',
            'account_group' => 'nullable|in:customer,supplier,bank,cash',
            'remark' => 'nullable|string',
            'is_supplier' => 'nullable',

            'opening_gold' => 'nullable|numeric|min:0',
            'opening_gold_type' => 'required_with:opening_gold|in:debit,credit',

            'opening_silver' => 'nullable|numeric|min:0',
            'opening_silver_type' => 'required_with:opening_silver|in:debit,credit',

            'opening_rupees' => 'nullable|numeric|min:0',
            'opening_rupees_type' => 'required_with:opening_rupees|in:debit,credit',

            'price_per_pcs' => 'nullable|numeric|min:0',

            'wastage' => 'nullable|array',
            'wastage.*.category' => 'required_with:wastage|in:gold,silver,diamond',
            'wastage.*.item' => 'required_with:wastage|string',
            'wastage.*.percent' => 'required_with:wastage|numeric|min:0|max:100',
        ]);

        // Convert multiple mobiles to array
        if (!empty($validated['mobile'])) {
            $validated['mobile'] = array_map('trim', explode(',', $validated['mobile']));
        }

        // Convert multiple emails to array
        if (!empty($validated['email'])) {
            $validated['email'] = array_map('trim', explode(',', $validated['email']));
        }
        $wastage = $request->input('wastage', []); // This now works!
        // Final clean data for DB
        $data = [
            'name'               => $validated['name'],
            'code'               => $validated['code'] ?? null,
            'mobile'             => $validated['mobile'] ?? null,
            'email'              => $validated['email'] ?? null,
            'account_group'      => $validated['account_group'] ?? null,
            'remark'             => $validated['remark'] ?? null,
            'is_supplier'        => $request->boolean('is_supplier'),   
            'opening_gold'       => $validated['opening_gold'] ?? 0,
            'gold_type'  => $validated['opening_gold_type'] ?? 'debit',
            'opening_silver'     => $validated['opening_silver'] ?? 0,
            'silver_type' => $validated['opening_silver_type'] ?? 'debit',
            'opening_rupees'     => $validated['opening_rupees'] ?? 0,
            'rupees_type' => $validated['opening_rupees_type'] ?? 'debit',
            'price_per_pcs'      => $validated['price_per_pcs'] ?? null,
            'wastage'       => $wastage,
        ];
        $account->update($data);
        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

       return response()->json(['success' => true, 'message' => 'Account deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ledger::query();
       
        // Filter: From Date
        if ($request->from_date) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        // Filter: To Date
        if ($request->to_date) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        // Filter: Type
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // Checkbox filters (optional logic)
        if ($request->from_zero) {
            $query->where('amount', '>=', 0);
        }

        if ($request->view_hisab) {
            $query->where('gold_fine', '!=', null);
        }

        if ($request->view_xrf) {
            $query->where('silver_fine', '!=', null);
        }

        $ledgers = $query->orderBy('date', 'desc')->get();
        return view('ledger.index', compact('ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ledger.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'         => 'required|date',
            'particulars'  => 'nullable|string',
            'type'         => 'required|string',

            'gross_weight' => 'nullable|string',
            'less_weight'  => 'nullable|string',
            'net_weight'   => 'nullable|string',
            'tunch'        => 'nullable|string',
            'wastage'      => 'nullable|string',

            'gold_fine'    => 'nullable|string',
            'silver_fine'  => 'nullable|string',
            'amount'       => 'required|string',
            'reference_no' => 'nullable|string',
        ]);

        Ledger::create($validated);

        return redirect()->route('ledger.index')->with('success', 'Ledger entry created successfully.');
    }

    public function show(Ledger $ledger)
    {
        //
    }

    public function edit($id)
    {
        $ledger = Ledger::findOrFail($id);
        return view('ledger.edit', compact('ledger'));
    }

    public function update($id)
    {
        $ledger = Ledger::findOrFail($id);

        $validated = request()->validate([
            'date'         => 'required|date',
            'particulars'  => 'nullable|string',
            'type'         => 'required|string',

            'gross_weight' => 'nullable|string',
            'less_weight'  => 'nullable|string',
            'net_weight'   => 'nullable|string',
            'tunch'        => 'nullable|string',
            'wastage'      => 'nullable|string',

            'gold_fine'    => 'nullable|string',
            'silver_fine'  => 'nullable|string',
            'amount'       => 'required|string',
            'reference_no' => 'nullable|string',
        ]);

        $ledger->update($validated);

        return redirect()->route('ledger.index')->with('success', 'Ledger entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ledger = Ledger::findOrFail($id);
        $ledger->delete();

        return redirect()->route('ledger.index')->with('success', 'Ledger entry deleted successfully.');
    }
}

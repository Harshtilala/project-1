<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ledgers = Ledger::all();
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

    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ledger $ledger)
    {
        //
    }
}

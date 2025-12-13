<?php

namespace App\Http\Controllers;

use App\Models\StockStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Start query
            $query = StockStatus::query();

            return DataTables::of($query)
                ->addColumn('status', function ($stock) {
                    if ($stock->quantity == 0) {
                        return '<span class="badge bg-danger">Out of Stock</span>';
                    } elseif ($stock->quantity < 50) {
                        return '<span class="badge bg-warning">Low Stock</span>';
                    } else {
                        return '<span class="badge bg-success">In Stock</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '
                    <button class="btn btn-sm btn-outline-primary me-1 editBtn" data-id="' . $row->id . '">
                         <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" data-action="delete" data-id="' . $row->id . '">
                       <i class="fas fa-trash"></i>
                    </button>';
                })


                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('stock_status.index');
    }

    public function create()
    {
        return view('stock_status.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'item_code' => 'required|unique:stock_statuses,item_code',
            'item_name' => 'required',
            'category' => 'required',
            'weight' => 'required|numeric',
            'purity' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        $latestId = StockStatus::latest('id')->first();
        $idNumber = $latestId ? $latestId->id + 1 : 1;

        // Pad ID to 3 digits
        $idPadded = str_pad($idNumber, 3, '0', STR_PAD_LEFT);

        // Category first letter
        $categoryLetter = strtoupper(substr($request->category, 0, 1));

        // Type abbreviation (from form)
       $typeAbbr = strtoupper(substr($request->item_name, 0, 3));


        // Generate Item Code
        $itemCode = $categoryLetter . '-' . $typeAbbr . '-' . $idPadded;

        // Store in DB
        $stock = new StockStatus();
        $stock->item_code = $itemCode;
        $stock->item_name = $request->item_name;
        $stock->category = $request->category;
        $stock->weight = $request->weight;
        $stock->purity = $request->purity;
        $stock->quantity = $request->quantity;
        $stock->save();

        return redirect()->route('stockstatus.index')->with('success', 'Stock status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockStatus $stockStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockStatus $stockStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockStatus $stockStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stock = StockStatus::findOrFail($id);
        $stock->delete();
        return response()->json(['success' => 'Stock status deleted successfully.']);
    }
}

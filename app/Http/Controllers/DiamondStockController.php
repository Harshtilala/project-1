<?php

namespace App\Http\Controllers;

use App\Models\DiamondStock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiamondStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Start query with relationship
            $query = DiamondStock::query();

            return DataTables::of($query)
                ->addIndexColumn()  

                ->addColumn('action', function ($row) {
                    return '
                <button class="btn btn-primary btn-sm editBtn" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-danger btn-sm" data-action="delete" data-id="' . $row->id . '">Delete</button>
            ';
                })
                 ->editColumn('natural', function($row){
                    return $row->natural ? '<span class="badge bg-success bg-opacity-10 text-success">'.$row->natural.'</span>' : '';
                })
                ->editColumn('lab_grown', function($row){
                    return $row->lab_grown ? '<span class="badge bg-warning bg-opacity-10 text-warning">'.$row->lab_grown.'</span>' : '';
                })
                ->editColumn('cvd', function($row){
                    return $row->cvd ? '<span class="badge bg-danger bg-opacity-10 text-danger">'.$row->cvd.'</span>' : '';
                })
                ->rawColumns(['action', 'natural', 'lab_grown', 'cvd'])
                ->make(true);
        }
              
        return view('diamond.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diamond.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'natural' => 'nullable|integer|min:0',
            'lab_grown' => 'nullable|integer|min:0',
            'cvd' => 'nullable|integer|min:0',
        ]);

        DiamondStock::create([
            'name' => $request->name,
            'natural' => $request->natural ?? 0,
            'lab_grown' => $request->lab_grown ?? 0,
            'cvd' => $request->cvd ?? 0,
        ]);

        return redirect()->route('diamond_stocks.index')->with('success', 'Diamond stock added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiamondStock $diamondStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiamondStock $diamondStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiamondStock $diamondStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiamondStock $diamondStock)
    {
        //
    }
}

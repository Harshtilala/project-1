<?php

namespace App\Http\Controllers;

use App\Models\Karat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KaratController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Start query
            $query = Karat::query();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                    <button class="btn btn-sm btn-outline-primary me-1 editBtn" data-id="' . $row->id . '">
                         <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" data-action="delete" data-id="' . $row->id . '">
                       <i class="fas fa-trash"></i>
                    </button>';
                })

                ->editColumn('stock_22k', function ($row) {
                    return $row->stock_22k  ? '<span class="badge bg-success bg-opacity-10 text-success">'
                        . $row->stock_22k . '</span>' : '';
                })

                ->editColumn('stock_18k', function ($row) {
                    return $row->stock_18k
                        ? '<span class="badge bg-warning bg-opacity-10 text-warning">' . $row->stock_18k . '</span>' : '';
                })
                ->editColumn('stock_14k', function ($row) {
                    return $row->stock_14k ? '<span class="badge bg-danger bg-opacity-10 text-danger">' . $row->stock_14k . '</span>' : '';
                })
                ->rawColumns(['action', 'stock_22k', 'stock_18k', 'stock_14k'])
                ->make(true);
        }
        $totals = [

            'total_22k' => karat::sum('stock_22k'),
            'total_18k' => karat::sum('stock_18k'),
            'total_14k' => karat::sum('stock_14k'),
        ];

        return view('karat.index', compact('totals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock_22k' => 'nullable|numeric|min:0',
            'stock_18k' => 'nullable|numeric|min:0',
            'stock_14k' => 'nullable|numeric|min:0',
        ]);

        Karat::create($validatedData);

        return redirect()->route('karat.index')->with('success', 'Karat stock created successfully.');
    }

    public function edit($id)
    {
        $karat = Karat::findOrFail($id);

        return view('karat.edit', compact('karat'));
    }

    public function update(Request $request, $id)
    {
        $karat = Karat::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock_22k' => 'nullable|numeric|min:0',
            'stock_18k' => 'nullable|numeric|min:0',
            'stock_14k' => 'nullable|numeric|min:0',
        ]);

        $karat->update($validatedData);

        return redirect()->route('karat.index')->with('success', 'Karat stock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karat = Karat::findOrFail($id);
        $karat->delete();

        return response()->json(['success' => true]);
    }
}

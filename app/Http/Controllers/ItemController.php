<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index() {}

    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
            'shortItemName' => 'required|string|max:255',
            'categoryName' => 'required',
            'dleNo' => 'required|string',
            'designNo' => 'required|string',
            'minOrderQty' => 'required|numeric|min:0',
            'defaultWastage' => 'nullable|numeric',
            'lessOption' => 'required|in:yes,no',
            'stockTransferWastage' => 'nullable|numeric',
            'stockMethod' => 'required|in:fifo,lifo,average',
            'sequenceNo' => 'nullable|integer|min:1',
            'rateNo' => 'nullable|string',
            'rateOff' => 'nullable|numeric',
            'itemImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only([
            'categoryName',
            'itemName',
            'shortItemName',
            'dleNo',
            'designNo',
            'minOrderQty',
            'defaultWastage',
            'lessOption',
            'stockTransferWastage',
            'stockMethod',
            'sequenceNo',
            'rateNo',
            'rateOff'
        ]);

        if ($request->hasFile('itemImage')) {
            $fileName = time() . '_' . $request->file('itemImage')->getClientOriginalName();
            $request->file('itemImage')->move(public_path('items'), $fileName);
            $data['itemImage'] = 'items/' . $fileName;
        }

        Item::create($data);

        return redirect()->route('item.index')->with('success', 'Item saved successfully!');
    }

    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}

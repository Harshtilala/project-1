<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        // Validate all
        $validated = $request->validate([
            'department' => 'required',
            'type' => 'required',
            'order_date' => 'required|date',
            'date' => 'required|date',
            'real_delivery_date' => 'required|date',
            'gold_price' => 'required|numeric',
            'party_name' => 'required|string',
            'to_supplier' => 'required|string',
            'silver_price' => 'required|numeric',
            'delivery_date' => 'required|date',
            'remark' => 'required|string',

            'items' => 'nullable|array',
            'items.*.category' => 'nullable',
            'items.*.item' => 'nullable',
            'items.*.weight' => 'nullable|numeric',
            'items.*.pcs' => 'nullable|integer',
            'items.*.tunch' => 'nullable|string',
            'items.*.size' => 'nullable|string',
            'items.*.length' => 'nullable|numeric',
            'items.*.hook_style' => 'nullable|string',
            'items.*.remark' => 'nullable|string',
            'items.*.image' => 'nullable|image|max:2048',
        ]);

        $order = Order::create([
            'department' => $request->department,
            'type' => $request->type,
            'order_date' => $request->order_date,
            'date' => $request->date,
            'real_delivery_date' => $request->real_delivery_date,
            'gold_price' => $request->gold_price,
            'silver_price' => $request->silver_price,
            'party_name' => $request->party_name,
            'delivery_date' => $request->delivery_date,
            'to_supplier' => $request->to_supplier,
            'remark' => $request->remark
        ]);

        if ($request->has('items')) {
        foreach ($request->items as $item) {

            // Skip if ALL fields empty
            if (
                empty($item['category']) &&
                empty($item['item']) &&
                empty($item['tunch']) &&
                empty($item['weight']) &&
                empty($item['pcs']) &&
                empty($item['size']) &&
                empty($item['length']) &&
                empty($item['hook_style']) &&
                empty($item['remark']) &&
                empty($item['image'])
            ) {
                continue; 
            }
            // Handle image
            $imageName = null;
            if (isset($item['image'])) {
                $imageName = time() . '_' . $item['image']->getClientOriginalName();
                $item['image']->move(public_path('order_items'), $imageName);
            }

            // Create order_item
            OrderItem::create([
                'order_id' => $order->id,
                'category' => $item['category'] ?? null,
                'item' => $item['item'] ?? null,
                'tunch' => $item['tunch'] ?? null,
                'weight' => $item['weight'] ?? null,
                'pcs' => $item['pcs'] ?? null,
                'size' => $item['size'] ?? null,
                'length' => $item['length'] ?? null,
                'hook_style' => $item['hook_style'] ?? null,
                'remark' => $item['remark'] ?? null,
                'image' => $imageName
            ]);
        }
    }
        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Start query with relationship
            $query = Order::with('items')->latest();

            // === ALL FILTERS (Main + Additional) ===
            if ($request->filled('department'))      $query->where('department', $request->department);
            if ($request->filled('department2'))     $query->where('department', $request->department2);

            if ($request->filled('status'))          $query->where('status', $request->status === '1' ? 1 : 0);
       
            // Let Yajra handle pagination, ordering, searching
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('item', function ($row) {
                    return $row->items->pluck('item')->filter()->implode(', ') ?: 'No Item';
                })
                ->addColumn('status', function ($row) {
                    $text = $row->status == 1 ? 'Completed' : 'Pending';
                    $class = $row->status == 1
                        ? 'badge rounded-pill bg-success px-3 py-2'
                        : 'badge rounded-pill bg-warning text-dark px-3 py-2';

                    return '<span class="statusToggle ' . $class . '" 
                            data-id="' . $row->id . '" 
                            style="cursor:pointer; display:inline-block;">
                            ' . $text . '
                            </span>';
                })
                ->addColumn('total', fn($row) => $row->gold_price ?? '-')
                ->addColumn('action', function ($row) {
                    return '
                    <button class="btn btn-primary btn-sm editBtn" data-id="' . $row->id . '">Edit</button> ' .
                    '<button class="btn btn-danger btn-sm" data-action="delete" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

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
    public function changeStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->status = $order->status == 1 ? 0 : 1;
        $order->save();
        return response()->json(['message' => 'Status updateded successfully.']);
    }

    public function edit($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // Validate order fields
        $validated = $request->validate([
            'department' => 'required',
            'type' => 'required',
            'order_date' => 'required|date',
            'date' => 'required|date',
            'real_delivery_date' => 'required|date',
            'gold_price' => 'required|numeric',
            'silver_price' => 'required|numeric',
            'party_name' => 'required|string',
            'to_supplier' => 'required|string',
            'delivery_date' => 'required|date',
            'remark' => 'required|string',

            'items' => 'nullable|array',
            'items.*.id' => 'nullable|exists:order_items,id',
            'items.*.category' => 'nullable|string',
            'items.*.item' => 'nullable|string',
            'items.*.weight' => 'nullable|numeric',
            'items.*.pcs' => 'nullable|integer',
            'items.*.tunch' => 'nullable|string',
            'items.*.size' => 'nullable|string',
            'items.*.length' => 'nullable|numeric',
            'items.*.hook_style' => 'nullable|string',
            'items.*.remark' => 'nullable|string',
            'items.*.image' => 'nullable|image|max:2048',
        ]);

        // Update main order
        $order = Order::findOrFail($id);
        $order->update([
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
        // DELETE ITEM 
        if ($request->filled('deleted_items')) {
            $ids = explode(',', $request->deleted_items);

            foreach ($ids as $itemId) {
                $item = OrderItem::find($itemId);

                if ($item) {
                    // delete image
                    if ($item->image && file_exists(public_path('order_items/' . $item->image))) {
                        unlink(public_path('order_items/' . $item->image));
                    }
                    $item->delete();
                }
            }
        }

        // Handle order items
        if ($request->has('items')) {
            foreach ($request->items as $itemData) {
                if (
                    empty($itemData['category']) &&
                    empty($itemData['item']) &&
                    empty($itemData['tunch']) &&
                    empty($itemData['weight']) &&
                    empty($itemData['pcs']) &&
                    empty($itemData['size']) &&
                    empty($itemData['length']) &&
                    empty($itemData['hook_style']) &&
                    empty($itemData['remark']) &&
                    empty($itemData['image'])
                ) {
                    continue;
                }
                if (!empty($itemData['id'])) {
                    $orderItem = OrderItem::find($itemData['id']);
                    if ($orderItem) {
                        if (isset($itemData['image'])) {
                            if ($orderItem->image && file_exists(public_path('order_items/' . $orderItem->image))) {
                                unlink(public_path('order_items/' . $orderItem->image));
                            }
                            $imageName = time() . '_' . $itemData['image']->getClientOriginalName();
                            $itemData['image']->move(public_path('order_items'), $imageName);
                            $itemData['image'] = $imageName;
                        } else {
                            $itemData['image'] = $orderItem->image;
                        }

                        $orderItem->update([
                            'category' => $itemData['category'] ?? null,
                            'item' => $itemData['item'] ?? null,
                            'tunch' => $itemData['tunch'] ?? null,
                            'weight' => $itemData['weight'] ?? null,
                            'pcs' => $itemData['pcs'] ?? null,
                            'size' => $itemData['size'] ?? null,
                            'length' => $itemData['length'] ?? null,
                            'hook_style' => $itemData['hook_style'] ?? null,
                            'remark' => $itemData['remark'] ?? null,
                            'image' => $itemData['image'] ?? null,
                        ]);
                    }
                } else {
                    // New item creation
                    $imageName = null;
                    if (isset($itemData['image'])) {
                        $imageName = time() . '_' . $itemData['image']->getClientOriginalName();
                        $itemData['image']->move(public_path('order_items'), $imageName);
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'category' => $itemData['category'] ?? null,
                        'item' => $itemData['item'] ?? null,
                        'tunch' => $itemData['tunch'] ?? null,
                        'weight' => $itemData['weight'] ?? null,
                        'pcs' => $itemData['pcs'] ?? null,
                        'size' => $itemData['size'] ?? null,
                        'length' => $itemData['length'] ?? null,
                        'hook_style' => $itemData['hook_style'] ?? null,
                        'remark' => $itemData['remark'] ?? null,
                        'image' => $imageName
                    ]);
                }
            }
        }

        return redirect()->route('order.index')->with('success', 'Order and items updated successfully.');
    }

    public function destroy($id)
    {
        $order = order::findOrFail($id);

        $order->items()->delete();

        $order->delete();
        return response()->json(['success' => true, 'message' => 'order deleted successfully.']);
    }

    
}

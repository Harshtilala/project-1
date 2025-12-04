@extends('layouts.master')
@section('content')
<style>
    /* Your existing CSS – keep it unchanged */
    .lot-item {
        position: relative;
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        background: #fafafa;
    }

    .remove-item {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc2626;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
    }

    .remove-item:hover {
        background: #b91c1c;
    }

    .image-upload {
        width: 150px;
        height: 150px;
        border: 2px dashed #aaa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #f5f5f5;
    }

    .image-upload:hover {
        border-color: #0d6efd;
    }

    .image-preview {
        max-width: 100%;
        max-height: 100%;
        border-radius: 6px;
    }
</style>

<body class="dashboard">

    <form id="orderForm" class="order-form" method="POST" action="{{ route('order.update', $order->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Page Title -->
        <h1 class="title" style="font-size: 26px; font-weight: bold; color: black; position: absolute; top: 8px;">Edit
            Order</h1>

        <!-- Order Details Section -->
        <div class="form-section" style="position: relative; margin-top: 70px;">
            <div class="form-grid">

                {{-- Global Alerts --}}
                @if (session('success'))
                <div
                    style="background: #16a34a; color: white; padding: 12px; border-radius: 6px; margin-bottom: 12px; font-weight: 600;">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div
                    style="background: #dc2626; color: white; padding: 14px; border-radius: 6px; margin-bottom: 12px; font-weight: 600;">
                    <strong>Validation Errors:</strong>
                    <ul style="margin-top: 10px; margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- ==== Your existing form fields (unchanged) ==== -->
                <div class="form-group">
                    <label for="department">Department</label>
                    <div class="select-container">
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="gold" {{ $order->department == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="silver" {{ $order->department == 'silver' ? 'selected' : '' }}>Silver
                            </option>
                            <option value="diamond" {{ $order->department == 'diamond' ? 'selected' : '' }}>Diamond
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <div class="select-container">
                        <select id="type" name="type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="new" {{ $order->type == 'new' ? 'selected' : '' }}>New</option>
                            <option value="repair" {{ $order->type == 'repair' ? 'selected' : '' }}>Repair</option>
                            <option value="exchange" {{ $order->type == 'exchange' ? 'selected' : '' }}>Exchange
                            </option>
                        </select>
                    </div>
                </div>

                <input type="hidden" id="deletedItems" name="deleted_items" value="">

                <div class="form-group">
                    <label for="orderDate">Order Date</label>
                    <input type="date" id="orderDate" name="order_date" class="form-control"
                        value="{{ old('order_date', $order->order_date?->format('Y-m-d')) }}" required>
                </div>

                <div class="form-group">
                    <label for="deliveryDate">Delivery Date</label>
                    <input type="date" id="deliveryDate" name="date" class="form-control"
                        value="{{ old('date', $order->date?->format('Y-m-d')) }}" required>
                </div>

                <div class="form-group">
                    <label for="realDeliveryDate">Real Delivery Date</label>
                    <input type="date" id="realDeliveryDate" name="real_delivery_date" class="form-control"
                        value="{{ old('real_delivery_date', $order->real_delivery_date?->format('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label for="goldPrice">Gold Price for this Order</label>
                    <input type="number" id="goldPrice" name="gold_price" class="form-control" step="0.01" min="0"
                        value="{{ $order->gold_price }}">
                </div>

                <div class="form-group">
                    <label for="partyName">Party Name & No.</label>
                    <input type="text" id="partyName" name="party_name" class="form-control"
                        value="{{ $order->party_name }}" required>
                </div>

                <div class="form-group">
                    <label for="toSupplier">To Supplier</label>
                    <input type="text" id="toSupplier" name="to_supplier" class="form-control"
                        value="{{ $order->to_supplier }}">
                </div>

                <div class="form-group">
                    <label for="silverPrice">Silver Price</label>
                    <input type="number" id="silverPrice" name="silver_price" class="form-control" step="0.01" min="0"
                        value="{{ $order->silver_price }}">
                </div>

                <div class="form-group">
                    <label for="supplierDeliveryDate">Delivery Date</label>
                    <input type="date" id="supplierDeliveryDate" name="delivery_date" class="form-control"
                        value="{{ old('delivery_date', $order->delivery_date?->format('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input type="text" id="remark" name="remark" class="form-control" value="{{ $order->remark }}">
                </div>

                <div class="form-group full-width" style="margin-top: 20px;">
                    <div class="button-group">

                        <a href="{{ route('order.index') }}" class="btn btn-style"
                            style="background-color: #6c757d; color: white; text-decoration: none; display: inline-block;">
                            ← Back
                        </a>

                        <button type="button" class="btn btn-reset" onclick="resetToOriginal()"
                            style="background-color: #dc2626; color: white;">
                            Reset
                        </button>
                        <button type="button" class="btn btn-style" id="addLotItem"
                            style="background-color: #0d6efd; color: white;">
                            Add Item
                        </button>
                        <button type="submit" class="btn btn-style" style="background-color: #0266fc; color: white;">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lot Items Section -->
        <div id="lotItemsSection" style="display: {{ $order->items->count() ? 'block' : 'none' }};">
            <div id="lotItemsContainer">
                <!-- Existing items will be injected here by JS -->
            </div>
        </div>
    </form>

    <script src="scripts/dashboard.js"></script>
    <script>
        let itemCounter = 0;
    let isInitialLoad = true;

    // ------------------------------------------------------------------
    // Remove item (cross button) – also records deleted existing items
    // ------------------------------------------------------------------
    function removeLotItem(elementId) {
        const lotItem = document.getElementById(elementId);
        if (!lotItem) return;

        // If this was an existing item (has data-item-id attribute) → remember for deletion
        const orderItemId = lotItem.getAttribute('data-item-id');
        if (orderItemId) {
            const deletedInput = document.getElementById('deletedItems');
            const current = deletedInput.value ? deletedInput.value.split(',') : [];
            if (!current.includes(orderItemId)) {
                current.push(orderItemId);
                deletedInput.value = current.join(',');
            }
        }

        // Remove from DOM
        lotItem.remove();

        // Hide section if no items left
        if (document.querySelectorAll('.lot-item').length === 0) {
            document.getElementById('lotItemsSection').style.display = 'none';
        }
    }

    // ------------------------------------------------------------------
    // Add new empty lot item
    // ------------------------------------------------------------------
    document.getElementById('addLotItem').addEventListener('click', () => addLotItemWithData());

    function addLotItemWithData(data = {}) {
        itemCounter++;
        const container = document.getElementById('lotItemsContainer');
        const elementId = 'lotItem' + itemCounter;

        const div = document.createElement('div');
        div.className = 'lot-item';
        div.id = elementId;
        if (data.id) div.setAttribute('data-item-id', data.id);   // important for deletion

        div.innerHTML = `
            <button type="button" class="remove-item" onclick="removeLotItem('${elementId}')">×</button>
            <h2>Lot Item</h2>
            <div class="form-grid">

                <!-- Hidden ID for existing items -->
                ${data.id ? `<input type="hidden" name="items[${itemCounter}][id]" value="${data.id}">` : ''}

                <div class="form-group">
                    <label>Select Category</label>
                    <select name="items[${itemCounter}][category]" class="form-control category-select">
                        <option value="">Select Category</option>
                        <option value="ring"     ${data.category==='ring'?'selected':''}>Ring</option>
                        <option value="necklace"${data.category==='necklace'?'selected':''}>Necklace</option>
                        <option value="bangle"   ${data.category==='bangle'?'selected':''}>Bangle</option>
                        <option value="earring"  ${data.category==='earring'?'selected':''}>Earring</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Item</label>
                    <select name="items[${itemCounter}][item]" class="form-control item-select">
                        <option value="">Select Item</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tunch</label>
                    <input type="text" name="items[${itemCounter}][tunch]" class="form-control" value="${data.tunch || ''}">
                </div>

                <div class="form-group">
                    <label>Weight (g)</label>
                    <input type="number" step="0.001" name="items[${itemCounter}][weight]" class="form-control" value="${data.weight || ''}">
                </div>

                <div class="form-group">
                    <label>PCS</label>
                    <input type="number" min="1" name="items[${itemCounter}][pcs]" class="form-control" value="${data.pcs || '1'}">
                </div>

                <div class="form-group">
                    <label>Size</label>
                    <input type="text" name="items[${itemCounter}][size]" class="form-control" value="${data.size || ''}">
                </div>

                <div class="form-group">
                    <label>Length</label>
                    <input type="number" step="0.1" name="items[${itemCounter}][length]" class="form-control" value="${data.length || ''}">
                </div>

                <div class="form-group">
                    <label>Hook Style</label>
                    <select name="items[${itemCounter}][hook_style]" class="form-control">
                        <option value="">Select Hook Style</option>
                        <option value="standard" ${data.hook_style==='standard'?'selected':''}>Standard</option>
                        <option value="lobster"  ${data.hook_style==='lobster'?'selected':''}>Lobster Claw</option>
                        <option value="spring"   ${data.hook_style==='spring'?'selected':''}>Spring Ring</option>
                        <option value="fishhook" ${data.hook_style==='fishhook'?'selected':''}>Fishhook</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Remark</label>
                    <input type="text" name="items[${itemCounter}][remark]" class="form-control" value="${data.remark || ''}">
                </div>

                <div class="form-group full-width">
                    <label>Image Upload</label>
                    <div class="image-upload" onclick="document.getElementById('imageUpload${itemCounter}').click()">
                        <input type="file" id="imageUpload${itemCounter}" name="items[${itemCounter}][image]" accept="image/*" style="display:none;" onchange="previewImage(this, 'preview${itemCounter}')">
                        <img id="preview${itemCounter}" class="image-preview" src="${data.image_url || ''}" style="display:${data.image_url?'block':'none'}; max-height:150px;">
                    </div>
                </div>
            </div>
        `;

        container.appendChild(div);
        document.getElementById('lotItemsSection').style.display = 'block';

        // Populate item dropdown based on category
        const catSelect = div.querySelector('.category-select');
        const itemSelect = div.querySelector('.item-select');
        populateItems(catSelect.value, itemSelect, data.item);
        catSelect.addEventListener('change', () => populateItems(catSelect.value, itemSelect));

        if (!isInitialLoad) div.scrollIntoView({ behavior: 'smooth' });
    }

    // ------------------------------------------------------------------
    // Populate Item dropdown
    // ------------------------------------------------------------------
    function populateItems(category, itemSelect, selectedItem = '') {
        itemSelect.innerHTML = '<option value="">Select Item</option>';
        const map = {
            ring:     ['Diamond Ring','Gold Ring','Silver Ring'],
            necklace: ['Gold Chain','Pendant Set','Mangalsutra'],
            bangle:   ['Gold Bangle','Kada','Chudi'],
            earring:  ['Jhumka','Studs','Hoops']
        };
        if (category && map[category]) {
            map[category].forEach(name => {
                const opt = document.createElement('option');
                opt.value = name.toLowerCase().replace(/\s+/g, '-');
                opt.textContent = name;
                if (selectedItem && selectedItem.toLowerCase().replace(/\s+/g, '-') === opt.value) opt.selected = true;
                itemSelect.appendChild(opt);
            });
        }
    }

    // ------------------------------------------------------------------
    // Image preview
    // ------------------------------------------------------------------
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ------------------------------------------------------------------
    // Load existing items on page load
    // ------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', function () {
        @foreach ($order->items as $item)
            addLotItemWithData({
                id: "{{ $item->id }}",
                category: "{{ $item->category }}",
                item: "{{ $item->item }}",
                tunch: "{{ $item->tunch }}",
                weight: "{{ $item->weight }}",
                pcs: "{{ $item->pcs }}",
                size: "{{ $item->size }}",
                length: "{{ $item->length }}",
                hook_style: "{{ $item->hook_style }}",
                remark: "{{ $item->remark }}",
                image_url: "{{ $item->image ? asset('order_items/' . $item->image) : '' }}"
            });
        @endforeach
        isInitialLoad = false;
    });

    function resetToOriginal() {
    location.reload(); // Reloads the page and restores DB values
}

    </script>
</body>
@endsection
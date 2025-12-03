@extends('layouts.master')
@section('content')
<style>
/* Keep your existing CSS as-is */
</style>

<body class="dashboard">

    <form id="orderForm" class="order-form" method="POST" action="{{ route('order.update', $order->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Page Title -->
        <h1 class="title" style="font-size: 26px; font-weight: bold; color: black; position: absolute; top: 8px;">Edit Order</h1>

        <!-- Order Details Section -->
        <div class="form-section" style="position: relative; top: 30px;">
            <div class="form-grid">

                {{-- Global Alerts --}}
                @if (session('success'))
                    <div style="background: #16a34a; color: white; padding: 12px; border-radius: 6px; margin-bottom: 12px; font-weight: 600;">
                        ✔ {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div style="background: #dc2626; color: white; padding: 14px; border-radius: 6px; margin-bottom: 12px; font-weight: 600;">
                        <strong>Validation Errors:</strong>
                        <ul style="margin-top: 10px; margin-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Row 1 -->
                <div class="form-group">
                    <label for="department">Department</label>
                    <div class="select-container">
                        <i class="fas fa-building"></i>
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="gold" {{ $order->department == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="silver" {{ $order->department == 'silver' ? 'selected' : '' }}>Silver</option>
                            <option value="diamond" {{ $order->department == 'diamond' ? 'selected' : '' }}>Diamond</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <div class="select-container">
                        <i class="fas fa-tag"></i>
                        <select id="type" name="type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="new" {{ $order->type == 'new' ? 'selected' : '' }}>New</option>
                            <option value="repair" {{ $order->type == 'repair' ? 'selected' : '' }}>Repair</option>
                            <option value="exchange" {{ $order->type == 'exchange' ? 'selected' : '' }}>Exchange</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="orderDate">Date</label>
                    <input type="date" id="orderDate" name="order_date" class="form-control" value="{{ $order->order_date}}" required>
                </div>

                <!-- Row 2 -->
                <div class="form-group">
                    <label for="deliveryDate">Delivery Date</label>
                    <input type="date" id="deliveryDate" name="date" class="form-control" value="{{ $order->date ? $order->date: '' }}" required>
                </div>

                <div class="form-group">
                    <label for="realDeliveryDate">Real Delivery Date</label>
                    <input type="date" id="realDeliveryDate" name="real_delivery_date" class="form-control" value="{{ $order->real_delivery_date ? $order->real_delivery_date : '' }}">
                </div>

                <div class="form-group">
                    <label for="goldPrice">Gold Price for this Order</label>
                    <input type="number" id="goldPrice" name="gold_price" class="form-control" step="0.01" min="0" value="{{ $order->gold_price }}">
                </div>

                <!-- Row 3 -->
                <div class="form-group">
                    <label for="partyName">Party Name & No.</label>
                    <input type="text" id="partyName" name="party_name" class="form-control" value="{{ $order->party_name }}" required>
                </div>

                <div class="form-group">
                    <label for="toSupplier">To Supplier</label>
                    <input type="text" id="toSupplier" name="to_supplier" class="form-control" value="{{ $order->to_supplier }}">
                </div>

                <div class="form-group">
                    <label for="silverPrice">Silver Price</label>
                    <input type="number" id="silverPrice" name="silver_price" class="form-control" step="0.01" min="0" value="{{ $order->silver_price }}">
                </div>

                <!-- Row 4 -->
                <div class="form-group">
                    <label for="supplierDeliveryDate">Delivery Date</label>
                    <input type="date" id="supplierDeliveryDate" name="delivery_date" class="form-control" value="{{ $order->delivery_date ? $order->delivery_date : '' }}">
                </div>

                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input type="text" id="remark" name="remark" class="form-control" value="{{ $order->remark }}">
                </div>

                <div class="form-group full-width" style="margin-top: 20px;">
                    <div class="button-group">
                        <button type="button" class="btn btn-style" id="addLotItem" style="background-color: #0d6efd; color: white;">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                        <button type="button" class="btn btn-reset" onclick="resetForm()" style="background-color: #dc2626; color: white;">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-style" style="background-color: #0266fc; color: white;">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Lot Items Section -->
        <div id="lotItemsSection" style="display: {{ $order->items->count() ? 'block' : 'none' }};">
            <div id="lotItemsContainer">
                @foreach ($order->items as $index => $item)
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            addLotItemWithData({
                                category: "{{ $item->category }}",
                                item: "{{ $item->item }}",
                                tunch: "{{ $item->tunch }}",
                                weight: "{{ $item->weight }}",
                                pcs: "{{ $item->pcs }}",
                                size: "{{ $item->size }}",
                                length: "{{ $item->length }}",
                                hook_style: "{{ $item->hook_style }}",
                                remark: "{{ $item->remark }}",
                                image_url: "{{ $item->image ? asset('storage/' . $item->image) : '' }}"
                            });
                        });
                    </script>
                @endforeach
            </div>
        </div>
    </form>

<script src="scripts/dashboard.js"></script>
<script>
let itemCounter = 0;
let isInitialLoad = false;

function addLotItemWithData(data = {}) {
    itemCounter++;
    const container = document.getElementById('lotItemsContainer');
    const itemId = 'lotItem' + itemCounter;

    const lotItem = document.createElement('div');
    lotItem.className = 'lot-item';
    lotItem.id = itemId;

    lotItem.innerHTML = `
        <button type="button" class="remove-item" onclick="removeLotItem('${itemId}')">×</button>
        <h2>Lot Items</h2>
        <div class="form-grid">
            <div class="form-group">
                <label for="category${itemCounter}">Select Category</label>
                <select id="category${itemCounter}" name="items[${itemCounter}][category]" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="ring">Ring</option>
                    <option value="necklace">Necklace</option>
                    <option value="bangle">Bangle</option>
                    <option value="earring">Earring</option>
                </select>
            </div>

            <div class="form-group">
                <label for="item${itemCounter}">Select Item</label>
                <select id="item${itemCounter}" name="items[${itemCounter}][item]" class="form-control" required>
                    <option value="">Select Item</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tunch${itemCounter}">Tunch</label>
                <input type="text" id="tunch${itemCounter}" name="items[${itemCounter}][tunch]" class="form-control" value="${data.tunch || ''}">
            </div>

            <div class="form-group">
                <label for="weight${itemCounter}">Weight (g)</label>
                <input type="number" id="weight${itemCounter}" name="items[${itemCounter}][weight]" class="form-control" step="0.001" min="0" value="${data.weight || ''}" required>
            </div>

            <div class="form-group">
                <label for="pcs${itemCounter}">PCS</label>
                <input type="number" id="pcs${itemCounter}" name="items[${itemCounter}][pcs]" class="form-control" min="1" value="${data.pcs || 1}" required>
            </div>

            <div class="form-group">
                <label for="size${itemCounter}">Size</label>
                <input type="text" id="size${itemCounter}" name="items[${itemCounter}][size]" class="form-control" value="${data.size || ''}">
            </div>

            <div class="form-group">
                <label for="length${itemCounter}">Length</label>
                <input type="number" id="length${itemCounter}" name="items[${itemCounter}][length]" class="form-control" step="0.1" min="0" value="${data.length || ''}">
            </div>

            <div class="form-group">
                <label for="hookStyle${itemCounter}">Hook Style</label>
                <select id="hookStyle${itemCounter}" name="items[${itemCounter}][hook_style]" class="form-control">
                    <option value="">Select Hook Style</option>
                    <option value="standard" ${data.hook_style=='standard'?'selected':''}>Standard</option>
                    <option value="lobster" ${data.hook_style=='lobster'?'selected':''}>Lobster Claw</option>
                    <option value="spring" ${data.hook_style=='spring'?'selected':''}>Spring Ring</option>
                    <option value="fishhook" ${data.hook_style=='fishhook'?'selected':''}>Fishhook</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label>Remark</label>
                <input type="text" name="items[${itemCounter}][remark]" class="form-control" value="${data.remark || ''}">
            </div>

            <div class="form-group full-width">
                <label>Image Upload</label>
                <div class="image-upload" onclick="document.getElementById('imageUpload${itemCounter}').click()">
                    <input type="file" id="imageUpload${itemCounter}" name="items[${itemCounter}][image]" accept="image/*" style="display: none;" onchange="previewImage(this, 'preview${itemCounter}')">
                    <img id="preview${itemCounter}" class="image-preview" src="${data.image_url || ''}" style="display: ${data.image_url?'block':'none'};">
                </div>
            </div>
        </div>
    `;
    container.appendChild(lotItem);

    const categorySelect = document.getElementById(`category${itemCounter}`);
    const itemSelect = document.getElementById(`item${itemCounter}`);
    categorySelect.value = data.category || '';
    updateItemsDropdown(categorySelect.value, itemSelect, data.item);
    categorySelect.addEventListener('change', function () {
        updateItemsDropdown(this.value, itemSelect);
    });

    if (!isInitialLoad) lotItem.scrollIntoView({ behavior: 'smooth' });
}

// Helper to set item dropdown value
function updateItemsDropdown(category, itemSelect, selectedItem = '') {
    itemSelect.innerHTML = '<option value="">Select Item</option>';
    const items = { 'ring':['Diamond Ring','Gold Ring','Silver Ring'], 'necklace':['Gold Chain','Pendant Set','Mangalsutra'], 'bangle':['Gold Bangle','Kada','Chudi'], 'earring':['Jhumka','Studs','Hoops'] };
    if(category && items[category]){
        items[category].forEach(i=>{
            const option = document.createElement('option');
            option.value = i.toLowerCase().replace(/\s+/g,'-');
            option.textContent = i;
            if(selectedItem && selectedItem.toLowerCase().replace(/\s+/g,'-')===option.value) option.selected = true;
            itemSelect.appendChild(option);
        });
    }
}

function removeLotItem(id){
    const item = document.getElementById(id);
    if(item) item.remove();
}

function previewImage(input, previewId){
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    const reader = new FileReader();
    reader.onload = e => { preview.src = e.target.result; preview.style.display='block'; };
    if(file) reader.readAsDataURL(file);
}
</script>
</body>
@endsection

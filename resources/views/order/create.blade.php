@extends('layouts.master')
@section('content')
 <style>
    /* Add padding to main content to prevent footer overlap */
    .content {
      padding-bottom: 70px;
    }

    :root {
      --success-color: #10b981;
      --info-color: #3b82f6;
      --warning-color: #f59e0b;
      --danger-color: #ef4444;
      --light-color: #f8fafc;
      --dark-color: #1e293b;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-300: #cbd5e1;
      --gray-400: #94a3b8;
      --gray-500: #64748b;
      --gray-600: #475569;
      --gray-700: #334155;
      --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background-color: #f8fafc;
      color: var(--gray-700);
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    .order-form {
      display: flex;
      flex-direction: column;
      height: 100%;
      padding: 20px;
    }

    .form-section {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: var(--shadow-sm);
      padding: 20px;
      margin-bottom: 20px;
      color: black;
      font-weight: bold;
      font-size: 15px;
    }

    .form-section h2 {
      margin-top: 0;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid var(--gray-200);
      color: var(--gray-800);
    }

    /* 3-column grid layout */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .form-group {
      margin-bottom: 0;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: var(--gray-600);
    }

    /* Base form control styles */
    .form-control {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--gray-300);
      border-radius: 6px;
      background: white;
      color: var(--gray-700);
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      outline: none;
      box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
    }

    .form-control:disabled {
      background-color: var(--gray-100);
      cursor: not-allowed;
    }

    /* Custom Select Container - Only for dropdowns */
    .select-container {
      position: relative;
      width: 100%;
    }

    .select-container i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-400);
      pointer-events: none;
      z-index: 2;
    }

    /* Style only select elements within select-container */
    .select-container select.form-control {
      padding-left: 40px;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 16px 12px;
      background-color: white;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      margin-top: 24px;
      padding: 16px 0;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: #fff;
      padding: 15px 20px;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .reset-message {
      transition: opacity 0.3s ease-in-out;
    }

    .lot-items {
      margin-top: 20px;
    }

    .lot-item {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      position: relative;
      box-shadow: var(--shadow-sm);
      color: black;
      font-weight: bold;
      font-size: 15px;
    }

    .remove-item {
      position: absolute;
      top: 8px;
      right: 8px;
      background: var(--m3-error-container);
      color: var(--m3-on-error-container);
      border: none;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .image-upload {
      border: 2px dashed var(--m3-outline);
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      cursor: pointer;
      margin-top: 10px;
    }

    .image-upload:hover {
      border-color: var(--m3-primary);
      background: rgba(var(--m3-primary-rgb), 0.05);
    }

    .image-preview {
      max-width: 100px;
      max-height: 100px;
      margin-top: 10px;
      display: none;
    }
    .btn-close {
      background-color: #dc2626;
      color: white;
      width: 100px;
      height: 20px;
      padding: 8px 20px;
      border: none;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    /* Full width for specific elements */
    .full-width {
      grid-column: 1 / -1;
    }

    /* Button group styling */
    .button-group {
      display: flex;
      gap: 8px;
      align-items: flex-end;
    }
  </style>
<body class="dashboard">

      <form id="orderForm" class="order-form"  method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Order Details Section -->
        <h1 class="title" style="font-size: 26px; font-weight: bold; color: black; position: absolute; top: 8px;">Add New Order</h1>
        <div class="form-section" style="position: relative; top: 30px;">
          <div class="form-grid">
            <!-- Row 1 -->{{-- Global Alert Messages --}}
@if (session('success'))
    <div style="
        background: #16a34a; 
        color: white; 
        padding: 12px; 
        border-radius: 6px; 
        margin-bottom: 12px;
        font-weight: 600;">
        ✔ {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="
        background: #dc2626; 
        color: white; 
        padding: 12px; 
        border-radius: 6px; 
        margin-bottom: 12px;
        font-weight: 600;">
        ❌ {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div style="
        background: #f59e0b; 
        color: white; 
        padding: 12px; 
        border-radius: 6px; 
        margin-bottom: 12px;
        font-weight: 600;">
        ⚠️ {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div style="
        background: #3b82f6; 
        color: white; 
        padding: 12px; 
        border-radius: 6px; 
        margin-bottom: 12px;
        font-weight: 600;">
        ℹ️ {{ session('info') }}
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div style="
        background: #dc2626; 
        color: white; 
        padding: 14px; 
        border-radius: 6px; 
        margin-bottom: 12px;
        font-weight: 600;">
        <strong>Validation Errors:</strong>
        <ul style="margin-top: 10px; margin-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div class="form-group">
              <label for="department" style="color: black; font-weight: bold; font-size: 15px;">Department</label>
              <div class="select-container">
                <i class="fas fa-building"></i>
                <select id="department"  name="department" class="form-control" required>
                  <option value="">Select Department</option>
                  <option value="gold" data-icon="fa-gem">Gold</option>
                  <option value="silver" data-icon="fa-coins">Silver</option>
                  <option value="diamond" data-icon="fa-gem">Diamond</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="type" style="color: black; font-weight: bold; font-size: 15px;">Type</label>
              <div class="select-container">
                <i class="fas fa-tag"></i>
                <select id="type" name="type" class="form-control" required>
                  <option value="">Select Type</option>
                  <option value="new" data-icon="fa-plus-circle">New</option>
                  <option value="repair" data-icon="fa-tools">Repair</option>
                  <option value="exchange" data-icon="fa-exchange-alt">Exchange</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="orderDate" style="color: black; font-weight: bold; font-size: 15px;">Date</label>
              <input type="date" id="orderDate" name="order_date" class="form-control" required>
            </div>

            <!-- Row 2 -->
            <div class="form-group">
              <label for="deliveryDate" style="color: black; font-weight: bold; font-size: 15px;">Delivery Date</label>
              <input type="date" id="deliveryDate" name="date" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="realDeliveryDate" style="color: black; font-weight: bold; font-size: 15px;">Real Delivery Date</label>
              <input type="date" id="realDeliveryDate" name="real_delivery_date" class="form-control">
            </div>

            <div class="form-group">
              <label for="goldPrice" style="color: black; font-weight: bold; font-size: 15px;">Gold Price for this Order</label>
              <input type="number" id="goldPrice" name="gold_price" class="form-control" step="0.01" min="0">
            </div>

            <!-- Row 3 -->
            <div class="form-group">
              <label for="partyName" style="color: black; font-weight: bold; font-size: 15px;">Party Name & No.</label>
              <input type="text" id="partyName" name="party_name" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="toSupplier" style="color: black; font-weight: bold; font-size: 15px;">To Supplier</label>
              <input type="text" id="toSupplier" name="to_supplier" class="form-control">
            </div>

            <div class="form-group">
              <label for="silverPrice" style="color: black; font-weight: bold; font-size: 15px;">Silver Price</label>
              <input type="number" id="silverPrice" name="silver_price" class="form-control" step="0.01" min="0">
            </div>

            <!-- Row 4 -->
            <div class="form-group">
              <label for="supplierDeliveryDate" style="color: black; font-weight: bold; font-size: 15px;">Delivery Date</label>
              <input type="date" id="supplierDeliveryDate" name="delivery_date" class="form-control" style="height: 40px;">
            </div>

            <div class="form-group">
              <label for="remark" style="color: black; font-weight: bold; font-size: 15px;">Remark</label>
              <input type="text" id="remark" name="remark" class="form-control" style="height: 40px;">
            </div>

            <div class="form-group" style="grid-column: 1 / -1; margin-top: 20px;">
              <div class="button-group" style="display: flex; gap: 10px; justify-content: flex-start;">
                <button type="button" class="btn btn-style" id="addLotItem" style="background-color: #0d6efd; color: white; padding: 8px 16px; border: none; border-radius: 4px; font-size: 13px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 6px; height: 40px;">
                  <i class="fas fa-plus"></i> Add Item
                </button>
                <button type="button" class="btn btn-reset" onclick="resetForm()" title="Reset form" style="background-color: #dc2626; color: white; padding: 8px 16px; border: none; border-radius: 4px; font-size: 13px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 6px; height: 40px;">
                  <i class="fas fa-undo"></i> Reset
                </button>
                <button type="submit" class="btn btn-style" style="background-color: #0266fc; color: white; padding: 8px 24px; border: none; border-radius: 4px; font-size: 13px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 6px; height: 40px;">
                  <i class="fas fa-save"></i> Save
                </button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Lot Items Section -->
        <div id="lotItemsSection" style="display: none;">
          <div id="lotItemsContainer">
            <!-- Lot items will be added here dynamically -->
          </div>
        </div>
       
        
      </form>
   
  <script src="scripts/dashboard.js"></script>
  <script>
    // Ensure page loads at the top
    window.onload = function () {
      window.scrollTo(0, 0);
      document.documentElement.scrollTop = 0;
      document.body.scrollTop = 0;
    };

    // Prevent scroll restoration on page reload
    if (history.scrollRestoration) {
      history.scrollRestoration = 'manual';
    }
    // Flag to control auto-scrolling when adding items
    let isInitialLoad = true;

    // Main initialization after DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
      // Ensure we're at the top of the page
      window.scrollTo(0, 0);
      document.documentElement.scrollTop = 0;
      document.body.scrollTop = 0;

      // Set default date to today
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('orderDate').value = today;

      // Get references to lot items section and add button
      const lotItemsSection = document.getElementById('lotItemsSection');
      const addLotItemBtn = document.getElementById('addLotItem');
      let isFirstClick = true;

      // Add lot item button click handler
      addLotItemBtn.addEventListener('click', function () {
        // Show the lot items section and add first item if it's the first click
        if (isFirstClick) {
          lotItemsSection.style.display = 'block';
          isFirstClick = false;
          isInitialLoad = false; // User-initiated add, enable scrolling
          addLotItem();
        } else {
          // For subsequent clicks, just add a new item
          addLotItem();
        }
      });

      // Form submission
      document.getElementById('orderForm').addEventListener('submit', function (e) {
        // e.preventDefault();
        // Add form submission logic here
        alert('Order saved successfully!');
      });

      // Don't add first lot item by default
      isInitialLoad = false; // Initial load complete, enable scrolling for future adds
    });

    let itemCounter = 0;

    function addLotItem() {
      itemCounter++;
      const container = document.getElementById('lotItemsContainer');
      const itemId = 'lotItem' + itemCounter;

      const lotItem = document.createElement('div');
      lotItem.className = 'lot-item';
      lotItem.id = itemId;

      lotItem.innerHTML = `
        <button type="button" style="color: black; font-weight: bold;" class="remove-item" onclick="removeLotItem('${itemId}')">×</button>
           <h2 style="color: black; font-weight: bold; font-size: 20px; position: relative; top: -8px;">Lot Items</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="category${itemCounter}" style="color: black; font-weight: bold;">Select Category</label>
            <div class="select-container">
              <i class="fas fa-tags"></i>
              <select id="category${itemCounter}"  name="items[${itemCounter}][category]" class="form-control" required>
                <option value="">Select Category</option>
                <option value="ring" data-icon="fa-ring">Ring</option>
                <option value="necklace" data-icon="fa-gem">Necklace</option>
                <option value="bangle" data-icon="fa-bolt">Bangle</option>
                <option value="earring" data-icon="fa-star">Earring</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label for="item${itemCounter}" style="color: black; font-weight: bold;">Select Item</label>
            <div class="select-container">
              <i class="fas fa-box-open"></i>
              <select id="item${itemCounter}"  name="items[${itemCounter}][item]"  class="form-control" required>
                <option value="">Select Item</option>
                <!-- Items will be populated based on category -->
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label for="tunch${itemCounter}" style="color: black; font-weight: bold;">Tunch</label>
            <input type="text" id="tunch${itemCounter}" name="items[${itemCounter}][tunch] class="form-control">
          </div>
          
          <div class="form-group">
            <label for="weight${itemCounter}" style="color: black; font-weight: bold;">Weight (g)</label>
            <input type="number" id="weight${itemCounter}" name="items[${itemCounter}][weight]" class="form-control" step="0.001" min="0" required>
          </div>
          
          <div class="form-group">
            <label for="pcs${itemCounter}" style="color: black; font-weight: bold;">PCS</label>
            <input type="number" id="pcs${itemCounter}" name="items[${itemCounter}][pcs]" class="form-control" min="1" value="1" required>
          </div>
          
          <div class="form-group">
            <label for="size${itemCounter}" style="color: black; font-weight: bold;">Size</label>
            <input type="text" id="size${itemCounter}" name="items[${itemCounter}][size]" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="length${itemCounter}" style="color: black; font-weight: bold;">Length</label>
            <input type="number" id="length${itemCounter}" name="items[${itemCounter}][length]" class="form-control" step="0.1" min="0">
          </div>
          
          <div class="form-group">
            <label for="hookStyle${itemCounter}" style="color: black; font-weight: bold;">Hook Style</label>
            <div class="select-container">
              <i class="fas fa-link"></i>
              <select id="hookStyle${itemCounter}" name="items[${itemCounter}][hook_style]" class="form-control" >
                <option value="">Select Hook Style</option>
                <option value="standard" data-icon="fa-link">Standard</option>
                <option value="lobster" data-icon="fa-link">Lobster Claw</option>
                <option value="spring" data-icon="fa-link">Spring Ring</option>
                <option value="fishhook" data-icon="fa-link">Fishhook</option>
              </select>
            </div>
          </div>
          
          <div class="form-group full-width">
            <label for="itemRemark${itemCounter}" style="color: black; font-weight: bold; font-size:15px">Remark</label>
            <input type="text" id="itemRemark${itemCounter}" name="items[${itemCounter}][remark]" class="form-control">
          </div>
          
          <div class="form-group full-width">
            <label style="color: black; font-weight: bold; font-size:15px">Image Upload</label>
            <div class="image-upload" onclick="document.getElementById('imageUpload${itemCounter}').click()">
              <i class="fas fa-cloud-upload-alt" style="font-size: 24px; margin-bottom: 8px;"></i>
              <div>Click to upload image</div>
              <input type="file" id="imageUpload${itemCounter}" name="items[${itemCounter}][image]" accept="image/*" style="display: none;" onchange="previewImage(this, 'preview${itemCounter}')">
              <img id="preview${itemCounter}" class="image-preview">
            </div>
          </div>
        </div>
      `;

      container.appendChild(lotItem);

        // Add event listener for category change
        const categorySelect = document.getElementById(`category${itemCounter}`);
      const itemSelect = document.getElementById(`item${itemCounter}`);

      if (categorySelect && itemSelect) {
        categorySelect.addEventListener('change', function () {
          updateItemsDropdown(this.value, itemSelect);
        });
      }

      // Only scroll to the newly added item if it's not the initial page load
      if (!isInitialLoad) {
        lotItem.scrollIntoView({ behavior: 'smooth' });
      }
    }

    function removeLotItem(id) {
      const item = document.getElementById(id);
      if (item) {
        item.remove();
      }
    }

    function updateItemsDropdown(category, itemSelect) {
      // Clear existing options
      itemSelect.innerHTML = '<option value="">Select Item</option>';

      // This is a simplified example - in a real app, you would fetch items based on the selected category
      const items = {
        'ring': ['Diamond Ring', 'Gold Ring', 'Silver Ring'],
        'necklace': ['Gold Chain', 'Pendant Set', 'Mangalsutra'],
        'bangle': ['Gold Bangle', 'Kada', 'Chudi'],
        'earring': ['Jhumka', 'Studs', 'Hoops']
      };

      if (category && items[category]) {
        items[category].forEach(item => {
          const option = document.createElement('option');
          option.value = item.toLowerCase().replace(/\s+/g, '-');
          option.textContent = item;
          itemSelect.appendChild(option);
        });
      }
    }

    function previewImage(input, previewId) {
      const preview = document.getElementById(previewId);
      const file = input.files[0];
      const reader = new FileReader();

      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };

      if (file) {
        reader.readAsDataURL(file);
      }
    }

    function resetForm() {
      if (!confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
        return;
      }

      // Reset the main form
      const form = document.getElementById('orderForm');
      form.reset();

      // Clear all lot items
      const container = document.getElementById('lotItemsContainer');
      container.innerHTML = '';

      // Reset the item counter
      itemCounter = 0;

      // Add a fresh lot item
      addLotItem();

      // Set default values
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('orderDate').value = today;

      // Reset any other specific fields if needed
      const selects = form.querySelectorAll('select');
      selects.forEach(select => {
        if (select.id !== 'department' && select.id !== 'type') {
          select.selectedIndex = 0;
        }
      });

      // Scroll to the top of the form
      window.scrollTo(0, 0);

      // Show a brief message (optional)
      const message = document.createElement('div');
      message.className = 'reset-message';
      message.textContent = 'Form has been reset';
      message.style.cssText = 'background: #4CAF50; color: black; padding: 10px; margin: 10px 0; border-radius: 4px; text-align: center;';

      const firstSection = form.querySelector('.form-section');
      form.insertBefore(message, firstSection);

      // Remove the message after 3 seconds
      setTimeout(() => {
        if (message.parentNode) {
          message.style.opacity = '0';
          setTimeout(() => message.remove(), 300);
        }
      }, 2000);

      // Focus on the first input field for better UX
      const firstInput = form.querySelector('input, select, textarea');
      if (firstInput) firstInput.focus();
    }
  </script>
</body>
@endsection
@extends('layouts.master')
@section('content')
<style>
  .alert,
  .alert-success,
  .alert-error {
    padding: 1rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .alert-success {
    background: #d1fae5;
    border: 1px solid #a7f3d0;
    color: #166534;
  }

  .alert-error {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #dc2626;
  }

  .alert-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    padding: 0;
  }

  /* Layout Styles */
  .layout {
    display: flex;
    min-height: 100vh;
  }

  .main-content {
    flex: 1;
    padding: 1.5rem;
    background-color: #f1f5f9;
    overflow-y: auto;
  }

  .card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
  }

  .form-actions {
    margin: 1.5rem 0;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
  }

  .btn {
    padding: 0.5rem 1.5rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

 `

    .btn-primary {
        background: #0d6efd;
        color: white;
    }

    .btn-outline {
        background: #e6f2ff;
        border: 1px solid #b3d1ff;
        color: #0d6efd;
    }

  .btn-outline:hover {
    background-color: #f3f4f6;
  }

  .form-group {
    margin-bottom: 1.25rem;
  }

  .form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 1rem;
  }

  .form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #374151;
  }

  .form-control {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    font-size: 0.9rem;
    transition: border-color 0.2s;
  }

  .form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }

  .form-select {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    background-color: white;
    font-size: 0.9rem;
  }

  .checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .checkbox-item input[type="checkbox"] {
    width: 18px;
    height: 18px;
  }

  .title {
    color: #000;
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
  }

  .section-title {
    color: #1f2937;
    font-size: 1.25rem;
    font-weight: 600;
    margin: 1.5rem 0 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e5e7eb;
  }

  .wastage-row {
    display: grid;
    grid-template-columns: 2fr 2fr 1fr auto;
    gap: 1rem;
    align-items: flex-end;
    margin-bottom: 1rem;
  }

  .wastage-list {
    margin-top: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
  }

  .wastage-item {
    display: grid;
    grid-template-columns: 2fr 2fr 1fr auto;
    gap: 1rem;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
    align-items: center;
  }

  .wastage-item:last-child {
    border-bottom: none;
  }

  .wastage-item button {
    background: none;
    border: none;
    color: #ef4444;
    cursor: pointer;
    padding: 0.25rem;
  }

  .wastage-item button:hover {
    color: #dc2626;
  }

  .action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
  }
</style>

</head>
{{--

<body>
  <div class="layout">

    <main class="content" style="position: relative;"> --}}
      <div style=" display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Add this RIGHT AFTER your existing session messages -->
        @if ($errors->any())
        <div class="alert-error">
          <i class="fas fa-exclamation-circle"></i>
          <div>
            <strong>Please fix these errors:</strong>
            <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i>
          {{ session('success') }}
          <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-error">
          <i class="fas fa-exclamation-circle"></i>
          {{ session('error') }}
          <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        @endif

        <h2 class="title" style="margin: 0; color: #000; font-size: 27px; font-weight: bold;">Account Registration</h2>

      </div>
      <div class="card" style="position: relative; top:-15px;">
        <form id="accountForm" action="{{ route('accounts.store') }}" method="POST">
          @csrf
          <div class="action-buttons"
            style="display: flex; gap: 10px; position: absolute; right:3%; position: flex; top:15px; ">
            <button type="reset" class="btn btn-outline btn-close"
              style="background-color: #e6f2ff; border-color: #b3d1ff; color: #0d6efd; transition: all 0.2s ease-in-out; padding: 0px 15px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; justify-content: center; height: 40px; min-width: 120px;">
              <i class="fas fa-undo me-1"></i> Reset
            </button>

            <a href="{{ route('accounts.index') }}" class="btn btn-outline">
                <i class="fas fa-list me-1"></i> Account List
           </a>
            <button type="submit" form="accountForm" class="btn btn-primary"
              style="background-color: #0d6efd; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 120px; display: flex; align-items: center; justify-content: center; height: 40px;">
              <i class="fas fa-save me-1"></i> Save <small style="margin-left: 5px; font-weight: normal;">(Ctrl +
                S)</small>
            </button>
          </div>
          <!-- Basic Information -->
          <div
            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <div>
              <h3 class="section-title"
                style="margin: 0 0 5px 0; color: #000; font-size: 20px; font-weight: bold; display: inline-block; border:none; padding-bottom: 5px; ">
                Register</h3>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="name" class="form-label" style="color: #000; font-size: 15px;">Name <span
                  class="text-red-500">*</span></label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="code" class="form-label" style="color: #000; font-size: 15px;">Code</label>
              <input type="text" id="code" name="code" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="mobile" class="form-label" style="color: #000; font-size: 15px;">Mobile <small>(comma
                  separated for multiple)</small></label>
              <input type="text" id="mobile" name="mobile" class="form-control"
                placeholder="e.g. 9876543210, 9876543211">
            </div>

            <div class="form-group">
              <label for="email" class="form-label" style="color: #000; font-size: 15px;">Email <small>(comma separated
                  for multiple)</small></label>
              <input type="text" id="email" name="email" class="form-control"
                placeholder="e.g. email@example.com, email2@example.com">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="accountGroup" class="form-label" style="color: #000; font-size: 15px;">Account Group</label>
              <select id="accountGroup" name="account_group" class="form-control">
                <option value="">Select Account Group</option>
                <option value="customer">Customer</option>
                <option value="supplier">Supplier</option>
                <option value="bank">Bank</option>
                <option value="cash">Cash</option>
              </select>
            </div>

            <div class="form-group" style="display: flex; align-items: flex-end;">
              <label for="remark" class="form-label" style="color: #000; font-size: 15px;">Remarks</label>
              <input type="text" id="remark" name="remark" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group" style="grid-column: 1 / -1;">
              <label class="checkbox-item"
                style="color: #000; font-size: 15px; margin-bottom: 0.5rem; position:relative; right: 45%;">
                <input type="checkbox" id="isSupplier" name="is_supplier">&nbsp; Is Supplier?
              </label>
            </div>
          </div>

          <!-- Opening Balances -->
          <h3 class="section-title" style="margin-bottom: 20px; color: #000; font-size: 20px; font-weight: bold;">
            Opening Balance</h3>

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group" style="margin: 0;">
              <label for="openingGold" class="form-label" style="color: #000; font-size: 15px;">Opening Balance
                (Gold)</label>
              <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                <input type="number" id="openingGold" name="opening_gold" class="form-control" step="0.001"
                  style="width: calc(100% - 90px);">
                <select class="form-control" name="opening_gold_type"
                  style="width: 90px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                  <option value="debit">Debit</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>

            <div class="form-group" style="margin: 0;">
              <label for="openingSilver" class="form-label" style="color: #000; font-size: 15px;">Opening Balance
                (Silver)</label>
              <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                <input type="number" id="openingSilver" name="opening_silver" class="form-control" step="0.01"
                  style="width: calc(100% - 90px);">
                <select class="form-control" name="opening_silver_type"
                  style="width: 80px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                  <option value="debit">Debit</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
            <div class="form-group" style="margin: 0;">
              <label for="openingRupees" class="form-label" style="color: #000; font-size: 15px;">Opening Balance
                (Rupees)</label>
              <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                <input type="number" id="openingRupees" name="opening_rupees" class="form-control" step="0.01"
                  style="width: calc(100% - 90px);">
                <select class="form-control" name="opening_rupees_type"
                  style="width: 90px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                  <option value="debit">Debit</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>

            <div class="form-group" style="margin: 0;">
              <label for="pricePerPcs" class="form-label" style="color: #000; font-size: 15px;">Price/Per Pcs</label>
              <input type="number" id="pricePerPcs" name="price_per_pcs" class="form-control" step="0.01">
            </div>
          </div>

          <!-- Itemwise Wastage -->
          <h3 class="section-title" style="margin-bottom: 20px; color: #000; font-size: 19px; font-weight: bold;">
            Itemwise Wastage</h3>

          <div class="wastage-row">
            <div class="form-group">
              <label for="wastageCategory" class="form-label" style="color: #000; font-size: 15px;">Category</label>
              <select id="wastageCategory" name="wastage_category" class="form-control">
                <option value="">Select Category</option>
                <option value="gold">Gold</option>
                <option value="silver">Silver</option>
                <option value="diamond">Diamond</option>
              </select>
            </div>

            <div class="form-group">
              <label for="wastageItem" class="form-label" style="color: #000; font-size: 15px;">Item</label>
              <select id="wastageItem" name="wastage_item" class="form-control">
                <option value="">Select Item</option>
              </select>
            </div>

            <div class="form-group">
              <label for="wastage" class="form-label" style="color: #000; font-size: 15px;">Wastage %</label>
              <input type="number" id="wastage" name="wastage_percent" class="form-control" step="0.01"
                placeholder="0.00">
            </div>

            <button type="button" class="btn btn-primary"
              style="margin-bottom: 1.7rem; background-color: #0d6efd; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 100px;">
              <i class="fas fa-plus"></i> Add Item
            </button>
          </div>

          <div class="wastage-list">
            
          </div>
      </div>


      </form>
  </div>
  {{--
  </main>
  </div> --}}
  <script>
    // CTRL + S to save
document.addEventListener("keydown", function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key === "s") {
        e.preventDefault();
        document.getElementById("accountForm").submit();
    }
});

// Wastage item index
let wastageIndex = 0;

// Add Wastage Item 
document.querySelector('.wastage-row button').addEventListener('click', function () {
    const categorySelect = document.getElementById('wastageCategory');
    const itemSelect = document.getElementById('wastageItem');
    const wastageInput = document.getElementById('wastage');

    const category = categorySelect.value;
    const item = itemSelect.value;
    const wastage = wastageInput.value;

    const categoryText = categorySelect.selectedOptions[0]?.text || "";
    const itemText = itemSelect.selectedOptions[0]?.text || "";

    // Validation
    if (!category || !item || !wastage) {
        alert("Please fill all wastage fields");
        return;
    }

    // Wastage list container
    const list = document.querySelector('.wastage-list');

    // Create new row
    const row = document.createElement('div');
    row.classList.add('wastage-item');

    row.innerHTML = `
        <div>${categoryText}</div>
        <div>${itemText}</div>
        <div>${wastage}%</div>
        <div>
            <button type="button" class="remove-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <input type="hidden" name="wastage[${wastageIndex}][category]" value="${category}">
        <input type="hidden" name="wastage[${wastageIndex}][item]" value="${item}">
        <input type="hidden" name="wastage[${wastageIndex}][percent]" value="${wastage}">
    `;

    // Remove button function
    row.querySelector(".remove-btn").addEventListener("click", function () {
        row.remove();
    });

    // Add to list
    list.appendChild(row);

    // Increase index
    wastageIndex++;

    // Reset fields
    categorySelect.value = "";
    itemSelect.innerHTML = '<option value="">Select Item</option>';
    wastageInput.value = "";
});

// Items by category
const categoryItems = {
    gold: ["22K Gold Chain", "24K Gold Ring", "18K Gold Bangle"],
    silver: ["Silver Chain", "Silver Ring", "Silver Bangle"],
    diamond: ["Diamond Ring", "Diamond Pendant", "Diamond Earrings"]
};

document.getElementById('wastageCategory').addEventListener('change', function () {
    const category = this.value;
    const items = categoryItems[category] || [];

    const itemSelect = document.getElementById('wastageItem');
    itemSelect.innerHTML = '<option value="">Select Item</option>';

    items.forEach(item => {
        const option = document.createElement('option');
        option.value = item.toLowerCase().replace(/\s+/g, '-');
        option.textContent = item;
        itemSelect.appendChild(option);
    });
});

  </script>

  @endsection
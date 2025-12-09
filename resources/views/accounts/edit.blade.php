@extends('layouts.master')
@section('content')

<style>
    /* === All your existing styles (copied exactly) === */
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

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        height: 40px;
        min-width: 120px;
    }

    .btn-primary {
        background: #0d6efd;
        color: white;
    }

    .btn-outline {
        background: #e6f2ff;
        border: 1px solid #b3d1ff;
        color: #0d6efd;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #000;
        font-size: 15px;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .section-title {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        margin: 1.5rem 0 1rem;
        padding-bottom: 10px;
        border-bottom: 2px solid #e5e7eb;
    }

    .wastage-row {
        display: grid;
        grid-template-columns: 2fr 2fr 1fr auto;
        gap: 1rem;
        align-items: end;
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
        background: #f9fafb;
    }

    .wastage-item:last-child {
        border-bottom: none;
    }

    .wastage-item button {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
    }

    .wastage-item button:hover {
        color: #dc2626;
    }
</style>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    @if($errors->any())
    <div class="alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div><strong>Please fix these errors:</strong>
            <ul style="margin:0.5rem 0 0;padding-left:1.5rem;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">x</button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">x</button>
    </div>
    @endif

    <h2 style="margin:0;color:#000;font-size:27px;font-weight:bold;">Edit Account</h2>
</div>

<div class="card" style="top:-15px;">
    <form id="accountForm" action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Action Buttons -->
        <div style="position:absolute;top:15px;right:3%;display:flex;gap:10px;z-index:10;">
            <button type="reset" class="btn btn-outline"><i class="fas fa-undo me-1"></i> Reset</button>
            <a href="{{ route('accounts.index') }}" class="btn btn-outline">
                <i class="fas fa-list me-1"></i> Account List
           </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Update <small>(Ctrl + S)</small>
            </button>
        </div>

        <div style="border-bottom:2px solid #e5e7eb;padding-bottom:10px;margin-bottom:20px;">
            <h3 class="section-title">Edit Account - {{ $account->name }}</h3>
        </div>

        <!-- Basic Info -->
        <div class="form-row">
            <div class="form-group">
                <label>Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $account->name) }}" required>
            </div>
            <div class="form-group">
                <label>Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $account->code) }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Mobile <small>(comma separated)</small></label>
                <input type="text" name="mobile" class="form-control"
                    value="{{ old('mobile', implode(', ', $account->mobile ?? [])) }}"
                    placeholder="9876543210, 9876543211">
            </div>
            <div class="form-group">
                <label>Email <small>(comma separated)</small></label>
                <input type="text" name="email" class="form-control"
                    value="{{ old('email', implode(', ', $account->email ?? [])) }}"
                    placeholder="a@example.com, b@example.com">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Account Group</label>
                <select name="account_group" class="form-control">
                    <option value="">Select Account Group</option>
                    <option value="customer" {{ old('account_group', $account->account_group) == 'customer' ? 'selected'
                        : '' }}>Customer</option>
                    <option value="supplier" {{ old('account_group', $account->account_group) == 'supplier' ? 'selected'
                        : '' }}>Supplier</option>
                    <option value="bank" {{ old('account_group', $account->account_group) == 'bank' ? 'selected' : ''
                        }}>Bank</option>
                    <option value="cash" {{ old('account_group', $account->account_group) == 'cash' ? 'selected' : ''
                        }}>Cash</option>
                </select>
            </div>
            <div class="form-group">
                <label>Remarks</label>
                <input type="text" name="remark" class="form-control" value="{{ old('remark', $account->remark) }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group" style="color: #000; font-size: 15px; margin-bottom: 0.5rem; position:relative; right: 40%;">
                <label class="checkbox-item">
                    <input type="checkbox" name="is_supplier" {{ old('is_supplier', $account->is_supplier) ? 'checked' :
                    '' }}>
                    &nbsp; Is Supplier?
                </label>
            </div>
        </div>

        <!-- Opening Balances -->
        <h3 class="section-title">Opening Balance</h3>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group" style="margin: 0;">
                <label for="openingGold" class="form-label" style="color: #000; font-size: 15px;">Opening Balance
                    (Gold)</label>
                <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                    <input type="number" id="openingGold" name="opening_gold" class="form-control" step="0.001"
                        value="{{ old('opening_gold', $account->opening_gold ?? 0) }}"
                        style="width: calc(100% - 90px);">
                    <select class="form-control" name="opening_gold_type"
                        style="width: 90px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                        <option value="debit" {{ old('opening_gold_type', $account->gold_type ?? 'debit') == 'debit' ?
                            'selected' : '' }}>Debit</option>
                        <option value="credit" {{ old('opening_gold_type', $account->gold_type ?? 'debit') == 'credit' ?
                            'selected' : '' }}>Credit</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin: 0;">
                <label for="openingSilver" class="form-label" style="color: #000; font-size: 15px;">Opening Balance
                    (Silver)</label>
                <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                    <input type="number" id="openingSilver" name="opening_silver" class="form-control" step="0.01"
                       value="{{ old('opening_silver', $account->opening_silver ?? 0) }}"  style="width: calc(100% - 90px);">
                    <select class="form-control" name="opening_silver_type"
                        style="width: 80px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                       <option value="debit" {{ old('opening_silver_type', $account->silver_type ?? 'debit') == 'debit' ? 'selected' : '' }}>Debit</option>
            <option value="credit" {{ old('opening_silver_type', $account->silver_type ?? 'debit') == 'credit' ? 'selected' : '' }}>Credit</option>
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
                         value="{{ old('opening_rupees', $account->opening_rupees ?? 0) }}" style="width: calc(100% - 90px);">
                    <select class="form-control" name="opening_rupees_type"
                        style="width: 90px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                       <option value="debit" {{ old('opening_rupees_type', $account->rupees_type ?? 'debit') == 'debit' ? 'selected' : '' }}>Debit</option>
            <option value="credit" {{ old('opening_rupees_type', $account->rupees_type ?? 'debit') == 'credit' ? 'selected' : '' }}>Credit</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin: 0;">
                <label for="pricePerPcs" class="form-label" style="color: #000; font-size: 15px;">Price/Per Pcs</label>
                <input type="number" id="pricePerPcs" name="price_per_pcs" class="form-control" value="{{ old('price_per_pcs', $account->price_per_pcs) }}" step="0.01">
            </div>
        </div>
        <!-- Itemwise Wastage -->
        <h3 class="section-title" style="font-size:19px;">Itemwise Wastage</h3>

        <div class="wastage-row">
            <div class="form-group">
                <label>Category</label>
                <select id="wastageCategory" class="form-control">
                    <option value="">Select Category</option>
                    <option value="gold">Gold</option>
                    <option value="silver">Silver</option>
                    <option value="diamond">Diamond</option>
                </select>
            </div>
            <div class="form-group">
                <label>Item</label>
                <select id="wastageItem" class="form-control">
                    <option value="">Select Item</option>
                </select>
            </div>
            <div class="form-group">
                <label>Wastage %</label>
                <input type="number" id="wastagePercent" step="0.01" class="form-control" placeholder="0.00">
            </div>
            <button type="button" class="btn btn-primary add-wastage-btn">
                Add Item
            </button>
        </div>

        <div class="wastage-list" id="wastageList"></div>
    </form>
</div>

<script>
    // Ctrl + S to save
  document.addEventListener('keydown', e => {
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
      e.preventDefault();
      document.getElementById('accountForm').submit();
    }
  });

  let wastageIndex = 0;
  const wastageList = document.getElementById('wastageList');

  const categoryItems = {
    gold: ["22K Gold Chain", "24K Gold Ring", "18K Gold Bangle"],
    silver: ["Silver Chain", "Silver Ring", "Silver Bangle"],
    diamond: ["Diamond Ring", "Diamond Pendant", "Diamond Earrings"]
  };

  // Populate items when category changes
  document.getElementById('wastageCategory').addEventListener('change', function() {
    const items = categoryItems[this.value] || [];
    const select = document.getElementById('wastageItem');
    select.innerHTML = '<option value="">Select Item</option>';
    items.forEach(item => {
      const opt = document.createElement('option');
      opt.value = item.toLowerCase().replace(/\s+/g, '-');
      opt.textContent = item;
      select.appendChild(opt);
    });
  });

  // Add new wastage row
  document.querySelector('.add-wastage-btn').addEventListener('click', () => {
    const catSelect = document.getElementById('wastageCategory');
    const itemSelect = document.getElementById('wastageItem');
    const percent = document.getElementById('wastagePercent').value.trim();

    const cat = catSelect.value;
    const item = itemSelect.value;
    const catText = catSelect.selectedOptions[0]?.text || '';
    const itemText = itemSelect.selectedOptions[0]?.text || '';

    if (!cat || !item || !percent) {
      alert('Please fill all wastage fields');
      return;
    }

    const row = document.createElement('div');
    row.className = 'wastage-item';
    row.innerHTML = `
      <div>${catText}</div>
      <div>${itemText}</div>
      <div>${percent}%</div>
      <div><button type="button" class="remove-btn">Remove</button></div>
      <input type="hidden" name="wastage[${wastageIndex}][category]" value="${cat}">
      <input type="hidden" name="wastage[${wastageIndex}][item]" value="${item}">
      <input type="hidden" name="wastage[${wastageIndex}][percent]" value="${percent}">
    `;

    row.querySelector('.remove-btn').onclick = () => row.remove();
    wastageList.appendChild(row);
    wastageIndex++;

    // Reset inputs
    catSelect.value = '';
    itemSelect.innerHTML = '<option value="">Select Item</option>';
    document.getElementById('wastagePercent').value = '';
  });

  // Load existing wastage items on page load
  document.addEventListener('DOMContentLoaded', () => {
    @if($account->wastage && is_array($account->wastage))
      @foreach($account->wastage as $item)
        (function() {
          const cat = "{{ $item['category'] ?? '' }}";
          const itemVal = "{{ $item['item'] ?? '' }}";
          const percent = "{{ $item['percent'] ?? '' }}";

          const catText = cat === 'gold' ? 'Gold' : cat === 'silver' ? 'Silver' : 'Diamond';
          const itemText = itemVal.split('-').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');

          const row = document.createElement('div');
          row.className = 'wastage-item';
          row.innerHTML = `
            <div>${catText}</div>
            <div>${itemText}</div>
            <div>${percent}%</div>
            <div><button type="button" class="remove-btn">Remove</button></div>
            <input type="hidden" name="wastage[${wastageIndex}][category]" value="${cat}">
            <input type="hidden" name="wastage[${wastageIndex}][item]" value="${itemVal}">
            <input type="hidden" name="wastage[${wastageIndex}][percent]" value="${percent}">
          `;
          row.querySelector('.remove-btn').onclick = () => row.remove();
          wastageList.appendChild(row);
          wastageIndex++;
        })();
      @endforeach
    @endif
  });
</script>

@endsection
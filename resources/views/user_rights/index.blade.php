@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
  /* Layout Styles */
  .layout {
    display: flex;
    min-height: 100vh;
  }

  .main-content {
    flex: 1;
    padding: 2rem;
    background-color: #f1f5f9;
    overflow-y: auto;
  }

  .card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
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
  }

  .btn-primary {
    background-color: #2563eb;
    color: white;
  }

  .btn-primary:hover {
    background-color: #1d4ed8;
  }

  .btn-outline {
    background: white;
    border: 1px solid #d1d5db;
    color: #374151;
  }

  .btn-outline:hover {
    background-color: #f3f4f6;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    background: white;
    border-radius: 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
  }

  td {
    padding: 1rem 1.25rem;
    text-align: left !important;
    vertical-align: middle;
    border: 1px solid #e2e8f0;
    line-height: 1.4;
    color: #2d3748;
    transition: background-color 0.2s ease;
  }

  th {
    background-color: #f8fafc;
    font-weight: 600;
    color: #4a5568;
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.05em;
    padding: 0.75rem 1.25rem;
    border: 1px solid #e2e8f0;
    text-align: left !important;
  }

  tr:last-child td {
    border-bottom: none;
  }

  .module-name {
    font-weight: 600;
    color: #1a202c;
    font-size: 0.8rem;
    padding: 0.75rem 1.25rem;
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-bottom: none;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: left !important;
  }

  .sub-module {
    position: relative;
    color: #2d3748;
    font-weight: 500;
    font-size: 0.75rem;
    padding: 0.75rem 1.25rem;
    border: 1px solid #e2e8f0;
    border-top: none;
    background-color: #ffffff;
    transition: all 0.1s ease;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: left !important;
  }

  tr:hover .sub-module {
    background-color: #f8fafc;
  }

  .checkbox-group {
    display: flex;
    gap: 0.3rem;
    flex-wrap: wrap;
    align-items: center;
    padding: 0.05rem 0;
    line-height: 1.1;
  }

  .checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.2rem;
    white-space: nowrap;
    font-size: 0.75rem;
    color: #4a5568;
    padding: 0.1rem 0.3rem;
    border-radius: 2px;
    transition: all 0.1s ease;
    margin: 0.02rem 0;
    line-height: 1.1;
  }

  .checkbox-item input[type="checkbox"] {
    width: 0.8em;
    height: 0.8em;
    border: 1px solid #d1d5db;
    border-radius: 0.1em;
    margin: 0;
    cursor: pointer;
    flex-shrink: 0;
  }

  .checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.2rem;
    cursor: pointer;
    padding: 0.1rem 0.3rem;
    border-radius: 2px;
    transition: all 0.08s;
  }

  .checkbox-item:hover {
    background-color: #f0f9ff;
    transform: translateY(-0.5px);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
  }

  .checkbox-item input[type="checkbox"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #cbd5e0;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    position: relative;
    transition: all 0.2s ease;
    margin: 0;
    vertical-align: middle;
    flex-shrink: 0;
  }

  .checkbox-item input[type="checkbox"]:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
  }

  .checkbox-item input[type="checkbox"]:checked::after {
    content: '✓';
    position: absolute;
    color: white;
    font-size: 12px;
    font-weight: bold;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }

  .checkbox-item input[type="checkbox"]:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    border-color: #3b82f6;
  }

  /* Checkbox group container */
  .checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    align-items: center;
    padding: 0.5rem 0;
    align-content: flex-start;
  }

  /* Checkbox item styling */
  .checkbox-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
    cursor: pointer;
    font-size: 0.9rem;
    color: #374151;
    font-weight: 500;
    white-space: nowrap;
    line-height: 1;
    padding: 2px 0;
  }

  /* Hide default checkbox */
  .checkbox-item input[type="checkbox"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    min-width: 18px;
    /* Ensures it stays square */
    min-height: 18px;
    /* Ensures it stays square */
    border: 2px solid #d1d5db;
    border-radius: 4px;
    margin: 0;
    position: relative;
    cursor: pointer;
    vertical-align: middle;
    transition: all 0.2s ease;
    box-sizing: border-box;
    /* Ensures padding and border are included in the element's total width and height */
    flex-shrink: 0;
    /* Prevents the checkbox from shrinking */
  }

  /* Checked state */
  .checkbox-item input[type="checkbox"]:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  /* Checkmark */
  .checkbox-item input[type="checkbox"]:checked::after {
    content: '✓';
    position: absolute;
    color: white;
    font-size: 12px;
    font-weight: bold;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }

  /* Focus state */
  .checkbox-item input[type="checkbox"]:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
  }

  /* Hover state */
  .checkbox-item:hover input[type="checkbox"] {
    border-color: #9ca3af;
  }

  .checkbox-item:active input[type="checkbox"] {
    transform: scale(0.95);
  }

  /* Label styling */
  .checkbox-item label {
    cursor: pointer;
    user-select: none;
    margin: 0;
    font-size: 0.9rem;
    color: #374151;
    font-weight: 500;
    transition: color 0.2s ease;
    display: inline;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .checkbox-group {
      gap: 1rem;
    }

    .checkbox-item {
      font-size: 0.85rem;
    }
  }

  .checkbox-item:hover label {
    color: black;
  }
</style>
</head>

<body>
  <div class="layout">


    <main class="content">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title" style="color: black; font-weight: 700; font-size: 24px; margin: 0;">User Rights Management
        </h2>
        <div class="d-flex gap-3">
          <button type="reset" id="actualResetBtn" class="btn btn-outline btn-style btn-reset"
            style="border: 1px solid #e2e8f0; padding: 0.5rem 1.25rem; font-weight: 500;">
            <i class="fas fa-undo me-2"></i>Reset
          </button>

          <button type="submit" id="resetBtn" form="userRightsForm" class="btn btn-primary"
            style="padding: 0.5rem 1.5rem; font-weight: 500; background-color: #0d6efd;">
            <i class="fas fa-save me-2"></i>Save
          </button>
        </div>
      </div><br>
      <div class="card">

        <form id="userRightsForm" method="POST" action="{{ route('user_rights.store') }}">
          @csrf
          <table class="rights-table" style="table-layout: fixed; width: 100%;">
            <colgroup>
              <col style="width: 20%; min-width: 160px;">
              <col style="width: 80%;">
            </colgroup>
            <thead>
              <tr>
                <th
                  style="color: #000; font-weight: bold; font-size: 15px; padding: 0.6rem 1rem; text-transform: uppercase; letter-spacing: 0.03em;">
                  Module / Sub-Module</th>
                <th style="color: #000; font-weight: 600; font-size: 0.9rem; padding: 0.75rem 1rem;">Permissions</th>
              </tr>
            </thead>
            <tbody>
              <!-- 1. Master >> AD Master -->
              <tr>
                <td class="sub-module"
                  style="color: #000; font-weight: bold; font-size: 15px; padding: 0.6rem 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                  title="Master >> AD Master">Master >> Ad master</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="ad_master_view" {{ old('ad_master_view', $userRights->ad_master_view
                      ?? false) ? 'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="ad_master_add" {{ old('ad_master_add', $userRights->ad_master_add ??
                      false) ? 'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="ad_master_edit" {{ old('ad_master_edit', $userRights->ad_master_edit
                      ?? false) ? 'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="ad_master_delete" {{ old('ad_master_delete',
                        $userRights->ad_master_delete ?? false) ? 'checked' : '' }}> Delete
                    </label>
                </td>
              </tr>

              <!-- 2. Master >> Stamp -->
              <tr>
                <td class="sub-module" style="color: #000; font-weight: bold; font-size: 15px;">Master >> Stamp</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="stamp_view" {{ old('stamp_view', $userRights->stamp_view ?? false) ?
                      'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stamp_add" {{ old('stamp_add', $userRights->stamp_add ?? false) ?
                      'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stamp_edit" {{ old('stamp_edit', $userRights->stamp_edit ?? false) ?
                      'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stamp_delete" {{ old('stamp_delete', $userRights->stamp_delete ??
                      false) ? 'checked' : '' }} > Delete
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 3. Account  only A is capital and oher is small -->
              <tr>
                <td
                  style="color: #000; font-weight: bold; font-size: 15px; padding: 0.6rem 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; ">
                  Account</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_view" {{ old('account_view', $userRights->account_view ??
                      false) ? 'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_add" {{ old('account_add', $userRights->account_add ?? false)
                      ? 'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_edit" {{ old('account_edit', $userRights->account_edit ??
                      false) ? 'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_delete" {{ old('account_delete', $userRights->account_delete
                      ?? false) ? 'checked' : '' }} > Delete
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_approve" {{ old('account_approve',
                        $userRights->account_approve ?? false) ? 'checked' : '' }}> Approve
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_ledger" {{ old('account_ledger', $userRights->account_ledger
                      ?? false) ? 'checked' : '' }}> Customer Ledger
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_opening" {{ old('account_opening',
                        $userRights->account_opening ?? false) ? 'checked' : '' }} > Allow Add Opening
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 4. Account >> Account Group -->
              <tr>
                <td class="sub-module" style="color: #000; font-weight: bold; font-size: 15px;">Account >> Account group
                </td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_group_view" {{ old('account_group_view',
                        $userRights->account_group_view ?? false) ? 'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_group_add" {{ old('account_group_add',
                        $userRights->account_group_add ?? false) ? 'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_group_edit" {{ old('account_group_edit',
                        $userRights->account_group_edit ?? false) ? 'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="account_group_delete" {{ old('account_group_delete',
                        $userRights->account_group_delete ?? false) ? 'checked' : '' }}> Delete
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 5. Order -->
              <tr>
                <td style="color: #000; font-weight: bold; font-size: 15px;">Order</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_view" {{ old('order_view', $userRights->order_view ?? false) ?
                      'checked' : '' }}> View
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 6. Order >> Order -->
              <tr>
                <td class="sub-module" style="color: #000; font-weight: bold; font-size: 15px;">Order >> Order</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_order_view" {{ old('order_order_view',
                        $userRights->order_order_view ?? false) ? 'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_order_add" {{ old('order_order_add',
                        $userRights->order_order_add ?? false) ? 'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_order_edit" {{ old('order_order_edit',
                        $userRights->order_order_edit ?? false) ? 'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_order_delete" {{ old('order_order_delete',
                        $userRights->order_order_delete ?? false) ? 'checked' : '' }}> Delete
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_order_show_party" {{ old('order_order_show_party',
                        $userRights->order_order_show_party ?? false) ? 'checked' : '' }}> Show Party Name
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 7. Order >> Order Slider -->
              <tr>
                <td class="sub-module" style="color: #000; font-weight: bold; font-size: 15px;">Order >> Order slider
                </td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="order_slider_view" {{ old('order_slider_view',
                        $userRights->order_slider_view ?? false) ? 'checked' : '' }}> View
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 8. Sell/Purchase -->
              <tr>
                <td style="color: #000; font-weight: bold; font-size: 15px;">Sell/purchase</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="sell_purchase_view" {{ old('sell_purchase_view',
                        $userRights->sell_purchase_view ?? false) ? 'checked' : '' }}> View
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 9. Sell/Purchase >> Sell/Purchase -->
              <tr>
                <td class="sub-module"
                  style="color: #000; font-weight: bold; font-size: 15px; padding: 0.6rem 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  Sell/purchase >> Sell/purchase</td>
                <td>
                  <div class="checkbox-group"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 10px; align-items: center;">
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_view" {{ old('sp_view', $userRights->sp_view ?? false) ? 'checked'
                      : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_add" {{ old('sp_add', $userRights->sp_add ?? false) ? 'checked' :
                      '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_edit" {{ old('sp_edit', $userRights->sp_edit ?? false) ? 'checked'
                      : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_delete" {{ old('sp_delete', $userRights->sp_delete ?? false) ?
                      'checked' : '' }}> Delete
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_item_list" {{ old('sp_item_list', $userRights->sp_item_list ??
                      false) ? 'checked' : '' }}> Sell/purchase item list
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_allow_out_of_range" {{ old('sp_allow_out_of_range',
                        $userRights->sp_allow_out_of_range ?? false) ? 'checked' : '' }}> Allow to save gold/silver bhav
                      out of range
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_allow_credit_limit" {{ old('sp_allow_credit_limit',
                        $userRights->sp_allow_credit_limit ?? false) ? 'checked' : '' }}> Allow to save out of credit
                      limit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_change_wastage" {{ old('sp_change_wastage',
                        $userRights->sp_change_wastage ?? false) ? 'checked' : '' }}> Allow change wastage
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_audit_suspect" {{ old('sp_audit_suspect',
                        $userRights->sp_audit_suspect ?? false) ? 'checked' : '' }}> Allow to audit/suspect
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_audit_pending" {{ old('sp_audit_pending',
                        $userRights->sp_audit_pending ?? false) ? 'checked' : '' }}> Allow to audit/suspect to pending
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_change_data" {{ old('sp_change_data', $userRights->sp_change_data
                      ?? false) ? 'checked' : '' }}> Allow change data
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="sp_adjust_cr_amount" {{ old('sp_adjust_cr_amount',
                        $userRights->sp_adjust_cr_amount ?? false) ? 'checked' : '' }}> Adjust C/R amount allowed
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 10. Sell/Purchase >> Other Entry -->
              <tr>
                <td class="sub-module" style="color: #000; font-weight: bold; font-size: 15px;">Sell/purchase >> Other
                  entry</td>
                <td>
                  <div class="checkbox-group">
                    <label class="checkbox-item">
                      <input type="checkbox" name="other_entry_view" {{ old('other_entry_view',
                        $userRights->other_entry_view ?? false) ? 'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="other_entry_add" {{ old('other_entry_add',
                        $userRights->other_entry_add ?? false) ? 'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="other_entry_edit" {{ old('other_entry_edit',
                        $userRights->other_entry_edit ?? false) ? 'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="other_entry_delete" {{ old('other_entry_delete',
                        $userRights->other_entry_delete ?? false) ? 'checked' : '' }}> Delete
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="other_entry_change_data" {{ old('other_entry_change_data',
                        $userRights->other_entry_change_data ?? false) ? 'checked' : '' }}> Allow change data
                    </label>
                  </div>
                </td>
              </tr>

              <!-- 11. Stock Transfer -->
              <tr>
                <td style="color: #000; font-weight: bold; font-size: 15px;">Stock transfer</td>
                <td>
                  <div class="checkbox-group" style="flex-wrap: wrap; gap: 0.5rem 1.5rem;">
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_view" {{ old('stock_transfer_view',
                        $userRights->stock_transfer_view ?? false) ? 'checked' : '' }}> View
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_add" {{ old('stock_transfer_add',
                        $userRights->stock_transfer_add ?? false) ? 'checked' : '' }}> Add
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_edit" {{ old('stock_transfer_edit',
                        $userRights->stock_transfer_edit ?? false) ? 'checked' : '' }}> Edit
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_delete" {{ old('stock_transfer_delete',
                        $userRights->stock_transfer_delete ?? false) ? 'checked' : '' }}> Delete
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_change_wastage" {{
                        old('stock_transfer_change_wastage', $userRights->stock_transfer_change_wastage ?? false) ?
                      'checked' : '' }}> Allow change wastage
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_is_guard" {{ old('stock_transfer_is_guard',
                        $userRights->stock_transfer_is_guard ?? false) ? 'checked' : '' }}> Is Guard
                    </label>
                    <label class="checkbox-item">
                      <input type="checkbox" name="stock_transfer_audit_suspect" {{ old('stock_transfer_audit_suspect',
                        $userRights->stock_transfer_audit_suspect ?? false) ? 'checked' : '' }}> Allow to audit/suspect
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>


        </form>
      </div>
    </main>
  </div>

  <script src="scripts/dashboard.js"></script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
    // FIXED: Listen to the ACTUAL reset button
    const resetBtn = document.getElementById('actualResetBtn');
    const form = document.getElementById('userRightsForm');
    
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent any default behavior
            
            // Reset form completely
            form.reset();
            
            // Remove ALL active classes from checkbox items
            document.querySelectorAll('.checkbox-item').forEach(item => {
                item.classList.remove('checkbox-active');
            });
            
            console.log('Form reset successfully!'); // Debug log
        });
    }
    
    // Checkbox active state management
    document.querySelectorAll('.checkbox-item').forEach(item => {
        const checkbox = item.querySelector('input[type="checkbox"]');
        
        // Set initial state
        if (checkbox.checked) {
            item.classList.add('checkbox-active');
        }
        
        // Toggle on change
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                item.classList.add('checkbox-active');
            } else {
                item.classList.remove('checkbox-active');
            }
        });
        
        // Click entire label
        item.addEventListener('click', function(e) {
            if (e.target !== checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });
});

    // Add any JavaScript functionality here
    // document.getElementById('userRightsForm').addEventListener('submit', function(e) {
    //   e.preventDefault();
      // Add form submission logic here
    //   alert('User rights updated successfully!');
    // });

    // Add active state to checkboxes
    document.querySelectorAll('.checkbox-item').forEach(item => {
      const checkbox = item.querySelector('input[type="checkbox"]');
      
      // Add active class when checkbox is checked
      if (checkbox.checked) {
        item.classList.add('checkbox-active');
      }
      
      // Toggle active class on change
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          item.classList.add('checkbox-active');
        } else {
          item.classList.remove('checkbox-active');
        }
      });
      
      // Add click handler to the entire label for better UX
      item.addEventListener('click', function(e) {
        // Only toggle if the click wasn't directly on the checkbox
        if (e.target !== checkbox) {
          checkbox.checked = !checkbox.checked;
          const event = new Event('change');
          checkbox.dispatchEvent(event);
        }
      });
    });
  </script>
  @endsection
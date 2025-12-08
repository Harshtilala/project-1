<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Management · Admin Dashboard</title>
  <link rel="stylesheet" href="styles/dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="main.css">
  <style>
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
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

<body>
  <div class="layout">
    <aside id="sidebar" class="sidebar" style="background-color: #eef2f7;">
      <div class="sidebar-header">
        <a href="dashboard.html">
          <img src="WhatsApp_Image_2025-09-18_at_7.18.19_PM-removebg-preview.png" alt="Company Logo" class="logo" width="220">
        </a>
      </div>
      <div class="sidebar-header">Menu</div>
      <nav class="nav">
        <a class="nav-item" href="dashboard.html">Dashboard</a>
        
        <!-- Master -->
        <details class="menu-group" id="menu-master">
          <summary class="nav-item">Master</summary>
          <div class="submenu">
            <a href="#company-details" class="submenu-item" data-icon="🏢">Company Details</a>
            <a href="#category" class="submenu-item" data-icon="🗂️">Category</a>
            <a href="#design-master" class="submenu-item" data-icon="🎨">Design Master</a>
            <a href="#opening-stock" class="submenu-item" data-icon="📦">Opening Stock</a>
            <a href="#tunch" class="submenu-item" data-icon="🧪">Tunch</a>
            <hr class="submenu-sep" />
            <a href="method.html" class="submenu-item" data-icon="⚙️">Method</a>
            <a href="#ad-master" class="submenu-item" data-icon="🧾">AD Master</a>
            <a href="#stamp" class="submenu-item" data-icon="🏷️">Stamp</a>
            <hr class="submenu-sep" />
            <a href="#add-user" class="submenu-item" data-icon="👤">Add User</a>
            <a href="#user-list" class="submenu-item" data-icon="👥">User List</a>
            <a href="UserRights.html" class="submenu-item" data-icon="🔐">User Rights</a>
          </div>
        </details>
        
        <!-- Account -->
        <details class="menu-group" id="menu-account">
          <summary class="nav-item active">Account</summary>
          <div class="submenu">
            <a href="Account.html" class="submenu-item active" data-icon="➕">Add Account</a>
            <a href="#account-list" class="submenu-item" data-icon="📄">Account List</a>
            <a href="#account-group" class="submenu-item" data-icon="🧩">Account Group</a>
          </div>
        </details>
        
        <!-- Order -->
        <details class="menu-group" id="menu-order">
          <summary class="nav-item">Order</summary>
          <div class="submenu">
            <a href="add-order.html" class="submenu-item" data-icon="➕">Add Order</a>
            <a href="#order-list" class="submenu-item" data-icon="📋">Order List</a>
            <a href="#order-list-new" class="submenu-item" data-icon="🆕">Order List New</a>
            <a href="#inquiry-list" class="submenu-item" data-icon="❓">Inquiry List</a>
            <a href="#order-item-list" class="submenu-item" data-icon="🧾">Order Item List</a>
            <a href="#order-slider" class="submenu-item" data-icon="🎚️">Order Slider</a>
          </div>
        </details>
        
        <!-- Sell/Purchase -->
        <details class="menu-group" id="menu-sell-purchase">
          <summary class="nav-item">Sell/Purchase</summary>
          <div class="submenu">
            <a href="add-sell-purchase.html" class="submenu-item" data-icon="➕">Sell/Purchase Entry</a>
            <a href="#other-entry" class="submenu-item" data-icon="➕">Other Entry</a>
            <hr class="submenu-sep" />
            <a href="#sp-list" class="submenu-item" data-icon="📋">Sell/Purchase List</a>
            <a href="#other-entry-list" class="submenu-item" data-icon="📋">Other Entry List</a>
            <a href="#not-delivered" class="submenu-item" data-icon="⛔">Not Delivered List</a>
            <a href="#sp-item-list" class="submenu-item" data-icon="🧾">Sell/Purchase Item List</a>
          </div>
        </details>
        
        <!-- Transaction -->
        <details class="menu-group" id="menu-transaction">
          <summary class="nav-item">Transaction</summary>
          <div class="submenu">
            <a href="payment-receipt.html" class="submenu-item" data-icon="💳">Payments/Receipts</a>
            <a href="#journals" class="submenu-item" data-icon="📘">Journals</a>
          </div>
        </details>
        
        <!-- Ledger -->
        <details class="menu-group" id="menu-ledger">
          <summary class="nav-item">Ledger</summary>
          <div class="submenu">
            <a href="ledger.html" class="submenu-item" data-icon="📒">Ledger</a>
            <a href="daybook.html" class="submenu-item" data-icon="📔">Daybook</a>
            <a href="cashbook.html" class="submenu-item" data-icon="💵">Cashbook</a>
            <a href="bankbook.html" class="submenu-item" data-icon="🏦">Bankbook</a>
          </div>
        </details>
        
        <!-- Reports -->
        <details class="menu-group" id="menu-reports">
          <summary class="nav-item">Reports</summary>
          <div class="submenu">
            <a href="#sales-report" class="submenu-item" data-icon="📈">Sales Report</a>
            <a href="#purchase-report" class="submenu-item" data-icon="📉">Purchase Report</a>
            <a href="#stock-report" class="submenu-item" data-icon="📦">Stock Report</a>
          </div>
        </details>
        
        <!-- Hallmark -->
        <details class="menu-group" id="menu-hallmark">
          <summary class="nav-item">Hallmark</summary>
          <div class="submenu">
            <a href="#send-hallmark" class="submenu-item" data-icon="✉️">Send for Hallmark</a>
            <a href="#hallmark-list" class="submenu-item" data-icon="📝">Hallmark List</a>
          </div>
        </details>
        
        <!-- Index -->
        <details class="menu-group" id="menu-index">
          <summary class="nav-item">Index</summary>
          <div class="submenu">
            <a href="#reindex" class="submenu-item" data-icon="🔁">ReIndex</a>
            <a href="#recalculate" class="submenu-item" data-icon="♻️">ReCalculate</a>
            <a href="#check-all" class="submenu-item" data-icon="✅">Check All is Well?</a>
          </div>
        </details>
        
        <!-- Settings -->
        <a class="nav-item" href="#settings">Settings</a>
      </nav>
    </aside>

    <main class="content" style="position: relative;">
        <div style=" display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 class="title" style="margin: 0; color: #000; font-size: 27px; font-weight: bold;">Account Registration</h2>
            <div class="action-buttons" style="display: flex; gap: 10px; position: absolute; left: 985px; position: sticky">
                <button type="reset" class="btn btn-outline btn-close" style="background-color: #e6f2ff; border-color: #b3d1ff; color: #0d6efd; transition: all 0.2s ease-in-out; padding: 8px 15px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; height: 40px;">
                    <i class="fas fa-undo me-1"></i> Reset
                </button>
                <button type="button" class="btn btn-outline" style="background-color: #e6f2ff; border-color: #b3d1ff; color: #0d6efd; transition: all 0.2s ease-in-out; padding: 8px 15px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; height: 40px;">
                    <i class="fas fa-list me-1"></i> Account List
                </button>
                <button type="submit" form="accountForm" class="btn btn-primary" style="background-color: #0d6efd; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 120px; display: flex; align-items: center; justify-content: center; height: 40px;">
                    <i class="fas fa-save me-1"></i> Save <small style="margin-left: 5px; font-weight: normal;">(Ctrl + S)</small>
                </button>
            </div>
        </div>
      <div class="card" style="position: relative; top:-15px;">
        <form id="accountForm">
          <!-- Basic Information -->
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
            <div>
              <h3 class="section-title" style="margin: 0 0 5px 0; color: #000; font-size: 20px; font-weight: bold; display: inline-block; border:none; padding-bottom: 5px; ">Register</h3>
            </div>
            
          </div>
            
          <div class="form-row">
            <div class="form-group">
              <label for="name" class="form-label" style="color: #000; font-size: 15px;">Name <span class="text-red-500">*</span></label>
              <input type="text" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
              <label for="code" class="form-label" style="color: #000; font-size: 15px;">Code</label>
              <input type="text" id="code" class="form-control">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="mobile" class="form-label" style="color: #000; font-size: 15px;">Mobile <small>(comma separated for multiple)</small></label>
              <input type="text" id="mobile" class="form-control" placeholder="e.g. 9876543210, 9876543211">
            </div>
            
            <div class="form-group">
              <label for="email" class="form-label" style="color: #000; font-size: 15px;">Email <small>(comma separated for multiple)</small></label>
              <input type="email" id="email" class="form-control" placeholder="e.g. email@example.com, email2@example.com">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="accountGroup" class="form-label" style="color: #000; font-size: 15px;">Account Group</label>
              <select id="accountGroup" class="form-control">
                <option value="">Select Account Group</option>
                <option value="customer">Customer</option>
                <option value="supplier">Supplier</option>
                <option value="bank">Bank</option>
                <option value="cash">Cash</option>
              </select>
            </div>
            
            <div class="form-group" style="display: flex; align-items: flex-end;">
              <label for="remark" class="form-label" style="color: #000; font-size: 15px;">Remarks</label>
              <input type="text" id="remark" class="form-control">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group" style="grid-column: 1 / -1;">
              <label class="checkbox-item" style="color: #000; font-size: 15px; margin-bottom: 0.5rem; position:relative; left: -600px;">
                <input type="checkbox" id="isSupplier">&nbsp; Is Supplier?
              </label>
            </div>
          </div>
          
          <!-- Opening Balances -->
          <h3 class="section-title" style="margin-bottom: 20px; color: #000; font-size: 20px; font-weight: bold;">Opening Balance</h3>
          
          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group" style="margin: 0;">
              <label for="openingGold" class="form-label" style="color: #000; font-size: 15px;">Opening Balance (Gold)</label>
              <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                <input type="number" id="openingGold" class="form-control" step="0.001" style="width: calc(100% - 90px);">
                <select class="form-control" style="width: 90px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                  <option value="debit">Debit</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>
            
            <div class="form-group" style="margin: 0;">
              <label for="openingSilver" class="form-label" style="color: #000; font-size: 15px;">Opening Balance (Silver)</label>
              <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                <input type="number" id="openingSilver" class="form-control" step="0.01" style="width: calc(100% - 90px);">
                <select class="form-control" style="width: 80px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                  <option value="debit">Debit</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
            <div class="form-group" style="margin: 0;">
              <label for="openingRupees" class="form-label" style="color: #000; font-size: 15px;">Opening Balance (Rupees)</label>
              <div style="display: flex; gap: 0.5rem; align-items: center; width: 100%;">
                <input type="number" id="openingRupees" class="form-control" step="0.01" style="width: calc(100% - 90px);">
                <select class="form-control" style="width: 90px; padding: 0.4rem 0.5rem; font-size: 0.9rem; height: auto;">
                  <option value="debit">Debit</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>
            
            <div class="form-group" style="margin: 0;">
              <label for="pricePerPcs" class="form-label" style="color: #000; font-size: 15px;">Price/Per Pcs</label>
              <input type="number" id="pricePerPcs" class="form-control" step="0.01">
            </div>
          </div>
          
          <!-- Itemwise Wastage -->
          <h3 class="section-title" style="margin-bottom: 20px; color: #000; font-size: 19px; font-weight: bold;">Itemwise Wastage</h3>
          
          <div class="wastage-row">
            <div class="form-group">
              <label for="wastageCategory" class="form-label" style="color: #000; font-size: 15px;">Category</label>
              <select id="wastageCategory" class="form-control">
                <option value="">Select Category</option>
                <option value="gold">Gold</option>
                <option value="silver">Silver</option>
                <option value="diamond">Diamond</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="wastageItem" class="form-label" style="color: #000; font-size: 15px;">Item</label>
              <select id="wastageItem" class="form-control">
                <option value="">Select Item</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="wastage" class="form-label" style="color: #000; font-size: 15px;">Wastage %</label>
              <input type="number" id="wastage" class="form-control" step="0.01" placeholder="0.00">
            </div>
            
            <button type="button" class="btn btn-primary" style="margin-bottom: 1.7rem; background-color: #0d6efd; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 100px;">
              <i class="fas fa-plus"></i> Add Item
            </button>
          </div>
          
          <div class="wastage-list">
            <!-- Sample wastage item (can be dynamically added) -->
            <div class="wastage-item">
              <div>Gold</div>
              <div>22K Gold Chain</div>
              <div>2.50%</div>
              <div>
                <button type="button" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </div>
          
          
        </form>
      </div>
    </main>
  </div>

  <script src="scripts/dashboard.js"></script>
  <!-- icon script -->
  <script src="scripts/sidebar-icons.js"></script>
  <script>
    // Keyboard shortcut for save (Ctrl + S)
    document.addEventListener('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        document.getElementById('accountForm').dispatchEvent(new Event('submit'));
      }
    });
    
    // Form submission
    document.getElementById('accountForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Add form submission logic here
      alert('Account saved successfully!');
    });
    
    // Add wastage item
    document.querySelector('.wastage-row button').addEventListener('click', function() {
      const category = document.getElementById('wastageCategory').value;
      const item = document.getElementById('wastageItem').value;
      const wastage = document.getElementById('wastage').value;
      
      if (!category || !item || !wastage) {
        alert('Please fill in all wastage fields');
        return;
      }
      
      const wastageList = document.querySelector('.wastage-list');
      const itemElement = document.createElement('div');
      itemElement.className = 'wastage-item';
      itemElement.innerHTML = `
        <div>${document.getElementById('wastageCategory').options[document.getElementById('wastageCategory').selectedIndex].text}</div>
        <div>${document.getElementById('wastageItem').options[document.getElementById('wastageItem').selectedIndex].text}</div>
        <div>${wastage}%</div>
        <div>
          <button type="button" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;
      
      // Add remove functionality
      itemElement.querySelector('button').addEventListener('click', function() {
        itemElement.remove();
      });
      
      wastageList.appendChild(itemElement);
      
      // Reset form
      document.getElementById('wastageCategory').value = '';
      document.getElementById('wastageItem').value = '';
      document.getElementById('wastage').value = '';
    });
    
    // Load items based on selected category
    document.getElementById('wastageCategory').addEventListener('change', function() {
      const category = this.value;
      const itemSelect = document.getElementById('wastageItem');
      itemSelect.innerHTML = '<option value="">Select Item</option>';
      
      // Simulate loading items based on category
      if (category) {
        const items = {
          'gold': ['22K Gold Chain', '24K Gold Ring', '18K Gold Bangle'],
          'silver': ['Silver Chain', 'Silver Ring', 'Silver Bangle'],
          'diamond': ['Diamond Ring', 'Diamond Pendant', 'Diamond Earrings']
        };
        
        items[category].forEach(item => {
          const option = document.createElement('option');
          option.value = item.toLowerCase().replace(/\s+/g, '-');
          option.textContent = item;
          itemSelect.appendChild(option);
        });
      }
    });
  </script>
</body>
</html>

          const option = document.createElement('option');
          option.value = item.toLowerCase().replace(/\s+/g, '-');
          option.textContent = item;
          itemSelect.appendChild(option);
        });
      }
    });
  </script>
</body>
</html>

      }
    });
  </script>
</body>
</html>

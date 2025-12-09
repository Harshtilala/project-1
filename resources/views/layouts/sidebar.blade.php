  <aside id="sidebar" class="sidebar" style="background-color: #eef2f7;">
      <div class="sidebar-header">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('images/WhatsApp_Image_2025-09-18_at_7.18.19_PM-removebg-preview.png') }}" alt="Company Logo" class="logo" width="220"></a>
      </div>
      <div class="sidebar-header">Menu</div>
      <nav class="nav">
        <a class="nav-item" href="{{ route('dashboard') }}">Dashboard</a>

        <!-- Master -->
        <details class="menu-group" id="menu-master">
          <!-- dropdown icon -->
          <summary class="nav-item">Master</summary>
          <div class="submenu">
            <a href="#company-details" class="submenu-item" data-icon="🏢">Company Details</a>
            <a href="#category" class="submenu-item" data-icon="🗂️">Category</a>
            <a href="#design-master" class="submenu-item" data-icon="🎨">Design Master</a>
            <a href="#opening-stock" class="submenu-item" data-icon="📦">Opening Stock</a>
            <a href="#tunch" class="submenu-item" data-icon="🧪">Tunch</a>
            <hr class="submenu-sep" />
            <a href="#method" class="submenu-item" data-icon="⚙️">Method</a>
            <a href="#ad-master" class="submenu-item" data-icon="🧾">AD Master</a>
            <a href="#stamp" class="submenu-item" data-icon="🏷️">Stamp</a>
            <hr class="submenu-sep" />
            <a href="{{ route('users.create') }}" class="submenu-item" data-icon="➕">Add User</a>
            <a href="{{ route('users.index') }}" class="submenu-item" data-icon="👥">User List</a>
            <a href="#user-rights" class="submenu-item" data-icon="🔐">User Rights</a>
            <hr class="submenu-sep" />
            <a href="#state" class="submenu-item" data-icon="🗺️">State</a>
            <a href="#city" class="submenu-item" data-icon="🏙️">City</a>
            <a href="#demo" class="submenu-item" data-icon="🧪">Demo</a>
            <hr class="submenu-sep" />
            <a href="{{ route('item.create') }}" class="submenu-item" data-icon="➕">Add Item</a>
            <a href="{{ route('item.index') }}"class="submenu-item" data-icon="📃">Item List</a>
          </div>
        </details>

        <!-- Account -->
        <details class="menu-group" id="menu-account">
              <summary class="nav-item">Account</summary>
          <div class="submenu">
            <a href="{{ route('accounts.create') }}" class="submenu-item" data-icon="➕">Add Account</a>
            <a href="{{ route('accounts.index') }}" class="submenu-item" data-icon="📄">Account List</a>
            <a href="#account-group" class="submenu-item" data-icon="🧩">Account Group</a>
          </div>
        </details>

        <!-- Order -->
        <details class="menu-group" id="menu-order">
          <summary class="nav-item">Order</summary>
          <div class="submenu">
            <a href="{{ route('order.create') }}" class="submenu-item" data-icon="➕">Add Order</a>
            <a href="{{ route('order.index') }}" class="submenu-item" data-icon="📋">Order List</a>
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
            <a href="payment-receipt.html" class="submenu-item active" data-icon="💳">Payments/Receipts</a>
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

        <!-- Settings (link) -->
        <a class="nav-item" href="#settings">Settings</a>
      </nav>
    </aside>
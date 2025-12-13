@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    :root {

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
        min-height: 100vh;
    }

    .form-section {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow);
    }

    .form-section h2 {
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--gray-200);
        color: var(--gray-800);
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-section h2 i {
        color: #3b82f6;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--gray-600);
        font-size: 0.875rem;
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
        color: #000000;
        /* Changed to black */
        pointer-events: none;
        z-index: 2;
    }

    /* Style only select elements within select-container */
    .select-container select.form-control {
        width: 100%;
        padding: 0.5rem 2.5rem 0.5rem 40px;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        font-size: 0.9375rem;
        color: var(--gray-700);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: white;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23000000' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    .form-control:focus,
    .select-container select:focus {
        border-color: #3b82f6;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }


    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid var(--gray-200);
    }

    .date-range-picker {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .date-range-separator {
        color: var(--gray-500);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="layout" style="display: flex; min-height: 100vh; overflow: hidden;">
    <!-- Main Content -->
    <main class="content" style="margin-left: 10px;">
        <div class="container-fluid">
            <!-- Page Header -->
            <br>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="title"
                    style="color: black; font-weight: bold; font-size: 26px; position: relative;top: -15px;">Order
                    List</h2>
                <div class="d-flex gap-2" style="position: relative; top: -20px;">
                    <button type="button" class="btn btn-outline-primary me-2" id="toggleFiltersBtn"
                        style="border: 1px solid #0d6efd; color: #0d6efd; background-color: transparent; padding: 0.375rem 0.75rem; font-size: 0.875rem; border-radius: 0.25rem; transition: all 0.2s ease-in-out;">
                        <i class="fas fa-filter me-2"></i>Filters
                    </button>
                    <button class="btn-style"
                        style="background-color: #8e44ad; color: white; border: 1px solid #7d3c98; transition: all 0.2s ease-in-out;">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="form-section" id="filtersSection" style="display: none;">
                <h2 style="color: black; font-weight: bold; font-size: 20px;"><i class="fas fa-filter"></i> Filter
                </h2>
                <form id="orderFilterForm">
                    <div class="form-grid">
                        <!-- Department -->
                        <div class="form-group">
                            <label for="department"
                                style="color: black; font-weight: bold; font-size: 15px;">Department</label>
                            <div class="select-container">
                                <i class="fas fa-building"></i>
                                <select id="department" class="form-control">
                                    <option value="">All Departments</option>
                                    <option value="gold">Gold</option>
                                    <option value="silver">silver</option>
                                    <option value="diamond">diamond</option>
                                </select>
                            </div>
                        </div>

                        <!-- Category -->
                        {{-- <div class="form-group">
                            <label for="category"
                                style="color: black; font-weight: bold; font-size: 15px;">Category</label>
                            <div class="select-container">
                                <i class="fas fa-tags"></i>
                                <select id="category" class="form-control">
                                    <option value="">All Categories</option>
                                    <option value="rings">Rings</option>
                                    <option value="necklaces">Necklaces</option>
                                    <option value="bracelets">Bracelets</option>
                                </select>
                            </div>
                        </div> --}}

                        <!-- Item -->
                        {{-- <div class="form-group">
                            <label for="item" style="color: black; font-weight: bold; font-size: 15px;">Item</label>
                            <div class="select-container">
                                <i class="fas fa-box-open"></i>
                                <select id="item" class="form-control">
                                    <option value="">All Items</option>
                                    <option value="diamond-ring">Diamond Ring</option>
                                    <option value="gold-chain">Gold Chain</option>
                                    <option value="silver-bracelet">Silver Bracelet</option>
                                </select>
                            </div>
                        </div> --}}

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status" style="color: black; font-weight: bold; font-size: 15px;">Status</label>
                            <div class="select-container">
                                <i class="fas fa-info-circle"></i>
                                <select id="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="0">Pending</option>
                                    {{-- <option value="processing">Processing</option> --}}
                                    <option value="1">Completed</option>
                                    {{-- <option value="cancelled">Cancelled</option> --}}
                                </select>
                            </div>
                        </div>

                        <!-- Type -->
                        {{-- <div class="form-group">
                            <label for="type" style="color: black; font-weight: bold; font-size: 15px;">Type</label>
                            <div class="select-container">
                                <i class="fas fa-tag"></i>
                                <select id="type" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="standard">Standard</option>
                                    <option value="express">Express</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                        </div> --}}

                        <!-- From Date -->
                        {{-- <div class="form-group">
                            <label for="fromDate" style="color: black; font-weight: bold; font-size: 15px;">From
                                Date</label>
                            <input type="date" id="fromDate" class="form-control">
                        </div> --}}

                        <!-- To Date -->
                        {{-- <div class="form-group">
                            <label for="toDate" style="color: black; font-weight: bold; font-size: 15px;">To
                                Date</label>
                            <input type="date" id="toDate" class="form-control">
                        </div> --}}

                        <!-- Delivery From Date -->
                        {{-- <div class="form-group">
                            <label for="deliveryFromDate"
                                style="color: black; font-weight: bold; font-size: 15px;">Delivery From Date</label>
                            <input type="date" id="deliveryFromDate" class="form-control">
                        </div> --}}

                        <!-- Delivery To Date -->
                        {{-- <div class="form-group">
                            <label for="deliveryToDate"
                                style="color: black; font-weight: bold; font-size: 15px;">Delivery To Date</label>
                            <input type="date" id="deliveryToDate" class="form-control">
                        </div> --}}

                        <!-- Supplier -->
                        {{-- <div class="form-group">
                            <label for="supplier"
                                style="color: black; font-weight: bold; font-size: 15px;">Supplier</label>
                            <div class="select-container">
                                <i class="fas fa-truck"></i>
                                <select id="supplier" class="form-control">
                                    <option value="">All Suppliers</option>
                                    <option value="supplier1">Supplier A</option>
                                    <option value="supplier2">Supplier B</option>
                                    <option value="supplier3">Supplier C</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="reset" class="btn"
                            style="background-color: #e9ecef; color: #495057; border: 1px solid #dee2e6; padding: 8px 16px; border-radius: 4px; font-weight: 500; transition: all 0.2s ease-in-out;">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-style" style="background-color: #0d6efd; color: white;">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order List Table -->
            <div class="form-section">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="orderTable">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="mb-0">No orders found. Adjust your filters or create a new order.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Additional Filter Section -->
            <div class="form-section mt-4" id="additionalFiltersSection" style="display: none;">
                {{-- <h2 style="color: black; font-weight: bold; font-size: 20px;"><i class="fas fa-filter"></i>
                    Additional Filters</h2> --}}
                {{-- <form id="additionalFilterForm">
                    <div class="form-grid">
                        <!-- Department -->
                        <div class="form-group">
                            <label for="department2"
                                style="color: black; font-weight: bold; font-size: 15px;">Department</label>
                            <div class="select-container">
                                <i class="fas fa-building"></i>
                                <select id="department2" class="form-control">
                                    <option value="">All Departments</option>
                                    <option value="jewelry">Jewelry</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                </select>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category2"
                                style="color: black; font-weight: bold; font-size: 15px;">Category</label>
                            <div class="select-container">
                                <i class="fas fa-tags"></i>
                                <select id="category2" class="form-control">
                                    <option value="">All Categories</option>
                                    <option value="rings">Rings</option>
                                    <option value="necklaces">Necklaces</option>
                                    <option value="bracelets">Bracelets</option>
                                </select>
                            </div>
                        </div>

                        <!--   -->
                        <div class="form-group">
                            <label for="item2" style="color: black; font-weight: bold; font-size: 15px;">Item</label>
                            <div class="select-container">
                                <i class="fas fa-box-open"></i>
                                <select id="item2" class="form-control">
                                    <option value="">All Items</option>
                                    <option value="diamond-ring">Diamond Ring</option>
                                    <option value="gold-chain">Gold Chain</option>
                                    <option value="silver-bracelet">Silver Bracelet</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status2"
                                style="color: black; font-weight: bold; font-size: 15px;">Status</label>
                            <div class="select-container">
                                <i class="fas fa-info-circle"></i>
                                <select id="status2" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status 2 -->
                        <div class="form-group">
                            <label for="status2_2" style="color: black; font-weight: bold; font-size: 15px;">Status
                                2</label>
                            <div class="select-container">
                                <i class="fas fa-info-circle"></i>
                                <select id="status2_2" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label for="type2" style="color: black; font-weight: bold; font-size: 15px;">Type</label>
                            <div class="select-container">
                                <i class="fas fa-tag"></i>
                                <select id="type2" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="standard">Standard</option>
                                    <option value="express">Express</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                        </div>

                        <!-- From Date -->
                        <div class="form-group">
                            <label for="fromDate2" style="color: black; font-weight: bold; font-size: 15px;">From
                                Date</label>
                            <div class="input-group">
                                <input type="date" id="fromDate2" class="form-control">
                            </div>
                        </div>

                        <!-- To Date -->
                        <div class="form-group">
                            <label for="toDate2" style="color: black; font-weight: bold; font-size: 15px;">To
                                Date</label>
                            <div class="input-group">
                                <input type="date" id="toDate2" class="form-control">
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="form-group">
                            <label for="supplier2"
                                style="color: black; font-weight: bold; font-size: 15px;">Supplier</label>
                            <div class="select-container">
                                <i class="fas fa-truck"></i>
                                <select id="supplier2" class="form-control">
                                    <option value="">All Suppliers</option>
                                    <option value="supplier1">Supplier A</option>
                                    <option value="supplier2">Supplier B</option>
                                    <option value="supplier3">Supplier C</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="reset" class="btn"
                            style="background-color: #e9ecef; color: #495057; border: 1px solid #dee2e6; padding: 8px 16px; border-radius: 4px; font-weight: 500; transition: all 0.2s ease-in-out;">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-style" style="background-color: #0d6efd; color: white;">
                            <i class="fas fa-search me-1"></i>Search
                        </button>
                    </div>
                </form> --}}
            </div>
        </div>
    </main>


    <a href="{{ route('order.create') }}" class="fab" data-bs-toggle="tooltip" data-bs-placement="left"
        title="Create New Order"
        style="background-color: #0d6efd; color: white; border: none; width: 56px; height: 56px; border-radius: 50%; position: fixed; bottom: 30px; right: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); cursor: pointer; transition: all 0.2s ease-in-out; z-index: 1000; text-decoration: none;">
        <i class="fas fa-plus" style="font-size: 1.25rem;"></i>
    </a>
</div>

<script>
    let table;

    $(function () {
        table = $('#orderTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('order.index') }}",
                data: function (d) {
                    // Send all filter values on every request
                    d.department = $('#department').val();
                    d.category = $('#category').val();
                    d.item = $('#item').val();
                    d.status = $('#status').val();
                    d.type = $('#type').val();
                    d.fromDate = $('#fromDate').val();
                    d.toDate = $('#toDate').val();
                    d.deliveryFromDate = $('#deliveryFromDate').val();
                    d.deliveryToDate = $('#deliveryToDate').val();
                    d.supplier = $('#supplier').val();

                    // Additional filters
                    d.department2 = $('#department2').val();
                    d.category2 = $('#category2').val();
                    d.item2 = $('#item2').val();
                    d.status2 = $('#status2').val();
                    d.status2_2 = $('#status2_2').val();
                    d.type2 = $('#type2').val();
                    d.fromDate2 = $('#fromDate2').val();
                    d.toDate2 = $('#toDate2').val();
                    d.supplier2 = $('#supplier2').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Index column
                { 
                data: 'date', 
                name: 'date',
                render: function(data, type, row) {
                if (data) {
                // Format using JavaScript Date object
                let d = new Date(data);
                let day = ("0" + d.getDate()).slice(-2);
                let month = ("0" + (d.getMonth() + 1)).slice(-2);
                let year = d.getFullYear();
                return `${day}-${month}-${year}`; // e.g., 03-12-2025
            }
            return '';
        }
    },
                { data: 'to_supplier', name: 'to_supplier' },
                { data: 'item', name: 'item' },
                { data: 'total', name: 'total' },
                { data: 'status', name: 'status', orderable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Apply filters when Search is clicked
        $('#orderFilterForm, #additionalFilterForm').on('submit', function (e) {
            e.preventDefault();
            table.ajax.reload();
        });

        // Reset filters
        $('#orderFilterForm, #additionalFilterForm').on('reset', function () {
            $(this).find('select, input').val('');
            setTimeout(() => table.ajax.reload(), 100);
        });

        // Status Toggle
        $(document).on('click', '.statusToggle', function () {
            let id = $(this).data('id');

            $.ajax({
                url: `/orders/change-status/${id}`,
                type: 'POST',
                data: { _token: "{{ csrf_token() }}" },
                success: function () {
                    table.ajax.reload(null, false);
                    toastr.success('Status updated successfully');
                },
                error: function () {
                    toastr.error('Failed to update status');
                }
            });
        });
    });

        // Edit Button Redirect using Laravel route
    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        // Redirect to the edit page using named route
        window.location.href = "{{ route('order.edit', ':id') }}".replace(':id', id);
    });


    $(document).on('click', '[data-action="delete"]', function () {
            const id = $(this).data('id');
            if (!confirm('Delete this user?')) return;

            $.ajax({
                url: `/orders/delete/${id}`,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () {
                    table.ajax.reload(null, false);
                      toastr.success('order Delete Successfully!');
                },
                error: function (xhr) {
                    toastr.error('Error in order delete!');
                }
            });
        });
</script>
<script>
    // Toggle filters section visibility
      document.addEventListener('DOMContentLoaded', function() {
        const toggleFiltersBtn = document.getElementById('toggleFiltersBtn');
        const filtersSection = document.getElementById('filtersSection');
        const additionalFiltersSection = document.getElementById('additionalFiltersSection');
        
        if (toggleFiltersBtn && filtersSection && additionalFiltersSection) {
          // Initially hide both filter sections
          filtersSection.style.display = 'none';
          additionalFiltersSection.style.display = 'none';
          
          toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filtersSection.style.display !== 'none';
            
            // Toggle visibility
            filtersSection.style.display = isVisible ? 'none' : 'block';
            additionalFiltersSection.style.display = isVisible ? 'none' : 'block';
            
            // Toggle button classes and icon
            if (isVisible) {
              this.classList.remove('btn-primary');
              this.classList.add('btn-outline-primary');
              this.innerHTML = '<i class="fas fa-filter me-2"></i>Filters';
              this.style.backgroundColor = 'transparent';
              this.style.color = '#0d6efd'; // Reset to blue text when not active
            } else {
              this.classList.remove('btn-outline-primary');
              this.classList.add('btn-primary');
              this.innerHTML = '<i class="fas fa-filter me-2"></i>Filters';
              this.style.backgroundColor = '#0d6efd'; // Set specific blue color
              this.style.color = 'white'; // Set text color to white
            }
          });
        }
      });
</script>
@endsection
@extends('layouts.master')
@section('content')

<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
<style>
    #toast-container>div {
        opacity: 1 !important;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
    }
    .toast-success {
        background-color: #28a745 !important;
        color: #fff !important;
    }
    .toast-error {
        background-color: #dc3545 !important;
        color: #fff !important;
    }
    .toast-info {
        background-color: #17a2b8 !important;
        color: #fff !important;
    }
    .toast-warning {
        background-color: #ffc107 !important;
        color: #000 !important;
    }
</style>

    <!-- Main Content -->
    <main class="main-content" style="flex: 1; padding: 20px; overflow-y: auto; background-color: #f8f9fa;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4" style="position: relative; top: -20px;">

                <h2 class="title" style="color: black; font-weight: bold; font-size: 28px;">Stock Status</h2>
                {{-- Display Success Message --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Display Error Message --}}
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Display Validation Errors --}}
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div>
                    <button class="btn btn-outline-primary me-2" id="toggleFiltersBtn">
                        <i class="fas fa-filter me-2"></i>Filters
                    </button>
                    <a href="{{ route('stockstatus.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus me-1"></i>Add New Stock
                    </a>
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                </div>
            </div>

            <!-- Stock Summary Cards -->
            <div class="row g-2 mb-3" style="position: relative; top: -20px;">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm" style="height: 80px;">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div>
                                        <div class="text-uppercase text-muted"
                                            style="font-size: 10px; font-weight: 600; line-height: 1;">TOTAL ITEMS</div>
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold me-2"
                                                style="font-size: 18px; line-height: 1;">1,248</span>
                                            <span class="text-success" style="font-size: 10px;"><i
                                                    class="fas fa-arrow-up me-1"></i>12%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-1 rounded-circle ms-2"
                                    style="min-width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; position: relative; left: 275px;">
                                    <i class="fas fa-box text-primary" style="font-size: 14px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm" style="height: 80px;">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <div class="text-uppercase text-muted"
                                        style="font-size: 10px; font-weight: 600; line-height: 1;">IN STOCK</div>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-2 text-success"
                                            style="font-size: 18px; line-height: 1;">1,024</span>
                                        <span class="text-success" style="font-size: 10px;"><i
                                                class="fas fa-arrow-up me-1"></i>8%</span>
                                    </div>
                                </div>
                                <div class="bg-success bg-opacity-10 p-1 rounded-circle ms-2"
                                    style="min-width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check-circle text-success" style="font-size: 14px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm" style="height: 80px;">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <div class="text-uppercase text-muted"
                                        style="font-size: 10px; font-weight: 600; line-height: 1;">LOW STOCK</div>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-2 text-warning"
                                            style="font-size: 18px; line-height: 1;">45</span>
                                        <span class="text-danger" style="font-size: 10px;"><i
                                                class="fas fa-arrow-up me-1"></i>5</span>
                                    </div>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-1 rounded-circle ms-2"
                                    style="min-width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 14px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="card mb-4" style="display: none;" id="filtersSection">
                <div class="card-header bg-light">
                    <h5 class="mb-0" style="font-weight: bold; color: #000000; font-size: 20px;">Filter Options</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Left Column - Search Fields -->
                        <div class="col-md-9">
                            <div class="row g-3">
                                <!-- Department Dropdown -->
                                <div class="col-md-6">
                                    <label for="departmentFilter" class="form-label"
                                        style="font-weight: bold; color: #000000; font-size: 18px;">Department</label>
                                    <select class="form-select" id="departmentFilter">
                                        <option value="">All Departments</option>
                                        <option value="jewelry">Jewelry</option>
                                        <option value="gold">Gold</option>
                                        <option value="silver">Silver</option>
                                        <option value="diamonds">Diamonds</option>
                                    </select>
                                </div>

                                <!-- Category Dropdown -->
                                <div class="col-md-6">
                                    <label for="categoryFilter" class="form-label"
                                        style="font-weight: bold; color: #000000; font-size: 18px;">Category</label>
                                    <select class="form-select" id="categoryFilter">
                                        <option value="">All Categories</option>
                                        <option value="rings">Rings</option>
                                        <option value="necklaces">Necklaces</option>
                                        <option value="earrings">Earrings</option>
                                        <option value="bangles">Bangles</option>
                                    </select>
                                </div>

                                <!-- Item Search -->
                                <div class="col-md-6">
                                    <label for="itemSearch" class="form-label"
                                        style="font-weight: bold; color: #000000; font-size: 18px;">Item</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="itemSearch"
                                            placeholder="Search items...">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="col-12 mt-3">
                                    <button type="button" class="btn btn-primary me-2" id="applyFilters"
                                        style="background-color: #0d6efd; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 120px;">
                                        <i class="fas fa-search me-1" style="color: white;"></i> Search
                                    </button>
                                    <button type="button" class="btn" id="resetFilters"
                                        style="background-color: #b91c1c; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 100px;">
                                        <i class="fas fa-undo me-1" style="color: white;"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Checkboxes and Rates -->
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <!-- Rate Information -->
                                    <h6 class="mt-4 mb-3" style="font-weight: bold; color: black; font-size: 20px;">
                                        Current Rates</h6>
                                    <hr>
                                    <div class="mb-2">
                                        <small class="text-muted" style="color: black;">Rate from Setting:</small>
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <small class="text-muted" style="color: black;">Gold Rate</small>
                                        <div class="fw-bold text-primary"> &nbsp;₹5,850.00/g</div>
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <small class="text-muted" style="color: black;">Silver Rate</small>
                                        <div class="fw-bold text-primary"> &nbsp; ₹75.50/g</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive"
                        style="max-height: 60vh; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                        <table id="stockStatusTable" class="table table-hover align-middle mb-0">
                            <style>
                                .table-responsive::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Item Code</th>
                                    <th class="px-4 py-3">Item Name</th>
                                    <th class="text-center px-4 py-3">Category</th>
                                    <th class="text-center px-4 py-3">Weight (g)</th>
                                    <th class="text-center px-4 py-3">Purity</th>
                                    <th class="text-center px-4 py-3">Quantity</th>
                                    <th class="text-center px-4 py-3">Status</th>
                                    <th class="text-end px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>
</div>

<script>
    // Toggle filters section visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFiltersBtn = document.getElementById('toggleFiltersBtn');
            const filtersSection = document.getElementById('filtersSection');
            const applyFiltersBtn = document.getElementById('applyFiltersBtn');
            const resetFiltersBtn = document.getElementById('resetFiltersBtn');
            
            // Toggle filters section
            if (toggleFiltersBtn && filtersSection) {
                toggleFiltersBtn.addEventListener('click', function() {
                    if (filtersSection.style.display === 'none') {
                        filtersSection.style.display = 'block';
                        this.classList.remove('btn-outline-primary');
                        this.classList.add('btn-primary');
                    } else {
                        filtersSection.style.display = 'none';
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-outline-primary');
                    }
                });
            }
            
            // Apply filters
            if (applyFiltersBtn) {
                applyFiltersBtn.addEventListener('click', function() {
                    // Add your filter logic here
                    console.log('Filters applied');
                    // You can add code to filter the table/data here
                });
            }
            
            // Reset filters
            if (resetFiltersBtn) {
                resetFiltersBtn.addEventListener('click', function() {
                    // Reset all filter inputs
                    const selects = filtersSection.querySelectorAll('select');
                    const inputs = filtersSection.querySelectorAll('input[type="text"]');
                    
                    selects.forEach(select => {
                        select.selectedIndex = 0;
                    });
                    
                    inputs.forEach(input => {
                        if (input.type === 'text') {
                            input.value = '';
                        }
                    });
                    
                    // Apply the reset filters
                    if (applyFiltersBtn) {
                        applyFiltersBtn.click();
                    }
                });
            }
        });

        let table; 
     
    $(document).ready(function() {
     table = $('#stockStatusTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("stockstatus.index") }}',
        columns: [
            { data: 'item_code', name: 'item_code' , className: 'text-center' },
            { data: 'item_name', name: 'item_name', className: 'text-center'  },
            { data: 'category', name: 'category', className: 'text-center' },
            { data: 'weight', name: 'weight', className: 'text-center' },
            { data: 'purity', name: 'purity', className: 'text-center' },
            { data: 'quantity', name: 'quantity', className: 'text-center' },
            { data: 'status', name: 'status', className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ]   
    });
});

$(document).on('click', '[data-action="delete"]', function () {
    const id = $(this).data('id');
    if (!confirm('Delete this user?')) return;

    $.ajax({
        url: `stockstatus/delete/${id}`,
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            table.ajax.reload(null, false); 
            toastr.success('Stock Delete Successfully!');
        },
        error: function () {
            toastr.error('Error in Stock delete!');
        }
    });
});

  // Edit Button Redirect using Laravel route
    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        window.location.href = "{{ route('stockstatus.edit', ':id') }}".replace(':id', id);
    });


</script>
@endsection
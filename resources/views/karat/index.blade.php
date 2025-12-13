@extends('layouts.master')
@section('content')
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
<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
    <!-- Main Content -->
    <main class="content" style="flex: 1; padding: 20px; overflow-y: auto; background-color: #f8f9fa;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0" style="color: black; font-weight: bold; font-size: 28px;">Karat Wise Stock</h2>
                <div>
                    <a href="{{ route('karat.create') }}" class="btn btn-primary ms-2"
                        style="color: white !important; top: 20px;">
                        <i class="fas fa-plus me-1"></i>Add New Stock
                    </a>
                    <button class="btn btn-outline-secondary ms-2" style="color: white !important; top: 20px;">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                </div>
            </div>

            <!-- Karat Wise Stock Table -->
            <div class="card mt-3 mb-4">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="karat">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3">Karat Wise Stock</th>
                                    <th class="text-center">22K</th>
                                    <th class="text-center">18K</th>
                                    <th class="text-center">14K</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="text-muted mb-2">Total 22K</h6>
                                    <h3 class="mb-0 text-primary"> {{ number_format($totals['total_22k']) }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-gem text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total 18K</h6>
                                    <h3 class="mb-0 text-warning"> {{ number_format($totals['total_18k']) }}</h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-gem text-warning" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total 14K</h6>
                                    <h3 class="mb-0 text-success">{{ number_format($totals['total_14k']) }}</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-gem text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script> 
    document.addEventListener('DOMContentLoaded', function() {
      const currentPage = window.location.pathname.split('/').pop() || 'dashboard.html';
      
      const navLinks = document.querySelectorAll('.nav-item, .submenu-item');
      
      navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
          link.classList.add('active');
          const parentDetails = link.closest('details');
          if (parentDetails) {
            parentDetails.open = true;
          }
        }
      });
    });

      let table; 
     
    $(document).ready(function() {
     table = $('#karat').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("karat.index") }}',
       columns: [            
            { data: 'name', name: 'name', className: 'text-center'},
            { data: 'stock_22k', name: 'stock_22k', className: 'text-center' },
            { data: 'stock_18k', name: 'stock_18k', className: 'text-center' },
            { data: 'stock_14k', name: 'stock_14k', className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' },
        ]      
    });
});

$(document).on('click', '[data-action="delete"]', function () {
    const id = $(this).data('id');
    if (!confirm('Delete this user?')) return;

    $.ajax({
        url: `karat/delete/${id}`,
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
        window.location.href = "{{ route('karat.edit', ':id') }}".replace(':id', id);
    });



// Print Karat Wise Stock Table
$(document).on('click', '.btn-outline-secondary', function () {  
    let tableContent = document.querySelector('#karat').outerHTML;

    let printWindow = window.open('', '', 'height=600,width=900');
    printWindow.document.write('<html><head><title>Karat Wise Stock</title>');
    printWindow.document.write(`
        <style>
            body { font-family: Arial, sans-serif; padding: 20px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 8px; text-align: center; }
            th { background-color: #f2f2f2; }
        </style>
    `);
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2 style="text-align:center;">Karat Wise Stock</h2>');
    printWindow.document.write(tableContent);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
});

</script>
@endsection
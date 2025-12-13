@extends('layouts.master')
@section('content')
<style>
  /* Toastr container */
  #toast-container>div {
    opacity: 1 !important;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
  }

  /* Success */
  .toast-success {
    background-color: #28a745 !important;
    color: #fff !important;
  }

  /* Error */
  .toast-error {
    background-color: #dc3545 !important;
    color: #fff !important;
  }

  /* Info */
  .toast-info {
    background-color: #17a2b8 !important;
    color: #fff !important;
  }

  /* Warning */
  .toast-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
  }
</style>

<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
  <!-- Main Content -->
  <main class="content" style="flex: 1; padding: 20px; overflow-y: auto;">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title" style="color: black; font-weight: bold; font-size: 27px;">Diamond Stock Management</h2>
        <a href="{{ route('diamond_stocks.create') }}" class="btn btn-primary me-2">
          <i class="fas fa-plus me-1"></i>Add New Stock
        </a>
      </div>

      <!-- Diamond Stock Table -->
      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table id="diamondStockTable" class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="px-4 py-3">Diamond Stock</th>
                  <th class="text-center">Natural</th>
                  <th class="text-center">Lab Grown</th>
                  <th class="text-center">CVD</th>
                  <th class="text-end pe-4">Actions</th>
                </tr>
              </thead>

            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
  let table; 
     
    $(document).ready(function() {
     table = $('#diamondStockTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("diamond_stocks.index") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'natural', name: 'natural', className: 'text-center', orderable: false, searchable: false },
            { data: 'lab_grown', name: 'lab_grown', className: 'text-center', orderable: false, searchable: false },
            { data: 'cvd', name: 'cvd', className: 'text-center', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' },
        ]
      
    });
});

  $(document).on('click', '[data-action="delete"]', function () {
    const id = $(this).data('id');
    if (!confirm('Delete this user?')) return;

    $.ajax({
        url: `diamond-stocks/delete/${id}`,
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            table.ajax.reload(null, false);   // will work now
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
        // Redirect to the edit page using named route
        window.location.href = "{{ route('diamond_stocks.edit', ':id') }}".replace(':id', id);
    });

</script>
@endsection
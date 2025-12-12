@extends('layouts.master')
@section('content')
<body>
  <div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
  


    <!-- Main Content -->
    <main class="content" style="flex: 1; padding: 20px; overflow-y: auto;">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="title" style="color: black; font-weight: bold; font-size: 27px;">Diamond Stock Management</h2>
         <a href="{{ route('diamond_stocks.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus me-1"></i>Add New
                </a>
        </div>

        <!-- Diamond Stock Table -->
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table id="diamondStockTable"  class="table table-hover align-middle mb-0">
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
</script>
@endsection
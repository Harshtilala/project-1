@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    /* Your existing CSS - keep all of it unchanged */
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
    /* ... rest of your CSS unchanged ... */
</style>

<div class="layout" style="display: flex; min-height: 100vh; overflow: hidden;">
    <!-- Main Content -->
    <main class="content" style="margin-left: 10px;">
        <div class="container-fluid">
            <!-- Page Header -->
            <h2 class="my-2" style="color: black; font-weight: bold; font-size: 26px;">Users List</h2>
            <br>
        </div>
        
        <!-- Users Table -->
        <div class="form-section">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Salary (₹)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="mb-0">No users found.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- FAB Button -->
    <a href="{{ route('users.create') }}" class="fab" data-bs-toggle="tooltip" data-bs-placement="left"
        title="Add New User"
        style="background-color: #0d6efd; color: white; border: none; width: 56px; height: 56px; border-radius: 50%; position: fixed; bottom: 30px; right: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); cursor: pointer; transition: all 0.2s ease-in-out; z-index: 1000; text-decoration: none;">
        <i class="fas fa-plus" style="font-size: 1.25rem;"></i>
    </a>
</div>

<script>
    let table;

    $(function () {
        table = $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'username', name: 'username' },
                { data: 'mobile', name: 'mobile' },
                { data: 'department', name: 'department' },
                { data: 'designation', name: 'designation' },
                { data: 'salary', name: 'salary', render: function(data) {
                    return data ? '₹' + parseFloat(data).toLocaleString('en-IN', {minimumFractionDigits: 2}) : '-';
                }},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Edit functionality
        $(document).on('click', '.editBtn', function () {
            const id = $(this).data('id');
            window.location.href = "{{ route('users.edit', ':id') }}".replace(':id', id);
        });

     

        // -----------------USER DELETE
          $(document).on('click', '[data-action="delete"]', function () {
        const id = $(this).data('id');
        if (!confirm('Are you sure you want to delete this item?')) return;
        $.ajax({
            url: "{{ url('users') }}/" + id,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") 
            },
            success: function (res) {
                table.ajax.reload(null, false);
                toastr.success("User deleted successfully!");
            },
          
        });
    });
    });
</script>
@endsection

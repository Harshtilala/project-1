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
</style>

<div class="layout" style="display: flex; min-height: 100vh; overflow: hidden;">
    <!-- Main Content -->
    <main class="content" style="margin-left: 10px;">
        <div class="container-fluid">
            <br>
            <div class="d-flex justify-content-between align-items-center mb-0">
                <h2 class="title"
                    style="color: black; font-weight: bold; font-size: 26px; position: relative;top: -15px;">
                    Accounts List
                </h2>
            </div>
            <div class="form-section">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="accountsTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Mobile</th>
                                <th>Account Group</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center py-2">
                                    <i class=" fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="mb-0">No accounts found.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <a href="{{ route('accounts.create') }}" class="fab" data-bs-toggle="tooltip" data-bs-placement="left"
        title="Create New Account"
        style="background-color: #0d6efd; color: white; border: none; width: 56px; height: 56px; border-radius: 50%; position: fixed; bottom: 30px; right: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); cursor: pointer; transition: all 0.2s ease-in-out; z-index: 1000; text-decoration: none;">
        <i class="fas fa-plus" style="font-size: 1.25rem;"></i>
    </a>
</div>

<script>
    let table; 
     
    $(document).ready(function() {
     table = $('#accountsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("accounts.index") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'code', name: 'code' },
            { data: 'mobile', name: 'mobile' },
            { data: 'account_group', name: 'account_group' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[0, "asc"]],
    });
});

     $(document).on('click', '[data-action="delete"]', function () {
    const id = $(this).data('id');
    if (!confirm('Delete this user?')) return;

    $.ajax({
        url: `accounts/delete/${id}`,
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            table.ajax.reload(null, false);   // will work now
            toastr.success('Slider Delete Successfully!');
        },
        error: function () {
            toastr.error('Error in Slider delete!');
        }
    });
});


                  // Edit Button Redirect using Laravel route
    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        // Redirect to the edit page using named route
        window.location.href = "{{ route('accounts.edit', ':id') }}".replace(':id', id);
    });

</script>

@endsection
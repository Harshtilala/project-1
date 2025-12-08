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
            <h2 class="my-2">Item List</h2>
            <br>
        </div>
        <!-- Order List Table -->
        <div class="form-section">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="itemTable">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Category</th>
                            <th>Item name</th>
                            <th>Short item name</th>
                            <th>DlE No</th>
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


</div>
</main>


<a href="{{ route('item.create') }}" class="fab" data-bs-toggle="tooltip" data-bs-placement="left"
    title="Create New Order"
    style="background-color: #0d6efd; color: white; border: none; width: 56px; height: 56px; border-radius: 50%; position: fixed; bottom: 30px; right: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); cursor: pointer; transition: all 0.2s ease-in-out; z-index: 1000; text-decoration: none;">
    <i class="fas fa-plus" style="font-size: 1.25rem;"></i>
</a>
</div>

<script>
    let table;

    $(function () {
        table = $('#itemTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,  
            ajax: "{{ route('item.index') }}",         
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // Index column               
                { data: 'categoryName', name: 'categoryName' },
                { data: 'itemName', name: 'itemName' },
                { data: 'shortItemName', name: 'shortItemName' },
                { data: 'dleNo', name: 'dleNo'},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });  

            $(document).on('click', '.editBtn', function () {
            const id = $(this).data('id');
            window.location.href = "{{ route('item.edit', ':id') }}".replace(':id', id);
        });

        $(document).on('click', '[data-action="delete"]', function () {
        const id = $(this).data('id');
        if (!confirm('Are you sure you want to delete this item?')) return;
        $.ajax({
            url: "{{ url('items') }}/" + id,
            method: "DELETE",
            headers: { 
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") 
            },
            success: function (res) {
                table.ajax.reload(null, false);
                toastr.success("Item deleted successfully!");
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                toastr.error("Delete failed!");
            }
        });
    });

});
</script>

@endsection
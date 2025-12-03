@extends('layouts.master')
@section('content')


<title>Add Item</title>

{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
<!-- Bootstrap CSS -->

<style>
    body {
        background-color: #f8f9fa;
    }

    .main-content {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .form-control,
    .form-select {
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
    }

    .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 0.375rem;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .form-check {
        margin-top: 10px;
    }

    /* Style the file input button */
    .file-upload-container {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-upload-input {
        display: none;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        background-color: #0d6efd;
        color: white;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid #0d6efd;
        font-weight: 500;
    }

    .file-upload-label:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .file-upload-label i {
        margin-right: 8px;
    }

    .file-name {
        margin-left: 10px;
        font-size: 0.875rem;
        color: #6c757d;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }
</style>


{{-- <div class="layout" style="display: flex; height: 100vh; overflow: hidden;"> --}}


    <!-- Main Content -->
    {{-- <main class="content"> --}}

        <div class="container-fluid py-4">
            <h2 class="title" style="font-size: 28px; font-weight: bold; color: black; position: absolute; top: 8px;">
                Item Master
            </h2>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>There were some errors:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @error('itemName')
            <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            <div class="card shadow-sm mb-4" style="position: relative; top: 30px;">
                <div class="card-body">
                    <form id="itemMasterForm" action="{{ route('item.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="categoryName" class="form-label mb-1 text-start"
                                        style="color:black; font-size: bold; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Category
                                        Name</label>
                                    <select class="form-select form-select-sm" id="categoryName" name="categoryName"
                                        required style="font-size: 12px;">
                                        <option value="">Select Category</option>
                                        <option value="gold">Gold</option>
                                        <option value="silver">Silver</option>
                                        <option value="diamond">Diamond</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="itemName" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Item
                                        Name</label>
                                    <input type="text" name="itemName" class="form-control form-control-sm"
                                        id="itemName" required style="font-size: 12px;" Required>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="shortItemName" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Short
                                        Item Name</label>
                                    <input type="text" name="shortItemName" class="form-control form-control-sm"
                                        id="shortItemName" required style="font-size: 12px;" Required>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="dleNo" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">DLE
                                        No</label>
                                    <input type="text" name="dleNo" class="form-control form-control-sm" id="dleNo"
                                        style="font-size: 12px;">
                                </div>
                            </div>
                        </div>

                        <!-- Row 2 - Second group of 4 fields -->
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="designNo" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Design
                                        No.</label>
                                    <input type="text" class="form-control form-control-sm" id="designNo"
                                        name="designNo" style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="minOrderQty" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Min
                                        Order Qty</label>
                                    <input type="number" class="form-control form-control-sm" id="minOrderQty"
                                        name="minOrderQty" min="0" step="0.01" style="font-size: 12px;">
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="defaultWastage" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Default
                                        Wastage (%)</label>
                                    <input type="number" class="form-control form-control-sm" id="defaultWastage"
                                        name="defaultWastage" min="0" max="150" step="0.01" style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="height: 100%;">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <label class="form-label mb-0"
                                            style="color: #000; font-weight: 600; font-size: 15px; white-space: nowrap;">Less</label>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="lessOption" id="lessYes"
                                                value="yes" style="font-size: 12px; margin-top: 0.2rem;">
                                            <label class="form-check-label ps-1" for="lessYes"
                                                style="font-size: 12px; color: #000;">Yes</label>
                                        </div>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="lessOption" id="lessNo"
                                                value="no" checked style="font-size: 12px; margin-top: 0.2rem;">
                                            <label class="form-check-label ps-1" for="lessNo"
                                                style="font-size: 12px; color: #000;">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 5 - Stock Transfer and Image -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="stockTransferWastage" class="form-label text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Stock
                                        Transfer Default Wastage (%)</label>
                                    <input type="number" class="form-control" id="stockTransferWastage" min="0"
                                        name="stockTransferWastage" max="100" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="itemImage" class="form-label text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Image
                                        Upload</label>
                                    <div class="file-upload-container">
                                        <input type="file" class="file-upload-input" id="itemImage" name="itemImage"
                                            accept="image/*">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <label for="itemImage" class="file-upload-label"
                                                    style="color: white !important;">
                                                    <i class="fas fa-upload"></i> Choose Image
                                                </label>
                                                <span class="file-name ms-2" id="fileName">No file chosen</span>
                                            </div>
                                            <small class="text-muted ms-3">Upload item image (JPG, PNG,
                                                etc.)</small>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('itemImage').addEventListener('change', function(e) {
                        const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
                        document.getElementById('fileName').textContent = fileName;
                      });
                                    </script>
                                </div>
                            </div>
                        </div>

                        <!-- Row 5 - Third group of 4 fields -->
                        <div class="row mb-2">
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="stockMethod" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Stock
                                        Method</label>
                                    <select class="form-select form-select-sm" id="stockMethod" name="stockMethod"
                                        style="font-size: 12px;">
                                        <option value="fifo">FIFO</option>
                                        <option value="lifo">LIFO</option>
                                        <option value="average">Average Cost</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="sequenceNo" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Sequence
                                        No</label>
                                    <input type="number" class="form-control form-control-sm" id="sequenceNo"
                                        name="sequenceNo" min="1" style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="rateNo" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Rate
                                        No</label>
                                    <input type="text" class="form-control form-control-sm" id="rateNo" name="rateNo"
                                        style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group" style="display: flex; flex-direction: column; height: 100%;">
                                    <label for="rateOff" class="form-label mb-1 text-start"
                                        style="color: #000; font-weight: 600; font-size: 15px; margin-bottom: 6px; width: 100%;">Rate
                                        Off</label>
                                    <input type="number" class="form-control form-control-sm" id="rateOff" min="0"
                                        name="rateOff" step="0.01" style="font-size: 12px;">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn" onclick="resetForm()"
                                style="background-color: #b91c1c; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 65px;">
                                <i class="fas fa-undo me-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-style" id="btnSave"
                                style="background-color: #0d6efd; color: white; padding: 8px 20px; border: none; border-radius: 6px; font-weight: 700; min-width: 65px;">
                                <i class="fas fa-save me-1"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--
    </main> --}}
    {{--
</div> --}}

<script>
    function resetForm() {
    // Reset the entire form
    document.getElementById('itemMasterForm').reset();

    // Reset file name label
    document.getElementById('fileName').textContent = 'No file chosen';

    // If you want to also remove the previewed file (optional)
    const fileInput = document.getElementById('itemImage');
    fileInput.value = "";

    // If default radio button you want to keep checked (like "No")
    document.getElementById('lessNo').checked = true;
}
    // Form submission handler
    document.getElementById('itemMasterForm').addEventListener('submit', function(e) {
    //   e.preventDefault();
      // Add your form submission logic here
      alert('Item saved successfully!');
    });

    // Cancel button handler
    document.getElementById('btnCancel').addEventListener('click', function() {
      if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
        window.location.href = 'dashboard.html';
      }
    });
</script>
<script>
    // Add any necessary JavaScript for form handling
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
</script>
@endsection
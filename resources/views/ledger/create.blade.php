@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background: #ffffff;
    }

    .page-header {
        background: #ffffff;
        padding: 1.5rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .form-control,
    .form-select {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 15px;
    }
</style>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2 style="font-size: 28px; font-weight: bold;">Add Ledger Entry</h2>

        {{-- <a href="{{ route('ledger.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a> --}}
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">

            <form action="{{ route('ledger.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" placeholder="Select date" required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Particulars</label>
                        <input type="text" name="particulars" class="form-control" placeholder="Enter particulars">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="">Select type</option>
                            <option>24K Gold</option>
                            <option>22K Jewelry</option>
                            <option>Silver 999</option>
                            <option>Scrap Gold</option>
                            <option>Silver Bar</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Gross Weight</label>
                        <input type="text" name="gross_weight" class="form-control" placeholder="Enter gross weight">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Less Weight</label>
                        <input type="text" name="less_weight" class="form-control" placeholder="Enter less weight">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Net Weight</label>
                        <input type="text" name="net_weight" class="form-control" placeholder="Enter net weight">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tunch (%)</label>
                        <input type="text" name="tunch" class="form-control" placeholder="Enter tunch (%)">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Wastage (%)</label>
                        <input type="text" name="wastage" class="form-control" placeholder="Enter wastage (%)">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Gold Fine</label>
                        <input type="text" name="gold_fine" class="form-control" placeholder="Enter gold fine">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Silver Fine</label>
                        <input type="text" name="silver_fine" class="form-control" placeholder="Enter silver fine">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter amount">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Reference No.</label>
                        <input type="text" name="reference_no" class="form-control"
                            placeholder="Enter reference number">
                    </div>

                </div>

                <!-- Buttons: Left (Save + Reset) | Right (Cancel) -->
                <div class="mt-4 d-flex justify-content-between">

                    <div>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-save me-2"></i> Save
                        </button>

                        <button type="reset" class="btn btn-warning text-white">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>

                        <a href="{{ route('ledger.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i> Cancel
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
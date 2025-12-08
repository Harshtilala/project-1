@extends('layouts.master')
@section('content')

<title>Edit Item</title>

<style>
    /* your same styles kept unchanged */
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
        border-radius: .375rem;
        padding: .5rem .75rem;
    }

    .btn {
        padding: .5rem 1.5rem;
        border-radius: .375rem;
    }

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
        padding: .5rem 1rem;
        background: #0d6efd;
        color: #fff;
        border-radius: .375rem;
        cursor: pointer;
        border: 1px solid #0d6efd;
        font-weight: 500;
    }

    .file-upload-label:hover {
        background: #0b5ed7;
    }

    .file-name {
        margin-left: 10px;
        font-size: .875rem;
        color: #6c757d;
        max-width: 200px;
        overflow: hidden;
    }
</style>

<div class="container-fluid py-4">
    <h2 class="title" style="font-size:28px;font-weight:bold;color:black;position:absolute;top:8px;">
        Edit Item
    </h2>

    <div class="card shadow-sm mb-4" style="position: relative; top: 30px;">
        <div class="card-body">

            <form id="itemMasterForm" action="{{ route('item.update', $item->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Row 1 -->
                <div class="row mb-2">
                    <div class="col-6 col-md-3">
                        <label class="form-label">Category Name</label>
                        <select class="form-select form-select-sm" name="categoryName" required>
                            <option value="">Select Category</option>
                            <option value="gold" {{ $item->categoryName=='gold'?'selected':'' }}>Gold</option>
                            <option value="silver" {{ $item->categoryName=='silver'?'selected':'' }}>Silver</option>
                            <option value="diamond" {{ $item->categoryName=='diamond'?'selected':'' }}>Diamond</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="itemName" class="form-control form-control-sm"
                            value="{{ $item->itemName }}" required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Short Item Name</label>
                        <input type="text" name="shortItemName" class="form-control form-control-sm"
                            value="{{ $item->shortItemName }}" required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">DLE No</label>
                        <input type="text" name="dleNo" class="form-control form-control-sm" value="{{ $item->dleNo }}">
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row mb-2">
                    <div class="col-6 col-md-3">
                        <label class="form-label">Design No</label>
                        <input type="text" class="form-control form-control-sm" name="designNo"
                            value="{{ $item->designNo }}">
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Min Order Qty</label>
                        <input type="number" class="form-control form-control-sm" name="minOrderQty"
                            value="{{ $item->minOrderQty }}">
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Default Wastage (%)</label>
                        <input type="number" class="form-control form-control-sm" name="defaultWastage"
                            value="{{ $item->defaultWastage }}">
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label me-2">Less</label>
                        <div class="form-check d-inline">
                            <input class="form-check-input" type="radio" name="lessOption" value="yes" {{
                                $item->lessOption=='yes'?'checked':'' }}>
                            <label class="form-check-label">Yes</label>
                        </div>

                        <div class="form-check d-inline ms-2">
                            <input class="form-check-input" type="radio" name="lessOption" value="no" {{
                                $item->lessOption=='no'?'checked':'' }}>
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>

                <!-- Row 3 Image -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Stock Transfer Wastage (%)</label>
                        <input type="number" class="form-control" name="stockTransferWastage"
                            value="{{ $item->stockTransferWastage }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Image Upload</label>

                        <div class="file-upload-container">
                            <input type="file" class="file-upload-input" id="itemImage" name="itemImage">
                            <label for="itemImage" class="file-upload-label">
                                <i class="fas fa-upload"></i> Choose Image
                            </label>
                            <span class="file-name" id="fileName">
                                {{ $item->itemImage ? $item->itemImage : 'No file chosen' }}
                            </span>
                        </div>

                        @if($item->itemImage)
                        <div class="mt-2">
                            <img src="{{ asset($item->itemImage) }}" width="100" class="img-thumbnail">
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row mb-2">
                    <div class="col-6 col-md-3">
                        <label class="form-label">Stock Method</label>
                        <select class="form-select form-select-sm" name="stockMethod">
                            <option value="fifo" {{ $item->stockMethod=='fifo'?'selected':'' }}>FIFO</option>
                            <option value="lifo" {{ $item->stockMethod=='lifo'?'selected':'' }}>LIFO</option>
                            <option value="average" {{ $item->stockMethod=='average'?'selected':'' }}>Average</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Sequence No</label>
                        <input type="number" class="form-control form-control-sm" name="sequenceNo"
                            value="{{ $item->sequenceNo }}">
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Rate No</label>
                        <input type="text" class="form-control form-control-sm" name="rateNo"
                            value="{{ $item->rateNo }}">
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Rate Off</label>
                        <input type="number" class="form-control form-control-sm" name="rateOff"
                            value="{{ $item->rateOff }}">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('item.index') }}" class="btn btn-secondary">← Back</a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('itemImage').addEventListener('change', function(e) {
        document.getElementById('fileName').textContent =
            e.target.files[0] ? e.target.files[0].name : 'No file chosen';
    });
</script>

@endsection
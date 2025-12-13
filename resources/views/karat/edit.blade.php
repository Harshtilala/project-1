@extends('layouts.master')
@section('content')

<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">

    <main class="content" style="flex: 1; padding: 24px; overflow-y: auto; background-color: #f4f6f9;">
        <div class="container-fluid">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Edit Karat Wise Stock</h2>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('karat.update', $karat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Stock Info -->
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-3">
                                <i class="fas fa-tag text-primary me-2"></i>Stock Information
                            </h5>

                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Stock Name</label>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="e.g. Gold Jewellery" value="{{ old('name', $karat->name) }}">

                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Karat Quantities -->
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-3">
                                <i class="fas fa-gem text-warning me-2"></i>Karat Quantities
                            </h5>

                            <div class="row g-4">

                                <!-- 22K -->
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                                    <i class="bi bi-gem text-primary"></i>
                                                </div>
                                                <h6 class="mb-0 fw-semibold">22K Gold</h6>
                                            </div>

                                            <input type="number" name="stock_22k"
                                                class="form-control @error('stock_22k') is-invalid @enderror"
                                                placeholder="Enter quantity"
                                                value="{{ old('stock_22k', $karat->stock_22k) }}">

                                            @error('stock_22k')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- 18K -->
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-warning bg-opacity-10 p-2 rounded-circle me-2">
                                                    <i class="bi bi-gem text-warning"></i>
                                                </div>
                                                <h6 class="mb-0 fw-semibold">18K Gold</h6>
                                            </div>

                                            <input type="number" name="stock_18k"
                                                class="form-control @error('stock_18k') is-invalid @enderror"
                                                placeholder="Enter quantity"
                                                value="{{ old('stock_18k', $karat->stock_18k) }}">

                                            @error('stock_18k')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- 14K -->
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-success bg-opacity-10 p-2 rounded-circle me-2">
                                                    <i class="bi bi-gem text-success"></i>
                                                </div>
                                                <h6 class="mb-0 fw-semibold">14K Gold</h6>
                                            </div>

                                            <input type="number" name="stock_14k"
                                                class="form-control @error('stock_14k') is-invalid @enderror"
                                                placeholder="Enter quantity"
                                                value="{{ old('stock_14k', $karat->stock_14k) }}">

                                            @error('stock_14k')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end pt-3 border-top">
                            <a href="{{ route('karat.index') }}" class="btn btn-light px-4 me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i>Update Stock
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </main>
</div>
@endsection
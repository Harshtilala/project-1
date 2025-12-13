@extends('layouts.master')
@section('content')

<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">

    <!-- Main Content -->
    <main class="main-content" style="flex: 1; padding: 20px; overflow-y: auto; background-color: #f8f9fa;">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="title" style="color: black; font-weight: bold; font-size: 28px;">Add New Stock</h2>
                <a href="{{ route('stockstatus.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Stock List
                </a>
            </div>

            <!-- Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('stockstatus.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <!-- Item Name -->
                            <div class="col-md-6">
                                <label for="item_name" class="form-label fw-bold">Item Name</label>
                                <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Enter item name" value="{{ old('item_name') }}" required>
                                @error('item_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Department / Category -->
                            <div class="col-md-6">
                                <label for="category" class="form-label fw-bold">Category</label>
                                <select name="category" id="category" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <option value="gold" {{ old('category')=='gold' ? 'selected' : '' }}>Gold</option>
                                    <option value="silver" {{ old('category')=='silver' ? 'selected' : '' }}>Silver</option>
                                    <option value="diamonds" {{ old('category')=='diamonds' ? 'selected' : '' }}>Diamonds</option>
                                    <option value="jewelry" {{ old('category')=='jewelry' ? 'selected' : '' }}>Jewelry</option>
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

       

                            <!-- Weight -->
                            <div class="col-md-6">
                                <label for="weight" class="form-label fw-bold">Weight (g)</label>
                                <input type="number" step="0.01" name="weight" id="weight" class="form-control" placeholder="Enter weight in grams" value="{{ old('weight') }}" required>
                                @error('weight')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Purity -->
                            <div class="col-md-6">
                                <label for="purity" class="form-label fw-bold">Purity</label>
                                <input type="text" name="purity" id="purity" class="form-control" placeholder="Enter purity (e.g., 22K, 18K)" value="{{ old('purity') }}" required>
                                @error('purity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-6">
                                <label for="quantity" class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                <i class="fas fa-save me-1"></i> Save Stock
                            </button>
                            <a href="{{ route('stockstatus.index') }}" class="btn btn-outline-secondary px-4 py-2 fw-bold">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>
</div>

@endsection

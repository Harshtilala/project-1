@extends('layouts.master')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Add New Diamond Stock</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('diamond_stocks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Diamond Name</label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Enter diamond name" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="natural" class="form-label">Natural</label>
            <input type="text" 
                   class="form-control @error('natural') is-invalid @enderror" 
                   id="natural" 
                   name="natural" 
                   value="{{ old('natural') }}" 
                   placeholder="Enter quantity of natural diamonds">
            @error('natural')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lab_grown" class="form-label">Lab Grown</label>
            <input type="text" 
                   class="form-control @error('lab_grown') is-invalid @enderror" 
                   id="lab_grown" 
                   name="lab_grown" 
                   value="{{ old('lab_grown') }}" 
                   placeholder="Enter quantity of lab grown diamonds">
            @error('lab_grown')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cvd" class="form-label">CVD</label>
            <input type="text" 
                   class="form-control @error('cvd') is-invalid @enderror" 
                   id="cvd" 
                   name="cvd" 
                   value="{{ old('cvd') }}" 
                   placeholder="Enter quantity of CVD diamonds">
            @error('cvd')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-2">Add Diamond Stock</button>
            <a href="{{ route('diamond_stocks.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection

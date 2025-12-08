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
        grid-template-columns: repeat(4, 1fr);
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
        pointer-events: none;
        z-index: 2;
    }

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

    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        font-size: 0.9375rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
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

    .btn {
        padding: 0.5rem 1.25rem;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: #0d6efd;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
    }

    .required {
        color: var(--danger-color);
    }

    .checkbox-group,
    .radio-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check-input {
        width: 1rem;
        height: 1rem;
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

<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
    <!-- Main Content -->
    <main class="content" style="flex: 1; padding: 2rem; overflow-y: auto;">
        <!-- Error Messages -->
        @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
        @endif

        <h1 class="title" style="color: black; margin-bottom: 2rem; font-size: 26px; font-weight: bold;">Edit User</h1>

        <div class="form-section">
            <form id="userForm" action="{{ route('users.update', $user->id) }}" method="POST" style="max-width: 100%;">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Type Dropdown -->
                    {{-- <div class="form-group">
                        <label for="user_type" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">
                            Type <span class="required">*</span>
                        </label>
                        <select name="user_type" id="user_type" class="form-control"
                            style="height: 36px; font-size: 13px;" required>
                            <option value="">Select Type</option>
                            <option value="admin" {{ old('user_type', $user->user_type) == 'admin' ? 'selected' : ''
                                }}>Admin</option>
                            <option value="manager" {{ old('user_type', $user->user_type) == 'manager' ? 'selected' : ''
                                }}>Manager</option>
                            <option value="staff" {{ old('user_type', $user->user_type) == 'staff' ? 'selected' : ''
                                }}>Staff</option>
                            <option value="designer" {{ old('user_type', $user->user_type) == 'designer' ? 'selected' :
                                '' }}>Designer</option>
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="user_type" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">
                            Type <span class="required">*</span>
                        </label>
                        <select name="user_type" id="user_type" class="form-control"
                            style="height: 36px; font-size: 13px;" required>
                            <option value="">Select Type</option>
                            <option value="admin" {{ old('user_type', $user->type ?? '') == 'admin' ? 'selected' : ''
                                }}>Admin</option>
                            <option value="manager" {{ old('user_type', $user->type ?? '') == 'manager' ? 'selected' :
                                '' }}>Manager</option>
                            <option value="staff" {{ old('user_type', $user->type ?? '') == 'staff' ? 'selected' : ''
                                }}>Staff</option>
                            <option value="designer" {{ old('user_type', $user->type ?? '') == 'designer' ? 'selected' :
                                '' }}>Designer</option>
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Full Name <span
                                class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $user->name) }}" style="height: 36px; font-size: 13px;" required>
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Username <span
                                class="required">*</span></label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $user->username) }}" style="height: 36px; font-size: 13px;"
                            required>
                    </div>

                    <!-- Password (optional for edit) -->
                    {{-- <div class="form-group">
                        <label for="password" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">New
                            Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            style="height: 36px; font-size: 13px;">
                    </div> --}}

                    <!-- Mobile -->
                    <div class="form-group">
                        <label for="mobile" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Mobile <span
                                class="required">*</span></label>
                        <input type="tel" name="mobile" id="mobile" class="form-control" pattern="[0-9]{10}"
                            value="{{ old('mobile', $user->mobile) }}" style="height: 36px; font-size: 13px;">
                    </div>

                    <!-- Opening Balance -->
                    <div class="form-group">
                        <label for="opening_balance" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Opening Bal.
                            (₹)</label>
                        <input type="number" name="opening_balance" id="opening_balance" class="form-control"
                            step="0.01" value="{{ old('opening_balance', $user->opening_balance) }}"
                            style="height: 36px; font-size: 13px;">
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Department</label>
                        <select name="department" id="department" class="form-control"
                            style="height: 36px; font-size: 13px;">
                            <option value="">Select Department</option>
                            <option value="sales" {{ old('department', $user->department) == 'sales' ? 'selected' : ''
                                }}>Sales</option>
                            <option value="design" {{ old('department', $user->department) == 'design' ? 'selected' : ''
                                }}>Design</option>
                            <option value="production" {{ old('department', $user->department) == 'production' ?
                                'selected' : '' }}>Production</option>
                            <option value="accounts" {{ old('department', $user->department) == 'accounts' ? 'selected'
                                : '' }}>Accounts</option>
                            <option value="admin" {{ old('department', $user->department) == 'admin' ? 'selected' : ''
                                }}>Administration</option>
                        </select>
                    </div>

                    <!-- Default Department -->
                    <div class="form-group">
                        <label for="default_department" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Default
                            Dept.</label>
                        <select name="default_department" id="default_department" class="form-control"
                            style="height: 36px; font-size: 13px;">
                            <option value="">Select Department</option>
                            <option value="sales" {{ old('default_department', $user->default_department) == 'sales' ?
                                'selected' : '' }}>Sales</option>
                            <option value="design" {{ old('default_department', $user->default_department) == 'design' ?
                                'selected' : '' }}>Design</option>
                            <option value="production" {{ old('default_department', $user->default_department) ==
                                'production' ? 'selected' : '' }}>Production</option>
                            <option value="accounts" {{ old('default_department', $user->default_department) ==
                                'accounts' ? 'selected' : '' }}>Accounts</option>
                            <option value="admin" {{ old('default_department', $user->default_department) == 'admin' ?
                                'selected' : '' }}>Administration</option>
                        </select>
                    </div>

                    <!-- Transaction Type -->
                    <div class="form-group">
                        <label for="transaction_type" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Transaction
                            Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control"
                            style="height: 36px; font-size: 13px;">
                            <option value="credit" {{ old('transaction_type', $user->transaction_type) == 'credit' ?
                                'selected' : '' }}>Credit</option>
                            <option value="debit" {{ old('transaction_type', $user->transaction_type) == 'debit' ?
                                'selected' : '' }}>Debit</option>
                        </select>
                    </div>

                    <!-- Confirm Password -->
                    {{-- <div class="form-group">
                        <label for="password_confirmation" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Confirm New
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" style="height: 36px; font-size: 13px;">
                    </div> --}}

                    <!-- Designation -->
                    <div class="form-group">
                        <label for="designation" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control"
                            value="{{ old('designation', $user->designation) }}" style="height: 36px; font-size: 13px;">
                    </div>

                    <!-- Salary -->
                    <div class="form-group">
                        <label for="salary" class="form-label"
                            style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Salary
                            (₹)</label>
                        <input type="number" name="salary" id="salary" class="form-control" step="0.01"
                            value="{{ old('salary', $user->salary) }}" style="height: 36px; font-size: 13px;">
                    </div>

                    <!-- CAD Designer Checkbox -->
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" name="is_cad_designer" id="is_cad_designer" class="form-check-input"
                                {{ old('is_cad_designer', $user->is_cad_designer) ? 'checked' : '' }} value="1">
                            <label for="is_cad_designer" class="form-label"
                                style="color:black; font-weight: bold; font-size: 13px; margin: 0; cursor: pointer;">CAD
                                Designer</label>
                        </div>
                    </div>

                    <!-- OTP to Mobile -->
                    <div class="form-group">
                        <div class="radio-group">
                            <span class="form-label"
                                style="color:black; font-weight: bold; font-size: 13px; white-space: nowrap; margin-right: 1rem;">OTP
                                to Mobile:</span>
                            <label class="radio-label"
                                style="display: flex; align-items: center; gap: 4px; font-size: 13px; margin: 0;">
                                <input type="radio" name="otp_to_mobile" value="yes" {{ old('otp_to_mobile',
                                    $user->otp_to_mobile == 'yes' || $user->otp_to_mobile === 1) ? 'checked' : '' }}>
                                <span>Yes</span>
                            </label>
                            <label class="radio-label"
                                style="display: flex; align-items: center; gap: 4px; font-size: 13px; margin: 0;">
                                <input type="radio" name="otp_to_mobile" value="no" {{ old('otp_to_mobile',
                                    $user->otp_to_mobile == 'no' || $user->otp_to_mobile === 0) ? 'checked' : '' }}>
                                <span>No</span>
                            </label>
                        </div>
                    </div>
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update User
                        </button>
                    </div>
            </form>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
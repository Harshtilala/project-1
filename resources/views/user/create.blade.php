@extends('layouts.master')
@section('content')

<div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
  <!-- Main Content -->
  <main class="content" style="flex: 1; padding: 2rem; overflow-y: auto;">
    <h1 class="title" style="color: black; margin-bottom: 2rem; font-size: 26px; font-weight: bold;">Add New User</h1>
    <div class="card" style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 2rem;">
      
      @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif

      @if($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form id="userForm" action="{{ route('users.store') }}" method="POST" style="max-width: 100%;">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
          
          <!-- Type Dropdown - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="userType" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Type <span class="required">*</span></label>
            <select id="userType" name="user_type" class="form-control" style="height: 36px; font-size: 13px;" required>
              <option value="">Select Type</option>
              <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="manager" {{ old('user_type') == 'manager' ? 'selected' : '' }}>Manager</option>
              <option value="staff" {{ old('user_type') == 'staff' ? 'selected' : '' }}>Staff</option>
              <option value="designer" {{ old('user_type') == 'designer' ? 'selected' : '' }}>Designer</option>
            </select>
          </div>

          <!-- Name - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="name" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Full Name <span class="required">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" style="height: 36px; font-size: 13px;" required>
          </div>

          <!-- Username - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="username" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Username <span class="required">*</span></label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" style="height: 36px; font-size: 13px;" required>
          </div>

          <!-- Password - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="password" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Password <span class="required">*</span></label>
            <input type="password" id="password" name="password" class="form-control" style="height: 36px; font-size: 13px;" required>
          </div>

          <!-- Mobile - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="mobile" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Mobile <span class="required">*</span></label>
            <input type="tel" id="mobile" name="mobile" class="form-control" pattern="[0-9]{10}" value="{{ old('mobile') }}" style="height: 36px; font-size: 13px;" required>
          </div>

          <!-- Opening Balance - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="openingBalance" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Opening Bal. (₹)</label>
            <input type="number" id="openingBalance" name="opening_balance" class="form-control" step="0.01" value="{{ old('opening_balance', 0) }}" style="height: 36px; font-size: 13px;">
          </div>

          <!-- Department - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="department" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Department</label>
            <select id="department" name="department" class="form-control" style="height: 36px; font-size: 13px;">
              <option value="">Select Department</option>
              <option value="sales" {{ old('department') == 'sales' ? 'selected' : '' }}>Sales</option>
              <option value="design" {{ old('department') == 'design' ? 'selected' : '' }}>Design</option>
              <option value="production" {{ old('department') == 'production' ? 'selected' : '' }}>Production</option>
              <option value="accounts" {{ old('department') == 'accounts' ? 'selected' : '' }}>Accounts</option>
              <option value="admin" {{ old('department') == 'admin' ? 'selected' : '' }}>Administration</option>
            </select>
          </div>

          <!-- Default Department - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="defaultDepartment" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Default Dept.</label>
            <select id="defaultDepartment" name="default_department" class="form-control" style="height: 36px; font-size: 13px;">
              <option value="">Select Department</option>
              <option value="sales" {{ old('default_department') == 'sales' ? 'selected' : '' }}>Sales</option>
              <option value="design" {{ old('default_department') == 'design' ? 'selected' : '' }}>Design</option>
              <option value="production" {{ old('default_department') == 'production' ? 'selected' : '' }}>Production</option>
              <option value="accounts" {{ old('default_department') == 'accounts' ? 'selected' : '' }}>Accounts</option>
              <option value="admin" {{ old('default_department') == 'admin' ? 'selected' : '' }}>Administration</option>
            </select>
          </div>

          <!-- Transaction Type - WITH OLD VALUE -->
          <div class="form-group">
            <label for="transactionType" class="form-label" style="color:black; font-weight: bold; font-size: 15px;">Transaction Type</label>
            <select id="transactionType" name="transaction_type" class="form-control">
              <option value="credit" {{ old('transaction_type') == 'credit' ? 'selected' : '' }}>Credit</option>
              <option value="debit" {{ old('transaction_type') == 'debit' ? 'selected' : '' }}>Debit</option>
            </select>
          </div>

          <!-- Confirm Password -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="confirmPassword" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Confirm Pass. <span class="required">*</span></label>
            <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" style="height: 36px; font-size: 13px;" required>
          </div>

          <!-- Designation - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="designation" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Designation</label>
            <input type="text" id="designation" name="designation" class="form-control" value="{{ old('designation') }}" style="height: 36px; font-size: 13px;">
          </div>

          <!-- Salary - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <label for="salary" class="form-label" style="color:black; font-weight: bold; font-size: 13px; margin-bottom: 4px;">Salary (₹)</label>
            <input type="number" id="salary" name="salary" class="form-control" step="0.01" value="{{ old('salary') }}">
          </div>

          <!-- CAD Designer - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <div style="display: flex; align-items: center; height: 100%; position: relative; left: -90px;">
              <input type="checkbox" id="isCadDesigner" name="is_cad_designer" class="form-checkbox" style="width: 16px; height: 16px; margin-right: 8px;" {{ old('is_cad_designer') ? 'checked' : '' }}>
              <label for="isCadDesigner" class="form-label" style="margin: 0; cursor: pointer; color: black; font-weight: bold; font-size: 13px; top: 2px; position: relative;">CAD Designer</label>
            </div>
          </div>

          <!-- OTP to Mobile - WITH OLD VALUE -->
          <div class="form-group" style="grid-column: span 1;">
            <div style="display: flex; align-items: center; height: 100%; gap: 8px; position: relative; left: -50px;">
              <span class="form-label" style="color:black; font-weight: bold; font-size: 13px; white-space: nowrap;">OTP to Mobile:</span>
              <div style="display: flex; align-items: center; gap: 8px;">
                <label class="radio-label" style="display: flex; align-items: center; gap: 4px; font-size: 13px; margin: 0;">
                  <input type="radio" name="otp_to_mobile" value="yes" {{ old('otp_to_mobile') == 'yes' ? 'checked' : '' }} style="margin: 0;">
                  <span>Yes</span>
                </label>
                <label class="radio-label" style="display: flex; align-items: center; gap: 4px; font-size: 13px; margin: 0;">
                  <input type="radio" name="otp_to_mobile" value="no" {{ old('otp_to_mobile') == 'no' ? 'checked' : '' }} style="margin: 0;">
                  <span>No</span>
                </label>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions" style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
          <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
          <button type="reset" class="btn btn-style"><i class="fas fa-undo me-1"></i>Reset</button>
          <button type="submit" class="btn btn-style" style="background-color: #0d6efd; color: white;"><i class="fas fa-save me-1"></i>Save</button>
        </div>
      </form>
    </div>
  </main>
</div>

<!-- Your exact same CSS unchanged -->
<style>
  /* All your existing CSS stays exactly the same */
  #userType, #department, #defaultDepartment, #transactionType {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    padding-right: 2.5rem;
  }
  /* ... rest of your CSS unchanged ... */
</style>

@endsection

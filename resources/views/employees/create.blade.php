@extends('layouts.app')

@php
$title = 'Add Employee';
$subTitle = 'Create New Employee';
@endphp

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="h5 fw-bold text-dark mb-1">{{ $title }}</h2>
        <p class="text-muted small mb-0">{{ $subTitle }}</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Employee No.</label>
                        <input type="text" name="emp_no" placeholder="Employee No." class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" placeholder="Full Name" class="form-control" required>
                    </div>

                    @php
                    $fields = [
                    ['label' => 'Gender', 'name' => 'gender', 'type' => 'select', 'options' => ['Male', 'Female', 'Other']],
                    ['label' => 'Designation', 'name' => 'designation'],
                    ['label' => 'Xpat Designation', 'name' => 'xpat_designation'],
                    ['label' => 'Xpat Join Date', 'name' => 'xpat_join_date', 'type' => 'date'],
                    ['label' => 'Department', 'name' => 'department'],
                    ['label' => 'Nationality', 'name' => 'nationality'],
                    ['label' => 'Passport/NIC No.', 'name' => 'passport_nic_no'],
                    ['label' => 'Passport/NIC Expiry', 'name' => 'passport_nic_no_expires', 'type' => 'date'],
                    ['label' => 'Date of Birth', 'name' => 'dob', 'type' => 'date'],
                    ['label' => 'Work Permit No.', 'name' => 'wp_no'],
                    ['label' => 'Date of Join', 'name' => 'date_of_join', 'type' => 'date'],
                    ['label' => 'Contact Number', 'name' => 'contact_number'],
                    ['label' => 'Foreign Contact Number', 'name' => 'contact_number_foregn'],
                    ['label' => 'Emergency Contact Number', 'name' => 'emergency_contact_number'],
                    ['label' => 'Emergency Contact Name', 'name' => 'emergency_contact_name'],
                    ['label' => 'Employment Status', 'name' => 'employment_status', 'type' => 'select', 'options' => ['Active', 'Terminated', 'Resigned', 'Rejoined', 'Dead', 'Retired', 'Missing']],
                    ['label' => 'Work Site', 'name' => 'work_site'],
                    ['label' => 'Insurance Provider', 'name' => 'insurance_provider'],
                    ['label' => 'Recruiting Agency', 'name' => 'recruiting_agency'],
                    ['label' => 'Employee Email', 'name' => 'emp_email', 'type' => 'email'],
                    ['label' => 'Company Email', 'name' => 'company_email', 'type' => 'email'],
                    ['label' => 'Permanent Address', 'name' => 'permanent_address'],
                    ['label' => 'Present Address', 'name' => 'persent_address'],
                    ['label' => 'Basic Salary', 'name' => 'basic_salary'],
                    ['label' => 'Salary Currency', 'name' => 'salary_currency', 'type' => 'select', 'options' => ['MVR', 'USD']],
                    ['label' => 'Termination Date', 'name' => 'termination_date', 'type' => 'date'],
                    ['label' => 'Level', 'name' => 'level', 'type' => 'select', 'options' => ['senior', 'junior', 'office']],
                    ['label' => 'Company', 'name' => 'company', 'type' => 'select', 'options' => ['RASHEED CARPENTRY AND CONSTRUCTION PVT LTD', 'NAZRASH COMPANY PVT LTD', 'other']],
                    ];
                    @endphp

                    @foreach ($fields as $field)
                    <div class="col-md-6">
                        <label class="form-label">{{ $field['label'] }}</label>
                        @if (($field['type'] ?? 'text') === 'select')
                        <select name="{{ $field['name'] }}" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($field['options'] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}" placeholder="{{ $field['label'] }}" class="form-control" required>
                        @endif
                    </div>
                    @endforeach
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

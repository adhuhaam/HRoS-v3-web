@extends('layouts.app')

@php
    $title = 'Edit Employee';
    $subTitle = 'Update Employee Information';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="emp_no" value="{{ $employee->emp_no }}" placeholder="Employee No."
                        class="form-input" required>
                    <input type="text" name="name" value="{{ $employee->name }}" placeholder="Full Name"
                        class="form-input" required>
                    <select name="gender" class="form-input">
                        <option value="">Select Gender</option>
                        <option value="Male" @selected($employee->gender == 'Male')>Male</option>
                        <option value="Female" @selected($employee->gender == 'Female')>Female</option>
                    </select>
                    <input type="text" name="designation" value="{{ $employee->designation }}" placeholder="Designation"
                        class="form-input">
                    <input type="text" name="xpat_designation" value="{{ $employee->xpat_designation }}"
                        placeholder="Xpat Designation" class="form-input">
                    <input type="date" name="xpat_join_date" value="{{ $employee->xpat_join_date }}" class="form-input">
                    <input type="text" name="department" value="{{ $employee->department }}" placeholder="Department"
                        class="form-input">
                    <input type="text" name="nationality" value="{{ $employee->nationality }}" placeholder="Nationality"
                        class="form-input">
                    <input type="text" name="passport_nic_no" value="{{ $employee->passport_nic_no }}"
                        placeholder="Passport/NIC No" class="form-input">
                    <input type="date" name="passport_nic_no_expires" value="{{ $employee->passport_nic_no_expires }}"
                        class="form-input">
                    <input type="date" name="dob" value="{{ $employee->dob }}" class="form-input">
                    <input type="text" name="wp_no" value="{{ $employee->wp_no }}" placeholder="Work Permit No"
                        class="form-input">
                    <input type="date" name="date_of_join" value="{{ $employee->date_of_join }}" class="form-input">
                    <input type="text" name="contact_number" value="{{ $employee->contact_number }}"
                        placeholder="Contact Number (Local)" class="form-input">
                    <input type="text" name="contact_number_foregn" value="{{ $employee->contact_number_foregn }}"
                        placeholder="Contact Number (Foreign)" class="form-input">
                    <input type="text" name="emergency_contact_number" value="{{ $employee->emergency_contact_number }}"
                        placeholder="Emergency Contact Number" class="form-input">
                    <input type="text" name="emergency_contact_name" value="{{ $employee->emergency_contact_name }}"
                        placeholder="Emergency Contact Name" class="form-input">

                    <select name="employment_status" class="form-input">
                        <option value="">Employment Status</option>
                        @foreach (['Active', 'Terminated', 'Resigned', 'Rejoined', 'Dead', 'Retired', 'Missing'] as $status)
                            <option value="{{ $status }}" @selected($employee->employment_status == $status)>{{ $status }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="work_site" value="{{ $employee->work_site }}" placeholder="Work Site"
                        class="form-input">
                    <input type="text" name="insurance_provider" value="{{ $employee->insurance_provider }}"
                        placeholder="Insurance Provider" class="form-input">
                    <input type="text" name="recruiting_agency" value="{{ $employee->recruiting_agency }}"
                        placeholder="Recruiting Agency" class="form-input">
                    <input type="email" name="emp_email" value="{{ $employee->emp_email }}"
                        placeholder="Employee Email" class="form-input">
                    <input type="email" name="company_email" value="{{ $employee->company_email }}"
                        placeholder="Company Email" class="form-input">
                    <textarea name="permanent_address" class="form-input" placeholder="Permanent Address">{{ $employee->permanent_address }}</textarea>
                    <textarea name="persent_address" class="form-input" placeholder="Present Address">{{ $employee->persent_address }}</textarea>
                    <input type="number" name="basic_salary" value="{{ $employee->basic_salary }}"
                        placeholder="Basic Salary" class="form-input">

                    <select name="salary_currency" class="form-input">
                        <option value="MVR" @selected($employee->salary_currency == 'MVR')>MVR</option>
                        <option value="USD" @selected($employee->salary_currency == 'USD')>USD</option>
                    </select>

                    <input type="date" name="termination_date" value="{{ $employee->termination_date }}"
                        class="form-input">

                    <select name="level" class="form-input">
                        <option value="">Employee Level</option>
                        @foreach (['senior', 'junior', 'office'] as $lvl)
                            <option value="{{ $lvl }}" @selected($employee->level == $lvl)>{{ ucfirst($lvl) }}</option>
                        @endforeach
                    </select>

                    <select name="company" class="form-input" required>
                        <option value="">Select Company</option>
                        @foreach (['RASHEED CARPENTRY AND CONSTRUCTION PVT LTD', 'NAZRASH COMPANY PVT LTD', 'other'] as $comp)
                            <option value="{{ $comp }}" @selected($employee->company == $comp)>{{ $comp }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-6">
                    <button class="btn bg-primary-600 text-white">Update</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

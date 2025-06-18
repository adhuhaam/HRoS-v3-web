<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:view employees')->only(['index', 'show']);
        $this->middleware('permission:add employees')->only(['create', 'store']);
        $this->middleware('permission:edit employees')->only(['edit', 'update']);
        $this->middleware('permission:delete employees')->only(['destroy', 'confirmDelete']);
    }

    public function index()
    {
        $employees = Employee::paginate(15);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emp_no' => 'required|unique:employees',
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'designation' => 'nullable|string',
            'xpat_designation' => 'nullable|string',
            'xpat_join_date' => 'nullable|date',
            'department' => 'nullable|string',
            'nationality' => 'nullable|string',
            'passport_nic_no' => 'nullable|string',
            'passport_nic_no_expires' => 'nullable|date',
            'dob' => 'nullable|date',
            'wp_no' => 'nullable|string',
            'date_of_join' => 'nullable|date',
            'contact_number' => 'nullable|string',
            'contact_number_foregn' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string',
            'employment_status' => 'required|in:Active,Terminated,Resigned,Rejoined,Dead,Retired,Missing',
            'work_site' => 'nullable|string',
            'insurance_provider' => 'nullable|string',
            'recruiting_agency' => 'nullable|string',
            'emp_email' => 'nullable|email',
            'company_email' => 'nullable|email',
            'permanent_address' => 'nullable|string',
            'persent_address' => 'nullable|string',
            'basic_salary' => 'nullable|numeric',
            'salary_currency' => 'required|in:MVR,USD',
            'termination_date' => 'nullable|date',
            'level' => 'required|in:senior,junior,office',
            'company' => 'required|in:RASHEED CARPENTRY AND CONSTRUCTION PVT LTD,NAZRASH COMPANY PVT LTD,other',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'emp_no' => 'required|unique:employees,emp_no,' . $employee->id,
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'designation' => 'nullable|string',
            'xpat_designation' => 'nullable|string',
            'xpat_join_date' => 'nullable|date',
            'department' => 'nullable|string',
            'nationality' => 'nullable|string',
            'passport_nic_no' => 'nullable|string',
            'passport_nic_no_expires' => 'nullable|date',
            'dob' => 'nullable|date',
            'wp_no' => 'nullable|string',
            'date_of_join' => 'nullable|date',
            'contact_number' => 'nullable|string',
            'contact_number_foregn' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string',
            'employment_status' => 'required|in:Active,Terminated,Resigned,Rejoined,Dead,Retired,Missing',
            'work_site' => 'nullable|string',
            'insurance_provider' => 'nullable|string',
            'recruiting_agency' => 'nullable|string',
            'emp_email' => 'nullable|email',
            'company_email' => 'nullable|email',
            'permanent_address' => 'nullable|string',
            'persent_address' => 'nullable|string',
            'basic_salary' => 'nullable|numeric',
            'salary_currency' => 'required|in:MVR,USD',
            'termination_date' => 'nullable|date',
            'level' => 'required|in:senior,junior,office',
            'company' => 'required|in:RASHEED CARPENTRY AND CONSTRUCTION PVT LTD,NAZRASH COMPANY PVT LTD,other',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated.');
    }

    /**
     * Show confirmation page before deleting.
     */
    public function confirmDelete(Employee $employee)
    {
        return view('employees.destroy', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'emp_no', 'name', 'gender', 'designation', 'xpat_designation', 'xpat_join_date', 'department',
        'nationality', 'passport_nic_no', 'passport_nic_no_expires', 'dob', 'wp_no', 'date_of_join',
        'contact_number', 'contact_number_foregn', 'emergency_contact_number', 'emergency_contact_name',
        'employment_status', 'work_site', 'insurance_provider', 'recruiting_agency',
        'emp_email', 'company_email', 'permanent_address', 'persent_address',
        'basic_salary', 'salary_currency', 'termination_date', 'level', 'company'
    ];
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_no')->unique();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('designation')->nullable();
            $table->string('xpat_designation')->nullable();
            $table->date('xpat_join_date')->nullable();
            $table->string('department')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_nic_no')->nullable();
            $table->date('passport_nic_no_expires')->nullable();
            $table->date('dob')->nullable();
            $table->string('wp_no')->nullable();
            $table->date('date_of_join')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_number_foregn')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->enum('employment_status', ['Active','Terminated','Resigned','Rejoined','Dead','Retired','Missing'])->default('Active');
            $table->string('work_site')->nullable();
            $table->string('insurance_provider')->nullable();
            $table->string('recruiting_agency')->nullable();
            $table->string('emp_email')->nullable();
            $table->string('company_email')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('persent_address')->nullable();
            $table->decimal('basic_salary', 12, 2)->nullable();
            $table->enum('salary_currency', ['MVR', 'USD'])->default('MVR');
            $table->date('termination_date')->nullable();
            $table->enum('level', ['senior', 'junior', 'office'])->default('junior');
            $table->enum('company', [
                'RASHEED CARPENTRY AND CONSTRUCTION PVT LTD',
                'NAZRASH COMPANY PVT LTD',
                'other'
            ]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

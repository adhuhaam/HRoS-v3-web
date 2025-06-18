<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Hr\VacancyController as HrVacancyController;
use App\Http\Controllers\Hr\CandidateController as HrCandidateController;
use App\Http\Controllers\Agent\CandidateController as AgentCandidateController;
use App\Http\Controllers\UserManagementController as UserManagementController;

// Public route
Route::get('/', fn() => view('welcome'));

// Dashboard (role-based)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Authenticated User Routes
Route::middleware('auth')->group(function () {

    // 🔐 Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🧑‍💼 Employee Management (Permission-based)
    Route::middleware('permission:view employees')->get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::middleware('permission:add employees')->group(function () {
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    });

    Route::middleware('permission:view employees')->get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

    Route::middleware('permission:edit employees')->group(function () {
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    });

    Route::middleware('permission:delete employees')->group(function () {
        Route::get('/employees/{employee}/confirm-delete', [EmployeeController::class, 'confirmDelete'])->name('employees.confirmDelete');
        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    // 📄 HR Routes: Vacancies & Candidates (Full CRUD)
    Route::middleware('role:super admin|hr manager|hr staff')->group(function () {

        Route::get('/vacancies/{vacancy}/confirm-delete', [HrVacancyController::class, 'confirmDelete'])->name('vacancies.confirmDelete');
        Route::post('/candidates/bulk', [HrCandidateController::class, 'bulk'])->name('candidates.bulk'); // bulk action route
        Route::resource('vacancies', HrVacancyController::class);
        Route::resource('candidates', HrCandidateController::class);
    });
});

// 👨‍💼 Agent Routes (Only for candidates under assigned vacancies)
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/vacancies', [HrVacancyController::class, 'agentIndex'])->name('vacancies');

    Route::get('/vacancies/{vacancy}/candidates', [AgentCandidateController::class, 'agentIndex'])->name('candidates.index');
    Route::get('/candidates/create', [AgentCandidateController::class, 'create'])->name('candidates.create');
    Route::post('/vacancies/{vacancy}/candidates', [AgentCandidateController::class, 'store'])->name('candidates.store');
    Route::get('/vacancies/{vacancy}/candidates/{candidate}/edit', [AgentCandidateController::class, 'edit'])->name('candidates.edit');
    Route::put('/vacancies/{vacancy}/candidates/{candidate}', [AgentCandidateController::class, 'update'])->name('candidates.update');
    Route::delete('/vacancies/{vacancy}/candidates/{candidate}', [AgentCandidateController::class, 'destroy'])->name('candidates.destroy');
});


// routes/web.php
Route::middleware(['auth', 'role:super admin'])->group(function () {
    Route::get('/settings/addagentandclients', [UserManagementController::class, 'create'])->name('settings.addagentandclients');
    Route::post('/settings/addagentandclients', [UserManagementController::class, 'store'])->name('settings.saveagentorclient');
    Route::get('/settings/viewagentsandclients', [UserManagementController::class, 'listAgentsAndClients'])->name('settings.viewagentsandclients');
});

require __DIR__ . '/auth.php';

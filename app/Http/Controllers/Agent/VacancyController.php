<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Agent: View own assigned vacancies
     */
    public function index()
    {
        $vacancies = Auth::user()->assignedVacancies()->with('designation')->get();
        return view('agent.vacancies.index', compact('vacancies'));
    }
}

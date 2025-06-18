<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    /**
     * HR: View all vacancies
     */
    public function index()
    {
        $vacancies = Vacancy::with(['designation', 'agent'])->latest()->paginate(20);
        return view('hr.vacancies.index', compact('vacancies'));
    }

    /**
     * HR: Edit a vacancy
     */
    public function edit(Vacancy $vacancy)
    {
        $designations = Designation::all();
        $agents = User::role('agent')->get(); // ✅ fixed from 'agents' to 'agent'

        return view('vacancies.edit', compact('vacancy', 'designations', 'agents'));
    }

    /**
     * HR: Update a vacancy
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $validated = $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'agent_id' => 'required|exists:users,id',
            'candidate_limit' => 'nullable|integer|min:1',
            'allow_unlimited' => 'boolean',
        ]);

        $vacancy->update([
            'designation_id' => $validated['designation_id'],
            'agent_id' => $validated['agent_id'],
            'candidate_limit' => $validated['allow_unlimited'] ? null : $validated['candidate_limit'],
            'allow_unlimited' => $validated['allow_unlimited'],
        ]);

        return redirect()->route('vacancies.index')->with('success', 'Vacancy updated successfully.');
    }

    /**
     * HR: Confirm delete view
     */
    public function confirmDelete(Vacancy $vacancy)
    {
        return view('vacancies.confirm-delete', compact('vacancy'));
    }

    /**
     * HR: Delete vacancy
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('vacancies.index')->with('success', 'Vacancy deleted.');
    }

    /**
     * Agent: View own assigned vacancies
     */
    public function agentIndex()
    {
        $vacancies = Auth::user()->assignedVacancies()->with('designation')->get();
        return view('agent.vacancies.index', compact('vacancies'));
    }
}

<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Designation;
use App\Models\User;

use Illuminate\Http\Request;

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
     * HR: Show create form
     */
    public function create()
    {
        $designations = Designation::all();
        $agents = User::role('agent')->get();
        return view('hr.vacancies.create', compact('designations', 'agents'));
    }

    /**
     * HR: Store new vacancy
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'agent_id' => 'required|exists:users,id',
            'candidate_limit' => 'nullable|integer|min:1',
            'allow_unlimited' => 'boolean',
        ]);

        Vacancy::create([
            ...$validated,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('vacancies.index')->with('success', 'Vacancy created successfully.');
    }

    /**
     * HR: Show edit form
     */
    public function edit(Vacancy $vacancy)
    {
        $designations = Designation::all();
        $agents = User::role('agent')->get();
        return view('hr.vacancies.edit', compact('vacancy', 'designations', 'agents'));
    }

    /**
     * HR: Update vacancy
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
     * HR: Show confirm delete page
     */
    public function confirmDelete(Vacancy $vacancy)
    {
        return view('hr.vacancies.confirm-delete', compact('vacancy'));
    }

    /**
     * HR: Delete a vacancy
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('vacancies.index')->with('success', 'Vacancy deleted.');
    }

    /**
     * Agent: Only view their own assigned vacancies (if reused)
     */
    public function agentIndex()
    {
        $vacancies = auth()->user()->assignedVacancies()->with('designation')->get();
        return view('agent.vacancies.index', compact('vacancies'));
    }
}

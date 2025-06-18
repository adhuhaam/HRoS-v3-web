<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Agent: View candidates for an assigned vacancy
     */
    public function agentIndex($vacancyId)
    {
        $vacancy = Auth::user()->assignedVacancies()->findOrFail($vacancyId);
        $candidates = $vacancy->candidates()->where('agent_id', Auth::id())->get();

        return view('agent.candidates.index', compact('vacancy', 'candidates'));
    }

    /**
     * Agent: Show create form
     */
    public function create()
    {
        $vacancies = Auth::user()->assignedVacancies()->with('designation')->get();

        if ($vacancies->isEmpty()) {
            abort(403, 'No assigned vacancies available.');
        }

        return view('agent.candidates.create', compact('vacancies'));
    }


    /**
     * Agent: Store a new candidate
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255|unique:candidates',
            'vacancy_id' => 'required|exists:vacancies,id',
            // Add more validation rules if needed
        ]);

        // Ensure the selected vacancy belongs to the logged-in agent
        $vacancy = Auth::user()->assignedVacancies()->findOrFail($validated['vacancy_id']);

        $vacancy->candidates()->create([
            'name' => $validated['name'],
            'passport_number' => $validated['passport_number'],
            'agent_id' => Auth::id(),
        ]);

        return redirect()->route('agent.candidates.index', ['vacancy' => $vacancy->id])
            ->with('success', 'Candidate added successfully.');
    }


    /**
     * Agent: Show edit form
     */
    public function edit(Vacancy $vacancy, Candidate $candidate)
    {
        if ($vacancy->agent_id !== Auth::id() || $candidate->agent_id !== Auth::id()) {
            abort(403);
        }

        return view('agent.candidates.edit', compact('vacancy', 'candidate'));
    }

    /**
     * Agent: Update candidate
     */
    public function update(Request $request, Vacancy $vacancy, Candidate $candidate)
    {
        if ($vacancy->agent_id !== Auth::id() || $candidate->agent_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255|unique:candidates,passport_number,' . $candidate->id,
            // Add other fields as necessary
        ]);

        $candidate->update($validated);

        return redirect()->route('agent.candidates.index', ['vacancy' => $vacancy->id])
            ->with('success', 'Candidate updated successfully.');
    }

    /**
     * Agent: Delete candidate
     */
    public function destroy(Vacancy $vacancy, Candidate $candidate)
    {
        if ($vacancy->agent_id !== Auth::id() || $candidate->agent_id !== Auth::id()) {
            abort(403);
        }

        $candidate->delete();

        return redirect()->route('agent.candidates.index', ['vacancy' => $vacancy->id])
            ->with('success', 'Candidate deleted.');
    }
}

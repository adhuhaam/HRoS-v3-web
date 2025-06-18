<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CandidateController extends Controller
{
    /**
     * Display a listing of candidates with optional filters.
     */
    public function index(Request $request)
    {
        $query = Candidate::with(['vacancy.designation', 'agent']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('passport_number', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('agent_id')) {
            $query->where('agent_id', $request->agent_id);
        }

        if ($request->filled('vacancy_id')) {
            $query->where('vacancy_id', $request->vacancy_id);
        }

        $candidates = $query->latest()->paginate(20);
        $agents = User::role('agent')->get();
        $vacancies = Vacancy::with('designation')->get();

        return view('hr.candidates.index', compact('candidates', 'agents', 'vacancies'));
    }

    /**
     * Show the form for creating a new candidate.
     */
    public function create()
    {
        $vacancies = Vacancy::with('designation')->get();
        $agents = User::role('agent')->get();
        return view('hr.candidates.create', compact('vacancies', 'agents'));
    }

    /**
     * Store a newly created candidate.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:100|unique:candidates',
            'vacancy_id' => 'required|exists:vacancies,id',
            'agent_id' => 'required|exists:users,id',
        ]);

        Candidate::create($validated);

        return redirect()->route('candidates.index')->with('success', 'Candidate created successfully.');
    }

    /**
     * Show the form for editing a candidate.
     */
    public function edit(Candidate $candidate)
    {
        $vacancies = Vacancy::with('designation')->get();
        $agents = User::role('agent')->get();
        return view('hr.candidates.edit', compact('candidate', 'vacancies', 'agents'));
    }

    /**
     * Update the specified candidate.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:100|unique:candidates,passport_number,' . $candidate->id,
            'vacancy_id' => 'required|exists:vacancies,id',
            'agent_id' => 'required|exists:users,id',
        ]);

        $candidate->update($validated);

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    /**
     * Display the specified candidate.
     */
    public function show(Candidate $candidate)
    {
        return view('hr.candidates.show', compact('candidate'));
    }

    /**
     * Remove the specified candidate.
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted.');
    }

    /**
     * Perform bulk actions (shortlist or export) on candidates.
     */
    public function bulk(Request $request)
    {
        $candidateIds = $request->input('selected', []);
        $action = $request->input('action');

        if (empty($candidateIds)) {
            return redirect()->back()->with('error', 'No candidates selected.');
        }

        if ($action === 'shortlist') {
            DB::table('candidates')->whereIn('id', $candidateIds)->update([
                'status' => 'Shortlisted',
                'last_updated' => now(),
            ]);

            return redirect()->back()->with('success', 'Selected candidates have been shortlisted.');
        }

        if ($action === 'export') {
            $candidates = Candidate::with(['vacancy.designation', 'agent'])
                ->whereIn('id', $candidateIds)
                ->get();

            $csvData = [['Name', 'Passport No', 'Nationality', 'Status', 'Vacancy', 'Agent', 'Last Updated']];

            foreach ($candidates as $c) {
                $csvData[] = [
                    $c->name,
                    $c->passport_number,
                    $c->nationality,
                    $c->status,
                    optional($c->vacancy->designation)->title,
                    optional($c->agent)->name,
                    $c->last_updated,
                ];
            }

            $filename = 'candidates_export_' . now()->format('Ymd_His') . '.csv';

            $headers = [
                'Content-type'        => 'text/csv',
                'Content-Disposition' => "attachment; filename={$filename}",
            ];

            $callback = function () use ($csvData) {
                $file = fopen('php://output', 'w');
                foreach ($csvData as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            };

            return Response::stream($callback, 200, $headers);
        }

        return redirect()->back()->with('error', 'Invalid action selected.');
    }
}

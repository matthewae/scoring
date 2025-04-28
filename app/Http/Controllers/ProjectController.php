<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->latest()->get();
        return view('user.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('user.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kementerian' => 'required|string|max:255',
            'konsultan_perencana' => 'required|string|max:255',
            'konsultan_mk' => 'required|string|max:255',
            'kontraktor_pelaksana' => 'required|string|max:255',
            'metode_pemilihan' => 'required|string|max:255',
            'nilai_kontrak' => 'required|numeric',
            'tanggal_spmk' => 'required|date',
            'jangka_waktu' => 'required|integer'
        ]);

        $project = Auth::user()->projects()->create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('user.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kementerian' => 'required|string|max:255',
            'konsultan_perencana' => 'required|string|max:255',
            'konsultan_mk' => 'required|string|max:255',
            'kontraktor_pelaksana' => 'required|string|max:255',
            'metode_pemilihan' => 'required|string|max:255',
            'nilai_kontrak' => 'required|numeric',
            'tanggal_spmk' => 'required|date',
            'jangka_waktu' => 'required|integer'
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        
        $documentTypes = $project->documentTypes()
            ->with(['submissionFiles' => function($query) use ($project) {
                $query->whereHas('submission', function($q) use ($project) {
                    $q->where('project_id', $project->id);
                });
            }])
            ->get()
            ->groupBy('category');

        $totalScore = $project->submissions()->sum('score');
        $maxScore = $project->documentTypes()->sum('max_score');
        $approvedCount = $project->submissions()->where('status', 'approved')->count();
        $totalDocuments = $project->documentTypes()->count();

        return view('user.projects.show', compact(
            'project',
            'documentTypes',
            'totalScore',
            'maxScore',
            'approvedCount',
            'totalDocuments'
        ));
    }
}
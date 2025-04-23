<?php

namespace App\Http\Controllers;

use App\Models\AssistanceRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistanceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check.status']);
    }

    public function index()
    {
        $requests = AssistanceRequest::with(['user', 'project'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('assistance.index', compact('requests'));
    }

    public function create()
    {
        $projects = Project::where('is_active', true)->get();
        return view('assistance.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'notes' => 'required|string|max:1000'
        ]);

        $assistanceRequest = AssistanceRequest::create([
            'user_id' => Auth::id(),
            'project_id' => $request->project_id,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->route('assistance.index')
            ->with('success', 'Your assistance request has been submitted successfully.');
    }

    public function show(AssistanceRequest $assistanceRequest)
    {
        $this->authorize('view', $assistanceRequest);
        return view('assistance.show', compact('assistanceRequest'));
    }

    public function update(Request $request, AssistanceRequest $assistanceRequest)
    {
        $this->authorize('update', $assistanceRequest);
        
        $validated = $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        $assistanceRequest->update($validated);

        return redirect()->route('assistance.show', $assistanceRequest)
            ->with('success', 'Assistance request updated successfully.');
    }

    public function getProjects()
    {
        $projects = Project::where('is_active', true)->get(['id', 'name']);
        return response()->json($projects);
    }
}
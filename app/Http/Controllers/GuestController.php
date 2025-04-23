<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Project;
use App\Models\Submission;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'check.status']);
    }

    /**
     * Show the guest dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $documentTypes = DocumentType::all();
        $submissions = Submission::with(['files.documentType', 'files.documentScore'])
            ->where('user_id', auth()->id())
            ->get();
        $projects = Project::where('is_active', true)->get();

        return view('guest.index', compact('documentTypes', 'submissions', 'projects'));
    }

    /**
     * Handle a guest's request for assistance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestAssistance(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
        ]);

        // Store the assistance request and notify relevant users
        // For now, just redirect back with a success message
        return redirect()->route('guest.home')
            ->with('status', 'Your assistance request has been submitted successfully.');
    }

    /**
     * Handle a guest's request for document upload assistance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Show the upload request form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showRequestUpload()
    {
        $documentTypes = DocumentType::all();
        return view('guest.request-upload', compact('documentTypes'));
    }

    /**
     * Handle a guest's request for document upload assistance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestUpload(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'document_types' => 'required|array',
            'document_types.*' => 'exists:document_types,id',
            'deadline' => 'required|date|after:today',
            'special_requirements' => 'nullable|string|max:1000',
            'contact_email' => 'required|email'
        ]);

        // Create a new submission with upload request status
        $submission = new Submission([
            'user_id' => auth()->id(),
            'status' => 'pending_upload',
            'notes' => $request->special_requirements,
            'project_name' => $request->project_name,
            'deadline' => $request->deadline,
            'contact_email' => $request->contact_email
        ]);
        $submission->save();

        return redirect()->route('guest.index')
            ->with('success', 'Your upload request has been submitted successfully. Our team will process your documents.');
    }
}
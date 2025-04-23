<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\DocumentType;
use App\Models\SubmissionFile;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function create()
    {
        $documentTypes = DocumentType::orderBy('category')->get()->groupBy('category');
        $submissionFiles = SubmissionFile::where('user_id', Auth::id())
            ->whereNotNull('document_type_id')
            ->get()
            ->keyBy('document_type_id');

        $totalScore = $submissionFiles->sum('score');
        $maxScore = DocumentType::sum('max_score');
        $approvedCount = $submissionFiles->where('status', 'approved')->count();
        $totalDocuments = DocumentType::count();
        
        $projects = Project::where('is_active', true)->get();
        
        return view('guest.upload', compact('documentTypes', 'submissionFiles', 'totalScore', 'maxScore', 'approvedCount', 'totalDocuments', 'projects'));

    }
    public function index()
    {
        $submissions = Submission::where('user_id', Auth::id())
            ->with('files')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guest.submissions', compact('submissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'projectFiles' => 'required|array',
            'projectFiles.*' => 'required|file|max:10240',
        ]);

        $submission = Submission::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        foreach ($request->file('projectFiles') as $file) {
            $submission->files()->create([
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $file->store('submissions'),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        return redirect()->route('guest.submissions.index')
            ->with('status', __('Files uploaded successfully. Your submission is pending review.'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'document_type_id' => 'required|exists:document_types,id',
            'memo' => 'nullable|string|max:1000',
        ]);

        $submission = Submission::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        $file = $request->file('file');
        $documentType = DocumentType::findOrFail($request->document_type_id);
        
        $submissionFile = SubmissionFile::createFromUploadedFile(
            $submission,
            $file,
            $documentType,
            $request->memo
        );

        return redirect()->route('guest.submissions.index')
            ->with('status', __('File uploaded successfully. Your submission is pending review.'));
    }
}
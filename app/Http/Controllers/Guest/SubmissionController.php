<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
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
}
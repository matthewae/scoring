<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $pendingSubmissions = Submission::where('status', 'pending')
            ->with(['files', 'user'])
            ->orderBy('created_at', 'asc')
            ->get();

        $scoredSubmissions = Submission::where('status', 'scored')
            ->with(['files', 'user'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('user.submissions', [
            'pendingSubmissions' => $pendingSubmissions,
            'scoredSubmissions' => $scoredSubmissions,
        ]);
    }

    public function score(Request $request, Submission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'feedback' => 'required|string|max:1000',
        ]);

        $submission->score(
            $request->input('score'),
            $request->input('feedback')
        );

        return redirect()->route('user.submissions.index')
            ->with('status', __('Submission scored successfully.'));
    }

    public function download(Submission $submission)
    {
        $this->authorize('view', $submission);

        $zipFileName = 'submission_' . $submission->id . '.zip';
        $zip = new \ZipArchive();

        $tempFile = tempnam(sys_get_temp_dir(), 'submission_');
        $zip->open($tempFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($submission->files as $file) {
            $zip->addFile(storage_path('app/' . $file->file_path), $file->original_name);
        }

        $zip->close();

        return response()->download($tempFile, $zipFileName)->deleteFileAfterSend();
    }

    public function upload(Request $request)
    {
        $request->validate([
            'projectFiles' => 'required|array',
            'projectFiles.*' => 'required|file|max:10240',
        ]);

        $submission = Submission::create([
            'user_id' => auth()->id(),
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

        return redirect()->route('user.home')
            ->with('status', __('Files uploaded successfully. Your submission is pending review.'));
    }
}
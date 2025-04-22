<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\ProjectDetail;
use App\Models\Submission;
use Illuminate\Http\Request;

class ScoringController extends Controller
{
    public function userIndex(Request $request)
    {
        $projects = ProjectDetail::all();
        $documentTypes = DocumentType::all();
        $submission = null;

        if ($request->has('project_id')) {
            $submission = Submission::where('user_id', auth()->id())
                ->where('project_id', $request->project_id)
                ->with(['files.documentScore', 'files.documentType'])
                ->first();
        }

        return view('user.scoring', compact('projects', 'documentTypes', 'submission'));
    }

    public function guestIndex(Request $request)
    {
        $projects = ProjectDetail::all();
        $documentTypes = DocumentType::all();
        $submission = null;

        if ($request->has('project_id')) {
            $submission = Submission::where('project_id', $request->project_id)
                ->where('guest_id', session('guest_id'))
                ->with(['files.documentScore', 'files.documentType'])
                ->first();
        }

        return view('guest.scoring', compact('projects', 'documentTypes', 'submission'));
    }
}
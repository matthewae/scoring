<?php

use App\Http\Controllers\ProjectController;
use App\Models\Project;
use App\Models\DocumentType;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;
use App\Http\Controllers\ScoringController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\SubmissionController as GuestSubmissionController;
use App\Http\Controllers\User\SubmissionController as UserSubmissionController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/files/{file}/download', [\App\Http\Controllers\FileController::class, 'download'])->name('files.download');

Route::get('/home', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    if (auth()->user()->isGuest()) {
        return redirect()->route('guest.index');
    }
    return redirect()->route('user.home');
})->name('home');

// Project management routes
Route::resource('projects', ProjectController::class);

// Guest upload routes with project filtering
Route::get('/guest/upload', function (Request $request) {
    $projects = Project::where('is_active', true)->get();
    $selectedProject = null;

    if ($request->has('project')) {
        $selectedProject = Project::findOrFail($request->project);
        $documentTypes = DocumentType::orderBy('category')->get()->groupBy('category');
        $submissionFiles = SubmissionFile::where('project_id', $selectedProject->id)
            ->get()
            ->keyBy('document_type_id');
        $totalScore = $submissionFiles->sum('score');
        $maxScore = DocumentType::sum('max_score');
        $approvedCount = $submissionFiles->where('status', 'approved')->count();
        $totalDocuments = DocumentType::count();

        return view('guest.upload', compact(
            'projects',
            'documentTypes',
            'submissionFiles',
            'totalScore',
            'maxScore',
            'approvedCount',
            'totalDocuments'
        ));
    }

    return view('guest.upload', compact('projects'));
})->name('guest.upload');

// Guest routes
Route::middleware(['auth', 'check.status'])->prefix('guest')->name('guest.')->group(function () {
    Route::get('/index', [GuestController::class, 'index'])->name('index');
    Route::get('/home', function () {
        return view('guest.home');
    })->name('home');
    Route::get('/request-upload', [GuestController::class, 'showRequestUpload'])->name('request-upload');
    Route::get('/upload', [GuestSubmissionController::class, 'create'])->name('upload');
    Route::get('/submissions', [GuestSubmissionController::class, 'index'])->name('submissions.index');
    Route::post('/submissions', [GuestSubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/self-upload', [GuestSubmissionController::class, 'create'])->name('self-upload');
    Route::post('/self-upload', [GuestSubmissionController::class, 'store'])->name('self-upload.store');
    Route::post('/request-assistance', [GuestController::class, 'requestAssistance'])->name('request-assistance');
    Route::post('/files/upload', [GuestSubmissionController::class, 'upload'])->name('files.upload');
    Route::post('/upload-request', [GuestController::class, 'requestUpload'])->name('upload.request');
});

// User routes
Route::middleware(['auth', 'check.status'])->prefix('user')->name('user.')->group(function () {
    Route::get('/home', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
    Route::get('/submissions', [UserSubmissionController::class, 'index'])->name('submissions.index');
    Route::post('/submissions/{submission}/score', [UserSubmissionController::class, 'score'])->name('submissions.score');
    Route::get('/submissions/{submission}/download', [UserSubmissionController::class, 'download'])->name('submissions.download');
    Route::post('/upload', [UserSubmissionController::class, 'upload'])->name('upload');
    Route::get('/scoring', [ScoringController::class, 'userIndex'])->name('scoring');
});

Route::get('/guest/scoring', [ScoringController::class, 'guestIndex'])->name('guest.scoring');

require __DIR__.'/auth.php';

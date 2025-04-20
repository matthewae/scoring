<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $pendingScores = Submission::where('status', 'pending')
            ->with(['user', 'files'])
            ->latest()
            ->get();

        return view('user.home', [
            'pendingScores' => $pendingScores,
        ]);
    }
}
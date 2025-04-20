<?php

namespace App\Http\Controllers;

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
        return view('guest.home');
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
}
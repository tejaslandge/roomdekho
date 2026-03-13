<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVerification;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserVerificationController extends Controller
{
    public function index()
    {
        $verifications = auth()->user()->verifications()->latest()->get();
        return view('common.verifications.index', compact('verifications'));
    }

    public function create()
    {
        return view('common.verifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_type' => 'required|in:aadhaar,pan,driving_license',
            'id_number' => 'required|string|max:100',
            'id_image' => 'required|image|max:2048',
        ]);

        $path = $request->file('id_image')->store('verifications', 'public');

        auth()->user()->verifications()->create([
            'id_type' => $validated['id_type'],
            'id_number' => $validated['id_number'],
            'id_image' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('verifications.index')->with('success', 'Verification document submitted successfully. Please wait for admin approval.');
    }

    // Admin Methods
    public function adminIndex()
    {
        $verifications = UserVerification::with('user')->where('status', 'pending')->latest()->paginate(15);
        return view('admin.verifications.index', compact('verifications'));
    }

    public function approve(UserVerification $verification)
    {
        $verification->update(['status' => 'approved']);
        
        $user = $verification->user;
        if ($user->isVerified()) {
            $user->status = 'active';
            $user->save();
            return back()->with('success', 'Verification approved. User has been activated successfully.');
        }

        return back()->with('success', 'Verification approved. User still needs additional documents to become active.');
    }

    public function reject(Request $request, UserVerification $verification)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $verification->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);
        
        // Ensure user is inactive if they no longer meet verification requirements
        if (!$verification->user->isVerified()) {
            $verification->user->update(['status' => 'inactive']);
        }

        return back()->with('success', 'Verification rejected with reason.');
    }
}

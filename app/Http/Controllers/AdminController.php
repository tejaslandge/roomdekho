<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_properties' => \App\Models\Property::count(),
            'active_rooms' => \App\Models\Room::where('available', true)->count(),
            'pending_bookings' => \App\Models\Booking::where('status', 'pending')->count(),
            'total_revenue' => '₹' . number_format(\App\Models\Booking::where('status', 'active')->sum('amount') ?? 0, 0), // Assuming amount exists or using placeholder for now
        ];

        $recent_bookings = \App\Models\Booking::with(['room.property', 'tenant'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }

    public function users()
    {
        $users = \App\Models\User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function properties()
    {
        $properties = \App\Models\Property::with('owner')->withCount('rooms')->latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function rooms()
    {
        $rooms = \App\Models\Room::with('property.owner')->latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }
    public function payments()
    {
        $transactions = \App\Models\Booking::with(['tenant', 'room.property.owner'])
            ->latest()
            ->paginate(15);
        return view('admin.payments.index', compact('transactions'));
    }
    public function maintenance()
    {
        $requests = \App\Models\MaintenanceRequest::with(['room.property', 'tenant'])->latest()->paginate(15);
        return view('admin.maintenance.index', compact('requests'));
    }
    public function reports()
    {
        $revenueData = \App\Models\Booking::where('status', 'active')
            ->selectRaw('DATE_FORMAT(created_at, "%M") as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();

        $occupancyStat = [
            'total_rooms' => \App\Models\Room::count(),
            'occupied_rooms' => \App\Models\Booking::where('status', 'active')->count(),
        ];

        return view('admin.reports', compact('revenueData', 'occupancyStat'));
    }
    public function messages()
    {
        $conversations = \App\Models\Conversation::with(['owner', 'tenant'])->latest()->paginate(15);
        return view('admin.messages.index', compact('conversations'));
    }

    public function agreements()
    {
        $agreements = \App\Models\Agreement::with(['owner', 'tenant', 'booking.room.property'])->latest()->paginate(15);
        return view('admin.agreements.index', compact('agreements'));
    }

    public function editUser(\App\Models\User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function showUser(\App\Models\User $user)
    {
        $user->load(['properties', 'bookings.room.property', 'verifications']);
        return view('admin.users.show', compact('user'));
    }

    public function updateUser(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,owner,tenant',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroyUser(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    public function profile() { return view('profile.edit', ['user' => auth()->user()]); }
    public function settings() { return view('admin.settings'); }
}

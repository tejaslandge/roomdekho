<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenantId = auth()->id();
        $stats = [
            'current_booking' => \App\Models\Booking::where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->with('room')
                ->first()?->room?->room_type ?? 'None',
            'pending_requests' => \App\Models\Booking::where('tenant_id', $tenantId)
                ->where('status', 'pending')
                ->count(),
            'favourite_rooms' => \App\Models\User::find($tenantId)->favourites()->count(),
            'payment_history' => '₹' . number_format(\App\Models\Booking::where('tenant_id', $tenantId)
                ->where('status', '=', 'active')
                ->sum('amount') ?? 0, 0),
        ];

        $recommended_rooms = \App\Models\Room::where('available', true)
            ->with('property')
            ->latest()
            ->take(2)
            ->get();
        
        $recent_messages = \App\Models\Conversation::where('tenant_id', $tenantId)
            ->with('owner')
            ->latest()
            ->take(3)
            ->get();

        return view('tenant.dashboard', compact('stats', 'recommended_rooms', 'recent_messages'));
    }

    public function favourites()
    {
        $favourites = auth()->user()->favourites()->with('room.property')->latest()->paginate(9);
        return view('tenant.favourites.index', compact('favourites'));
    }

    public function toggleFavourite(\App\Models\Room $room)
    {
        $favourite = auth()->user()->favourites()->where('room_id', $room->id)->first();

        if ($favourite) {
            $favourite->delete();
            $status = 'removed';
        } else {
            auth()->user()->favourites()->create(['room_id' => $room->id]);
            $status = 'added';
        }

        if (request()->ajax()) {
            return response()->json(['status' => $status]);
        }

        return back()->with('success', 'Room ' . $status . ' from favourites!');
    }

    public function messages() { return view('chat-placeholder'); }
    public function rent()
    {
        $tenantId = auth()->id();
        $active_bookings = \App\Models\Booking::where('tenant_id', $tenantId)
            ->where('status', 'active')
            ->with(['room.property', 'payment'])
            ->latest()
            ->get();

        return view('tenant.rent.index', compact('active_bookings'));
    }
    public function maintenance() { return view('maintenance-placeholder'); }
    public function profile() { return view('profile.edit', ['user' => auth()->user()]); }
}

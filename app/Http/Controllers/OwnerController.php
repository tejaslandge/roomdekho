<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;



class OwnerController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();
        $stats = [
            'total_properties' => \App\Models\Property::where('owner_id', $ownerId)->count(),
            'total_rooms' => \App\Models\Room::whereHas('property', function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            })->count(),
            'active_bookings' => \App\Models\Booking::where('status', 'active')
                ->whereHas('room.property', function ($q) use ($ownerId) {
                    $q->where('owner_id', $ownerId);
                })->count(),
            'monthly_earnings' => '₹' . number_format(\App\Models\Booking::where('status', 'active')
                ->whereHas('room.property', function ($q) use ($ownerId) {
                    $q->where('owner_id', $ownerId);
                })->sum('amount') ?? 0, 0),
        ];

        $properties = auth()->user()->properties()->withCount('rooms')->latest()->take(3)->get();

        return view('owner.dashboard', compact('stats', 'properties'));
    }

    public function show(Room $room)
    {
        // security: owner can only view their own room
        abort_if($room->property->owner_id !== auth()->id(), 403);

        $room->load(['property', 'images', 'amenities']);

        return view('owner.rooms.show', compact('room'));
    }

    public function payments()
    {
        $ownerId = auth()->id();
        $transactions = \App\Models\Booking::whereHas('room.property', function ($q) use ($ownerId) {
            $q->where('owner_id', $ownerId);
        })->with(['tenant', 'room.property'])->latest()->get();
        return view('owner.payments.index', compact('transactions'));
    }

    public function messages()
    {
        $ownerId = auth()->id();
        $conversations = \App\Models\Conversation::where('owner_id', $ownerId)
            ->with(['tenant'])
            ->latest()
            ->get();
        return view('owner.messages.index', compact('conversations'));
    }

    public function maintenance()
    {
        $ownerId = auth()->id();
        $requests = \App\Models\MaintenanceRequest::whereHas('room.property', function ($q) use ($ownerId) {
            $q->where('owner_id', $ownerId);
        })->with(['room.property', 'tenant'])->latest()->get();
        return view('owner.maintenance.index', compact('requests'));
    }
    public function agreements()
    {
        $ownerId = auth()->id();
        $agreements = \App\Models\Agreement::where('owner_id', $ownerId)
            ->with(['tenant', 'booking.room.property'])
            ->latest()
            ->get();
        return view('owner.agreements.index', compact('agreements'));
    }
    public function profile()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }
}

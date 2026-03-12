<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $bookings = match($role) {
            'admin' => \App\Models\Booking::with(['room.property', 'tenant'])->latest()->get(),
            'owner' => \App\Models\Booking::whereHas('room.property', function($q) {
                $q->where('owner_id', auth()->id());
            })->with(['room.property', 'tenant'])->latest()->get(),
            'tenant' => auth()->user()->bookings()->with('room.property')->latest()->get(),
        };

        return view($role . '.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
        ]);

        $room = \App\Models\Room::findOrFail($validated['room_id']);
        if (!$room->available) {
            return back()->with('error', 'This room is currently not available.');
        }

        auth()->user()->bookings()->create([
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
            'amount' => $room->rent,
            'status' => 'pending',
        ]);

        return redirect()->route('tenant.bookings.index')->with('success', 'Booking request sent successfully!');
    }

    public function updateStatus(Request $request, Booking $booking, $status)
    {
        // Simple authorization: owner or admin
        if (auth()->user()->role === 'owner' && $booking->room->property->owner_id !== auth()->id()) {
            abort(403);
        }
        
        if (!in_array($status, ['active', 'cancelled'])) {
            abort(400);
        }

        $booking->update(['status' => $status]);

        // If booking is accepted, make the room unavailable
        if ($status === 'active') {
            $booking->room->update(['available' => false]);
            
            // Create Agreement
            Agreement::create([
                'booking_id' => $booking->id,
                'owner_id' => $booking->room->property->owner_id,
                'tenant_id' => $booking->tenant_id,
                'start_date' => $booking->start_date,
                'end_date' => $booking->end_date, // might be null, following our fix
            ]);

            $msg = 'Booking accepted!';
        } else {
            $msg = 'Booking cancelled.';
        }

        return back()->with('success', $msg);
    }

    public function destroy(\App\Models\Booking $booking)
    {
        if ($booking->tenant_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $booking->delete();
        return back()->with('success', 'Booking removed.');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingApiController extends BaseController
{
    /**
     * List user's bookings.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $role = $request->user()->role;
        $bookings = match($role) {
            'admin' => Booking::with(['room.property', 'tenant'])->latest()->get(),
            'owner' => Booking::whereHas('room.property', function($q) use ($request) {
                $q->where('owner_id', $request->user()->id);
            })->with(['room.property', 'tenant'])->latest()->get(),
            'tenant' => $request->user()->bookings()->with('room.property')->latest()->get(),
        };

        return $this->success($bookings);
    }

    /**
     * Store a new booking request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->role !== 'tenant') {
            return $this->forbidden('Only tenants can create bookings.');
        }

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
        ]);

        $result = DB::transaction(function () use ($validated, $request) {
            $room = Room::whereKey($validated['room_id'])->lockForUpdate()->firstOrFail();

            if (! $room->available) {
                return ['error' => 'This room is currently not available.'];
            }

            $hasExistingBooking = Booking::where('room_id', $room->id)
                ->whereIn('status', ['pending', 'active'])
                ->exists();

            if ($hasExistingBooking) {
                return ['error' => 'This room already has an active or pending booking.'];
            }

            $booking = $request->user()->bookings()->create([
                'room_id' => $room->id,
                'start_date' => $validated['start_date'],
                'amount' => $room->rent,
                'status' => 'pending',
            ]);

            return ['booking' => $booking];
        });

        if (isset($result['error'])) {
            return $this->error($result['error'], 422);
        }

        return $this->success($result['booking'], 'Booking request sent successfully', 201);
    }

    /**
     * Update booking status (Owner/Admin).
     *
     * @param Request $request
     * @param Booking $booking
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Booking $booking): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:active,cancelled',
        ]);

        $status = $request->status;

        // Authorization: owner or admin
        if ($request->user()->role === 'owner' && $booking->room->property->owner_id !== $request->user()->id) {
            return $this->forbidden();
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
                // end_date might be handled later or nullable
            ]);

            return $this->success($booking, 'Booking accepted and agreement created');
        }

        return $this->success($booking, 'Booking status updated to ' . $status);
    }

    /**
     * Delete booking request.
     *
     * @param Booking $booking
     * @return JsonResponse
     */
    public function destroy(Booking $booking): JsonResponse
    {
        if ($booking->tenant_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return $this->forbidden();
        }

        $booking->delete();
        return $this->success(null, 'Booking removed');
    }
}

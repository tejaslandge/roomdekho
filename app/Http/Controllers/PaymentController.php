<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::whereHas('booking', function($q) {
            $q->where('tenant_id', auth()->id());
        })->latest()->paginate(10);

        return view('tenant.payments.index', compact('payments'));
    }

    public function pay(Booking $booking)
    {
        if ($booking->tenant_id !== auth()->id() || $booking->status !== 'active') {
            abort(403);
        }

        if ($booking->payment()->where('payment_status', 'completed')->exists()) {
            return redirect()->route('tenant.rent.index')->with('info', 'This booking is already paid.');
        }

        return view('tenant.payments.pay', compact('booking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:upi,card,cash',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);
        
        // Initial Payment: Security Deposit + 1st Month Rent
        $totalAmount = $booking->amount * 2;
        
        // Mock payment processing
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $totalAmount,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'completed',
            'transaction_id' => $validated['payment_method'] === 'cash' ? 'OFFLINE_' . strtoupper(uniqid()) : 'TXN' . strtoupper(uniqid()),
            'paid_at' => now(),
        ]);

        return redirect()->route('tenant.rent.index')->with('success', 'Payment successful! Your tenancy is now fully active.');
    }
}

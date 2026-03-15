<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PaymentApiController extends BaseController
{
    /**
     * List user's payments.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $payments = Payment::whereHas('booking', function($q) use ($request) {
            $q->where('tenant_id', $request->user()->id);
        })->latest()->get();

        return $this->success($payments);
    }

    /**
     * Process/Store payment.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:upi,card,cash,razorpay',
            'transaction_id' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);
        
        if ($booking->tenant_id !== $request->user()->id) {
            return $this->forbidden();
        }

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'completed',
            'transaction_id' => $validated['transaction_id'],
            'paid_at' => now(),
        ]);

        return $this->success($payment, 'Payment recorded successfully');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentHistory extends Model
{
    protected $fillable = [
        'tenant_id',
        'room_id',
        'booking_id',
        'amount',
        'payment_method',
        'paid_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

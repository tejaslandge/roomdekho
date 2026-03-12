<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'tenant_id',
        'start_date',
        'end_date',
        'amount',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function agreement()
    {
        return $this->hasOne(Agreement::class);
    }

    public function rentHistories()
    {
        return $this->hasMany(RentHistory::class);
    }
}

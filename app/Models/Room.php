<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'property_id',
        'room_type',
        'rent',
        'available',
        'temporary_allowed',
        'min_days',
        'max_days',
        'electricity_type',
        'water_source',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenities');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    public function rentHistories()
    {
        return $this->hasMany(RentHistory::class);
    }
}

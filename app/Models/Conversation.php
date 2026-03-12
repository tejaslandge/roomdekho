<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'room_id',
        'owner_id',
        'tenant_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $fillable = [
        'user_id',
        'id_type',
        'id_number',
        'id_image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

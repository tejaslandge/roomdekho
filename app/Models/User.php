<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'profile_photo',
        'status',
        'otp',
        'otp_expires_at',
    ];

    public function isVerified(): bool
    {
        // Check for approved Aadhaar
        $hasAadhar = $this->verifications()
            ->where('id_type', 'aadhaar')
            ->where('status', 'approved')
            ->exists();
            
        // Check for approved PAN or Driving License
        $hasPanOrDL = $this->verifications()
            ->whereIn('id_type', ['pan', 'driving_license'])
            ->where('status', 'approved')
            ->exists();

        return $hasAadhar && $hasPanOrDL;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
        ];
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tenant_id');
    }

    public function verifications()
    {
        return $this->hasMany(UserVerification::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class, 'tenant_id');
    }

    public function agreements()
    {
        return $this->hasMany(Agreement::class, 'tenant_id');
    }
}

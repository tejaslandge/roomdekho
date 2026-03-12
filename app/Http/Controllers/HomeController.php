<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $featuredRooms = Room::with('property')
            ->where('available', true)
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'total_rooms' => Room::count(),
            'active_bookings' => Booking::where('status', 'active')->count(),
            'satisfied_tenants' => User::where('role', 'tenant')->count(),
        ];

        return view('welcome', compact('featuredRooms', 'stats'));
    }
}

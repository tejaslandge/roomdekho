<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoomApiController extends BaseController
{
    /**
     * Search rooms with filters.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = Room::with(['property.owner', 'images', 'amenities'])
            ->where('available', true);

        // Search by keyword (title, city, area)
        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('room_type', 'like', "%$search%")
                  ->orWhereHas('property', function ($pq) use ($search) {
                        $pq->where('city', 'like', "%$search%")
                           ->orWhere('area', 'like', "%$search%")
                           ->orWhere('title', 'like', "%$search%");
                  });
            });
        }

        // Filter by city
        if ($request->has('city')) {
            $query->whereHas('property', function ($q) use ($request) {
                $q->where('city', $request->city);
            });
        }

        // Filter by rent range
        if ($request->has('min_rent')) {
            $query->where('rent', '>=', $request->min_rent);
        }
        if ($request->has('max_rent')) {
            $query->where('rent', '<=', $request->max_rent);
        }

        // Filter by room type
        if ($request->has('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        $rooms = $query->latest()->paginate($request->get('per_page', 10));

        return $this->success($rooms);
    }

    /**
     * Get room details.
     *
     * @param Room $room
     * @return JsonResponse
     */
    public function show(Room $room): JsonResponse
    {
        $room->load(['property.owner', 'images', 'amenities']);
        
        return $this->success($room);
    }
}

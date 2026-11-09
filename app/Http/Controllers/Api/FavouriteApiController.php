<?php

namespace App\Http\Controllers\Api;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FavouriteApiController extends BaseController
{
    /**
     * List the authenticated tenant's favourite rooms.
     */
    public function index(Request $request): JsonResponse
    {
        $favourites = $request->user()->favourites()
            ->with('room.property', 'room.images')
            ->latest()
            ->get();

        return $this->success($favourites);
    }

    /**
     * Toggle favourite status for a room.
     */
    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
        ]);

        $favourite = Favourite::where('user_id', $request->user()->id)
            ->where('room_id', $validated['room_id'])
            ->first();

        if ($favourite) {
            $favourite->delete();

            return $this->success(null, 'Room removed from favourites');
        }

        $favourite = Favourite::create([
            'user_id' => $request->user()->id,
            'room_id' => $validated['room_id'],
        ]);

        return $this->success($favourite, 'Room added to favourites', 201);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Favourite;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FavouriteApiController extends BaseController
{
    /**
     * List user's favourite properties.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $favourites = $request->user()->favourites()->with('property.images')->latest()->get();

        return $this->success($favourites);
    }

    /**
     * Toggle favourite status for a property.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
        ]);

        $favourite = Favourite::where('user_id', '=', $request->user()->id)
            ->where('property_id', '=', $validated['property_id'])
            ->first();

        if ($favourite) {
            $favourite->delete();
            return $this->success(null, 'Property removed from favourites');
        }

        $favourite = Favourite::create([
            'user_id' => $request->user()->id,
            'property_id' => $validated['property_id'],
        ]);

        return $this->success($favourite, 'Property added to favourites', 201);
    }
}

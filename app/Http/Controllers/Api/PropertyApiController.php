<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PropertyApiController extends BaseController
{
    /**
     * List user's properties (Owners) or all (for reference).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->user() && $request->user()->role === 'owner') {
            $properties = $request->user()->properties()->withCount('rooms')->latest()->get();
            return $this->success($properties);
        }

        $properties = Property::withCount('rooms')->latest()->paginate(10);
        return $this->success($properties);
    }

    /**
     * Store a new property.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->role !== 'owner' && $request->user()->role !== 'admin') {
            return $this->forbidden('Only owners can create properties.');
        }

        if ($request->user()->status !== 'active' && $request->user()->role !== 'admin') {
            return $this->error('Your account must be active to list properties.', 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:150',
            'area' => 'required|string|max:150',
            'address' => 'required|string',
            'description' => 'required|string',
        ]);

        $property = $request->user()->properties()->create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return $this->success($property->load('images'), 'Property created successfully', 201);
    }

    /**
     * Get property details.
     *
     * @param Property $property
     * @return JsonResponse
     */
    public function show(Property $property): JsonResponse
    {
        $property->load(['rooms', 'images']);
        return $this->success($property);
    }

    /**
     * Update property.
     *
     * @param Request $request
     * @param Property $property
     * @return JsonResponse
     */
    public function update(Request $request, Property $property): JsonResponse
    {
        if ($property->owner_id !== $request->user()->id && $request->user()->role !== 'admin') {
            return $this->forbidden();
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:150',
            'area' => 'sometimes|required|string|max:150',
            'address' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        $property->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return $this->success($property->load('images'), 'Property updated successfully');
    }

    /**
     * Delete property.
     *
     * @param Property $property
     * @return JsonResponse
     */
    public function destroy(Property $property): JsonResponse
    {
        if ($property->owner_id !== auth('sanctum')->id() && auth('sanctum')->user()?->role !== 'admin') {
            return $this->forbidden();
        }

        $property->delete();

        return $this->success(null, 'Property deleted successfully');
    }
}

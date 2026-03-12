<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $rooms = \App\Models\Room::with('property.owner')->latest()->paginate(10);
            return view('admin.rooms.index', compact('rooms'));
        }
        
        // For owner, show rooms belonging to their properties
        if (auth()->user()->role === 'owner') {
            $rooms = \App\Models\Room::whereHas('property', function($query) {
                $query->where('owner_id', auth()->id());
            })->with('property')->latest()->paginate(10);
            return view('owner.rooms.index', compact('rooms'));
        }
        
        return abort(403);
    }

    public function create()
    {
        $properties = auth()->user()->properties;
        return view('owner.rooms.create', compact('properties'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'property_id' => 'required|exists:properties,id',
                'room_type' => 'required|string|max:100',
                'rent' => 'required|numeric|min:0',
                'electricity_type' => 'required|string|max:100',
                'water_source' => 'required|string|max:100',
                'description' => 'required|string',
            ]);

            $property = \App\Models\Property::findOrFail($validated['property_id']);
            if ($property->owner_id !== auth()->id() && auth()->user()->role !== 'admin') {
                abort(403);
            }

            $validated['available'] = $request->has('available');
            
            $room = \App\Models\Room::create($validated);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('rooms', 'public');
                    $room->images()->create(['image_path' => $path]);
                }
            }

            return redirect()->route('owner.rooms.index')->with('success', 'Room added successfully!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Room Creation Failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to add room: ' . $e->getMessage());
        }
    }

    public function edit(\App\Models\Room $room)
    {
        $this->authorizeOwner($room);
        $properties = auth()->user()->properties;
        return view('owner.rooms.edit', compact('room', 'properties'));
    }

    public function update(Request $request, \App\Models\Room $room)
    {
        $this->authorizeOwner($room);

        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'room_type' => 'required|string|max:100',
            'rent' => 'required|numeric|min:0',
            'electricity_type' => 'required|string|max:100',
            'water_source' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        $property = \App\Models\Property::findOrFail($validated['property_id']);
        if ($property->owner_id !== auth()->id()) {
            abort(403);
        }

        $validated['available'] = $request->has('available');
        $room->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');
                $room->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('owner.rooms.index')->with('success', 'Room updated successfully!');
    }

    public function destroy(\App\Models\Room $room)
    {
        $this->authorizeOwner($room);
        $room->delete();

        return redirect()->route('owner.rooms.index')->with('success', 'Room deleted successfully!');
    }

    protected function authorizeOwner(\App\Models\Room $room)
    {
        if (auth()->user()->role === 'admin') {
            return;
        }

        if ($room->property->owner_id !== auth()->id()) {
            abort(403);
        }
    }

    public function search(Request $request)
    {
        $query = \App\Models\Room::with('property')->where('available', true);

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('room_type', 'like', "%$search%")
                  ->orWhereHas('property', function($pq) use ($search) {
                      $pq->where('city', 'like', "%$search%")
                         ->orWhere('area', 'like', "%$search%")
                         ->orWhere('title', 'like', "%$search%");
                  });
            });
        }

        $rooms = $query->latest()->paginate(9);

        return view('tenant.rooms.search', compact('rooms'));
    }

    public function show(\App\Models\Room $room)
    {
        $room->load(['property.owner', 'images', 'amenities']);
        
        $activeBooking = null;
        if (auth()->check()) {
            $activeBooking = auth()->user()->bookings()
                ->where('room_id', $room->id)
                ->where('status', 'active')
                ->first();
        }

        return view('tenant.rooms.show', compact('room', 'activeBooking'));
    }
}

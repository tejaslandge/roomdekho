<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Property;

class RoomController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Admin Rooms
        if ($user->role === 'admin') {
            $rooms = Room::with('property.owner')->latest()->paginate(10);
            return view('admin.rooms.index', compact('rooms'));
        }

        // Owner Rooms
        if ($user->role === 'owner') {
            $rooms = Room::whereHas('property', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->with('property')
            ->latest()
            ->paginate(10);

            return view('owner.rooms.index', compact('rooms'));
        }

        abort(403);
    }


    public function create()
    {
        if (Auth::user()->status !== 'active') {
            return redirect()->route('owner.rooms.index')->with('error', 'Mandatory verification required (Aadhar + PAN/DL) to list rooms.');
        }
        $properties = Auth::user()->properties;

        return view('owner.rooms.create', compact('properties'));
    }


    public function store(Request $request)
    {
        if (Auth::user()->status !== 'active') {
            return redirect()->route('owner.rooms.index')->with('error', 'Mandatory verification required (Aadhar + PAN/DL) to list rooms.');
        }
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'room_type' => 'required|string|max:100',
            'rent' => 'required|numeric|min:0',
            'electricity_type' => 'required|string|max:100',
            'water_source' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        $property = Property::findOrFail($validated['property_id']);

        if ($property->owner_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated['available'] = $request->has('available');

        $room = Room::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('rooms', 'public');

                $room->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('owner.rooms.index')
            ->with('success', 'Room added successfully!');
    }


    public function edit(Room $room)
    {
        $this->authorizeOwner($room);

        $properties = Auth::user()->properties;

        return view('owner.rooms.edit', compact('room', 'properties'));
    }


    public function update(Request $request, Room $room)
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

        $property = Property::findOrFail($validated['property_id']);

        if ($property->owner_id !== Auth::id()) {
            abort(403);
        }

        $validated['available'] = $request->has('available');

        $room->update($validated);


        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('rooms', 'public');

                $room->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('owner.rooms.index')
            ->with('success', 'Room updated successfully!');
    }


    public function destroy(Room $room)
    {
        $this->authorizeOwner($room);

        $room->delete();

        return redirect()->route('owner.rooms.index')
            ->with('success', 'Room deleted successfully!');
    }


    protected function authorizeOwner(Room $room)
    {
        if (Auth::user()->role === 'admin') {
            return;
        }

        if ($room->property->owner_id !== Auth::id()) {
            abort(403);
        }
    }


    public function search(Request $request)
    {
        $query = Room::with('property')
            ->where('available', true);

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

        $rooms = $query->latest()->paginate(9);

        return view('tenant.rooms.search', compact('rooms'));
    }


    public function show(Room $room)
    {
        $room->load([
            'property.owner',
            'images',
            'amenities'
        ]);

        $user = Auth::user();


        // Tenant View
        if ($user && $user->role === 'tenant') {

            $activeBooking = $user->bookings()
                ->where('room_id', $room->id)
                ->where('status', 'active')
                ->first();

            return view('tenant.rooms.show', compact(
                'room',
                'activeBooking'
            ));
        }


        // Owner View
        if ($user && $user->role === 'owner') {

            if ($room->property->owner_id !== $user->id) {
                abort(403);
            }

            return view('owner.rooms.show', compact('room'));
        }


        // Admin View
        // if ($user && $user->role === 'admin') {

        //     return view('admin.rooms.show', compact('room'));
        // }

        abort(403);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $properties = \App\Models\Property::with('owner')->withCount('rooms')->latest()->paginate(10);
            return view('admin.properties.index', compact('properties'));
        }
        
        $properties = auth()->user()->properties()->withCount('rooms')->latest()->paginate(10);
        return view('owner.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('owner.properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:150',
            'area' => 'required|string|max:150',
            'address' => 'required|string',
            'description' => 'required|string',
        ]);

        auth()->user()->properties()->create($validated);

        return redirect()->route('owner.properties.index')->with('success', 'Property created successfully!');
    }

    public function edit(\App\Models\Property $property)
    {
        $this->authorizeOwner($property);
        return view('owner.properties.edit', compact('property'));
    }

    public function update(Request $request, \App\Models\Property $property)
    {
        $this->authorizeOwner($property);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:150',
            'area' => 'required|string|max:150',
            'address' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $property->update($validated);

        return redirect()->route('owner.properties.index')->with('success', 'Property updated successfully!');
    }

    public function destroy(\App\Models\Property $property)
    {
        $this->authorizeOwner($property);
        $property->delete();

        return redirect()->route('owner.properties.index')->with('success', 'Property deleted successfully!');
    }

    protected function authorizeOwner(\App\Models\Property $property)
    {
        if (auth()->user()->role === 'admin') {
            return;
        }
        
        if ($property->owner_id !== auth()->id()) {
            abort(403);
        }
    }
}

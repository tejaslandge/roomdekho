@extends('layouts.dashboard')

@section('title', $property->title)

@section('content')

<div class="max-w-6xl mx-auto space-y-8">


<!-- Header -->
<div class="flex justify-between items-center">

    <div>
        <h1 class="text-2xl font-bold text-text-primary">
            {{ $property->title }}
        </h1>

        <p class="text-text-secondary text-sm">
            {{ $property->city }}, {{ $property->area }}
        </p>
    </div>

    <div class="flex items-center gap-3">

        <a href="{{ route('owner.properties.edit',$property) }}"
           class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary/90 transition">
           Edit Property
        </a>

        <a href="{{ route('owner.properties.index') }}"
           class="text-primary font-bold text-sm">
           ← Back
        </a>

    </div>

</div>


<!-- Property Images -->
<div class="bg-white rounded-3xl border border-gray-100 p-6">

    <h2 class="text-lg font-bold mb-4">
        Property Images
    </h2>

    <div class="grid grid-cols-4 gap-4">

        @forelse($property->images as $image)

            <img
                src="{{ asset('storage/'.$image->image_path) }}"
                class="rounded-xl h-40 w-full object-cover hover:scale-105 transition">

        @empty

            <p class="text-text-secondary text-sm">
                No images uploaded
            </p>

        @endforelse

    </div>

</div>


<!-- Property Details -->
<div class="bg-white rounded-3xl border border-gray-100 p-6 space-y-4">

    <h2 class="text-lg font-bold">
        Property Details
    </h2>

    <p class="text-text-secondary">
        {{ $property->description }}
    </p>

    <div class="grid grid-cols-3 gap-6 pt-4">

        <div>
            <p class="text-xs text-text-secondary">
                City
            </p>

            <p class="font-bold">
                {{ $property->city }}
            </p>
        </div>

        <div>
            <p class="text-xs text-text-secondary">
                Area
            </p>

            <p class="font-bold">
                {{ $property->area }}
            </p>
        </div>

        <div>
            <p class="text-xs text-text-secondary">
                Address
            </p>

            <p class="font-bold">
                {{ $property->address }}
            </p>
        </div>

    </div>

</div>


<!-- Rooms -->
<div class="bg-white rounded-3xl border border-gray-100 p-6">

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-lg font-bold">
            Rooms ({{ $property->rooms->count() }})
        </h2>

        <a href="{{ route('owner.rooms.create', ['property_id'=>$property->id]) }}"
           class="text-primary text-sm font-bold hover:underline">
           Add Room
        </a>

    </div>


    <div class="grid grid-cols-3 gap-6">

        @forelse($property->rooms as $room)

        <!-- Clickable Room Card -->
        <a href="{{ route('owner.rooms.show', $room) }}"
           class="border rounded-xl p-4 block hover:shadow-lg hover:border-primary transition-all">

            <p class="font-bold text-text-primary">
                {{ $room->room_type }}
            </p>

            <p class="text-sm text-text-secondary">
                ₹{{ number_format($room->rent) }}
            </p>

            <p class="text-xs text-text-secondary mt-2">
                {{ $room->electricity_type }} Electricity
            </p>

            <p class="text-xs text-text-secondary">
                {{ $room->water_source }} Water
            </p>

            <div class="mt-3 text-xs font-bold
                {{ $room->available ? 'text-green-600' : 'text-red-500' }}">

                {{ $room->available ? 'Available' : 'Occupied' }}

            </div>

        </a>

        @empty

        <div class="col-span-3 text-center text-text-secondary py-6">

            <p>No rooms added yet.</p>

            <a href="{{ route('owner.rooms.create', ['property_id'=>$property->id]) }}"
               class="text-primary font-bold text-sm hover:underline">
               Add your first room
            </a>

        </div>

        @endforelse

    </div>

</div>

</div>

@endsection

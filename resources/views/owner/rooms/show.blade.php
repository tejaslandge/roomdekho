@extends('layouts.dashboard')

@section('title', 'Room Details')

@section('content')

    <div class="max-w-5xl mx-auto space-y-8">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Room Details</h1>

            <a href="{{ route('owner.rooms.index') }}" class="text-sm text-primary font-bold">
                ← Back
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 p-8 space-y-6">

            <div>
                <h2 class="text-xl font-bold">{{ $room->room_type }}</h2>
                <p class="text-text-secondary">
                    {{ $room->property->title }}
                </p>
            </div>

            <div class="grid grid-cols-3 gap-6">

                <div>
                    <p class="text-xs text-text-secondary">Rent</p>
                    <p class="font-bold text-primary">
                        ₹{{ number_format($room->rent) }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-text-secondary">Electricity</p>
                    <p class="font-bold">
                        {{ $room->electricity_type }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-text-secondary">Water</p>
                    <p class="font-bold">
                        {{ $room->water_source }}
                    </p>
                </div>

            </div>

            <div>
                <p class="text-sm font-bold mb-2">Description</p>
                <p class="text-text-secondary">
                    {{ $room->description }}
                </p>
            </div>

            <div>
                <p class="text-sm font-bold mb-3">Images</p>

                <div class="grid grid-cols-4 gap-4">
                    @foreach ($room->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="rounded-xl h-32 w-full object-cover">
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 pt-6">

                <a href="{{ route('owner.rooms.edit', $room) }}"
                    class="bg-primary text-white px-6 py-3 rounded-xl text-sm font-bold">
                    Edit Room
                </a>

                <button onclick="openDeleteModal()" class="bg-red-500 text-white px-6 py-3 rounded-xl text-sm font-bold">
                    Delete Room
                </button>

            </div>

        </div>

    </div>
    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">

        <div class="bg-white rounded-2xl p-6 w-[400px] space-y-4">

            <h2 class="text-lg font-bold text-red-600">
                Delete Room
            </h2>

            <p class="text-sm text-gray-600">
                Are you sure you want to delete this room?
                This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3 pt-4">

                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-bold">
                    Cancel
                </button>

                <form action="{{ route('owner.rooms.destroy', $room) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-bold">
                        Yes Delete
                    </button>
                </form>

            </div>

        </div>

    </div>
    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection

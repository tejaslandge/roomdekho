@extends('layouts.dashboard')

@section('title', 'Manage Rooms')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-text-primary">Rooms Management</h1>
            <a href="{{ route('owner.rooms.create') }}"
                class="bg-primary text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-primary/90 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Add Room
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-4">Room Detail</th>
                            <th class="px-6 py-4">Property</th>
                            <th class="px-6 py-4">Rent</th>
                            <th class="px-6 py-4">Availability</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($rooms as $room)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm font-bold text-text-primary capitalize">{{ $room->room_type }}</p>
                                        <p class="text-xs text-text-secondary">{{ $room->electricity_type }} Elect. |
                                            {{ $room->water_source }} Water</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-text-secondary">
                                    {{ $room->property->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-primary">₹{{ number_format($room->rent, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <x-status-badge :status="$room->available ? 'active' : 'inactive'" />
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('owner.rooms.show', $room) }}"
                                            class="text-text-secondary hover:text-primary transition-colors">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                                    s8.268 2.943 9.542 7c-1.274
                                                                    4.057-5.065 7-9.542 7
                                                                    s-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('owner.rooms.edit', $room) }}"
                                            class="text-text-secondary hover:text-primary transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <button onclick="openDeleteModal({{ $room->id }})"
                                            class="text-text-secondary hover:text-red-500 transition-colors">

                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                       a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                       m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>

                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-text-secondary">No rooms listed yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <form id="deleteRoomForm" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            @if ($rooms->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 text-right">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>
    <div id="deleteModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 w-[400px]">

        <h2 class="text-lg font-bold text-red-600 mb-2">
            Delete Room
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            Are you sure you want to delete this room?
            This action cannot be undone.
        </p>

        <div class="flex justify-end gap-3">

            <button onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-bold">
                Cancel
            </button>

            <button onclick="confirmDelete()"
                class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-bold">
                Delete
            </button>

        </div>

    </div>

</div>
<script>

let deleteRoomId = null;

function openDeleteModal(roomId)
{
    deleteRoomId = roomId;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal()
{
    document.getElementById('deleteModal').classList.add('hidden');
}

function confirmDelete()
{
    const form = document.getElementById('deleteRoomForm');

    form.action = "/owner/rooms/" + deleteRoomId;

    form.submit();
}

</script>
@endsection

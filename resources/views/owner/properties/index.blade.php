@extends('layouts.dashboard')

@section('title', 'My Properties')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-text-primary">Properties Management</h1>
            <a href="{{ route('owner.properties.create') }}"
                class="bg-primary text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-primary/90 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Add Property
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-4">Property</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Total Rooms</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($properties as $property)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden">
                                            <img src="https://via.placeholder.com/100" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-text-primary underline">{{ $property->title }}
                                            </p>
                                            <p class="text-xs text-text-secondary truncate max-w-xs">
                                                {{ $property->description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-text-secondary">{{ $property->city }},
                                        {{ $property->area }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-text-primary">{{ $property->rooms->count() }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <x-status-badge :status="$property->status" />
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('owner.properties.show', $property) }}"
                                            class="text-text-secondary hover:text-primary transition-colors">

                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5
                12 5s8.268 2.943 9.542 7
                c-1.274 4.057-5.065 7
                -9.542 7s-8.268-2.943
                -9.542-7z" />

                                            </svg>

                                        </a>
                                        <a href="{{ route('owner.properties.edit', $property) }}"
                                            class="text-text-secondary hover:text-primary transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('owner.properties.destroy', $property) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-text-secondary hover:text-red-500 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <p class="text-text-secondary">No properties found.</p>
                                        <a href="{{ route('owner.properties.create') }}"
                                            class="text-primary font-bold text-sm mt-2 hover:underline">Add your first
                                            property</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($properties->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 text-right">
                    {{ $properties->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

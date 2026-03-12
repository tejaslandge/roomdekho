@extends('layouts.dashboard')

@section('title', 'Maintenance Requests')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-text-primary">Global Maintenance Requests</h1>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Property</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Created At</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-text-primary">{{ $request->title }}</p>
                            <p class="text-xs text-text-secondary truncate max-w-xs">{{ $request->description }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $request->tenant->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $request->room->property->title }} ({{ $request->room->room_type }})
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$request->status" />
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                             <button class="text-primary hover:underline text-sm font-bold">Manage</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-text-secondary">No maintenance requests found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 text-right">
            {{ $requests->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

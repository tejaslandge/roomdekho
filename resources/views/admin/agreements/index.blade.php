@extends('layouts.dashboard')

@section('title', 'System Agreements')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-text-primary">All Rental Agreements</h1>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Tenant</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Property</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Validity</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($agreements as $agreement)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-text-primary">{{ $agreement->tenant->name }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-secondary">{{ $agreement->owner->name }}</td>
                            <td class="px-6 py-4 text-sm text-text-secondary">{{ $agreement->booking->room->property->title }}</td>
                            <td class="px-6 py-4 text-sm text-text-secondary">
                                {{ $agreement->start_date->format('M d, Y') }} - {{ $agreement->end_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="text-primary font-bold text-xs hover:underline">View PDF</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-text-secondary text-sm italic">No agreements found in the system.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($agreements->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 text-right">
            {{ $agreements->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

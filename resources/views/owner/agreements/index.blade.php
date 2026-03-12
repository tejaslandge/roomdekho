@extends('layouts.dashboard')

@section('title', 'Rental Agreements')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-text-primary">Contract Management</h1>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Property</th>
                        <th class="px-6 py-4">Start Date</th>
                        <th class="px-6 py-4">End Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($agreements as $agreement)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-text-primary capitalize">
                            {{ $agreement->tenant->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $agreement->booking->room->property->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $agreement->start_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $agreement->end_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                             <a href="#" class="text-primary hover:underline text-sm font-bold flex items-center justify-end gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                View PDF
                             </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-text-secondary">No rental agreements found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

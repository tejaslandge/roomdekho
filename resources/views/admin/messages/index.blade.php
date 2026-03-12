@extends('layouts.dashboard')

@section('title', 'System Conversations')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-text-primary">Global Messaging Oversight</h1>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Conversation Between</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Last Activity</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($conversations as $conversation)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-text-primary underline">{{ $conversation->owner->name }}</span>
                                    <span class="text-xs text-text-secondary">&</span>
                                    <span class="text-sm font-bold text-text-primary underline">{{ $conversation->tenant->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-secondary">
                                {{ $conversation->updated_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-primary font-bold text-xs hover:underline">View Chat Log</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-text-secondary text-sm italic">No conversations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($conversations->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 text-right">
            {{ $conversations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

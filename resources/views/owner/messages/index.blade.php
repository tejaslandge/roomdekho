@extends('layouts.dashboard')

@section('title', 'Messages')

@section('content')
<div class="h-[calc(100vh-12rem)] flex gap-6">
    <!-- Conversations List -->
    <div class="w-80 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-50">
            <h2 class="font-bold text-text-primary">All Chats</h2>
        </div>
        <div class="flex-1 overflow-y-auto">
            @forelse($conversations as $conversation)
                <a href="#" class="flex items-center gap-3 p-4 hover:bg-soft transition-colors border-b border-gray-50/50">
                    <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold">
                        {{ substr($conversation->tenant->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-text-primary">{{ $conversation->tenant->name }}</p>
                        <p class="text-xs text-text-secondary truncate w-40">Click to view message history...</p>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-text-secondary text-sm italic">
                    No active conversations.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Chat Window Placeholder -->
    <div class="flex-1 bg-white rounded-3xl border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center p-12">
        <div class="w-16 h-16 bg-soft rounded-full flex items-center justify-center text-primary mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-text-primary">Select a conversation</h3>
        <p class="text-sm text-text-secondary mt-2">Pick a tenant from the left to start messaging or view history.</p>
    </div>
</div>
@endsection

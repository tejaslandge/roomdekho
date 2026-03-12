@extends('layouts.dashboard')

@section('title', 'My Conversations')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Messages</h1>
        <p class="text-text-secondary text-sm font-bold">{{ $conversations->count() }} active chats</p>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($conversations as $conversation)
            @php($otherUser = auth()->user()->role === 'owner' ? $conversation->tenant : $conversation->owner)
            <a href="{{ route(auth()->user()->role . '.messages.show', $conversation) }}" class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-6 hover:shadow-xl hover:shadow-primary/5 transition-all group">
                <div class="w-16 h-16 rounded-2xl bg-primary/5 flex items-center justify-center text-primary font-black text-xl shrink-0 group-hover:scale-110 transition-transform">
                    {{ substr($otherUser->name, 0, 1) }}
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="font-black text-text-primary truncate">{{ $otherUser->name }}</h3>
                        <span class="text-[10px] font-bold text-text-secondary uppercase">{{ $conversation->updated_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-2">{{ $conversation->room->property->title }}</p>
                    <p class="text-sm text-text-secondary truncate font-medium italic">
                        @if($conversation->messages->count() > 0)
                            "{{ $conversation->messages->first()->message }}"
                        @else
                            No messages yet.
                        @endif
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-300 group-hover:bg-primary group-hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>
        @empty
            <div class="py-24 text-center space-y-4 bg-white rounded-[2rem] border border-gray-100">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <p class="text-text-secondary font-bold">No active conversations yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

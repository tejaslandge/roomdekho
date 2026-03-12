@extends('layouts.dashboard')

@section('title', 'Chat')

@section('content')
<div class="max-w-4xl mx-auto h-[calc(100vh-12rem)] flex flex-col">
    <!-- Header -->
    <div class="bg-white rounded-t-[2rem] border border-gray-100 p-6 flex items-center justify-between shadow-sm relative z-10">
        <div class="flex items-center gap-4">
            <a href="{{ route(auth()->user()->role . '.messages.index') }}" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-text-secondary hover:bg-gray-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center text-primary font-black">
                @php($otherUser = auth()->user()->role === 'owner' ? $conversation->tenant : $conversation->owner)
                {{ substr($otherUser->name, 0, 1) }}
            </div>
            <div>
                <h3 class="font-black text-text-primary">{{ $otherUser->name }}</h3>
                <p class="text-[10px] font-black text-primary uppercase tracking-widest">{{ $conversation->room->property->title }}</p>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div class="flex-1 overflow-y-auto p-8 space-y-6 bg-gray-50/30" id="message-container">
        @if($conversation->messages->count() > 0)
            @foreach($conversation->messages as $msg)
                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[80%] {{ $msg->sender_id === auth()->id() ? 'bg-primary text-white rounded-l-2xl rounded-tr-2xl' : 'bg-white text-text-primary shadow-sm border border-gray-100 rounded-r-2xl rounded-tl-2xl' }} p-4">
                        <p class="text-sm font-medium leading-relaxed">{{ $msg->message }}</p>
                        <p class="text-[9px] font-bold mt-2 uppercase opacity-60 {{ $msg->sender_id === auth()->id() ? 'text-white' : 'text-text-secondary' }}">
                            {{ $msg->created_at->format('h:i A') }}
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="h-full flex flex-col items-center justify-center opacity-30 select-none">
                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                <p class="font-black uppercase tracking-[0.2em] text-xs">No messages yet</p>
            </div>
        @endif
    </div>

    <!-- Input -->
    <div class="bg-white rounded-b-[2rem] border border-gray-100 p-6 shadow-2xl">
        <form action="{{ route(auth()->user()->role . '.messages.send', $conversation) }}" method="POST" class="flex gap-4">
            @csrf
            <input type="text" name="message" placeholder="Type your message..." required autocomplete="off"
                class="flex-1 bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-text-primary focus:ring-2 focus:ring-primary/20 transition-all">
            <button type="submit" class="w-14 h-14 rounded-2xl bg-primary text-white flex items-center justify-center shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>
    </div>
</div>

<script>
    const container = document.getElementById('message-container');
    container.scrollTop = container.scrollHeight;
</script>
@endsection

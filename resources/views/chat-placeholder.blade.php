@extends('layouts.dashboard')

@section('title', 'Messages')

@section('content')
<div class="h-[calc(100vh-12rem)] bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex">
    <!-- Contacts Sidebar -->
    <div class="w-80 border-r border-gray-100 flex flex-col">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-bold text-lg text-text-primary">Conversations</h3>
            <div class="mt-4 relative">
                <input type="text" class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20" placeholder="Search chats...">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
        <div class="flex-1 overflow-y-auto">
            <!-- Mock Contact 1 -->
            <div class="p-4 border-b border-gray-50 bg-soft/50 cursor-pointer border-l-4 border-l-primary">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary">RS</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <h4 class="font-bold text-sm text-text-primary truncate">Rahul Sharma</h4>
                            <span class="text-[10px] text-text-secondary">2m ago</span>
                        </div>
                        <p class="text-xs text-text-secondary truncate">Is the Modern Villa available for next week?</p>
                    </div>
                </div>
            </div>
            <!-- Mock Contact 2 -->
            <div class="p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-secondary/20 flex items-center justify-center font-bold text-secondary">AR</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <h4 class="font-bold text-sm text-text-primary truncate">Aditi Rao</h4>
                            <span class="text-[10px] text-text-secondary">1h ago</span>
                        </div>
                        <p class="text-xs text-text-secondary truncate">Thank you for the quick response!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chat Area -->
    <div class="flex-1 flex flex-col bg-gray-50/20">
        <!-- Chat Header -->
        <div class="p-4 bg-white border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary">RS</div>
                <div>
                    <h4 class="font-bold text-sm text-text-primary">Rahul Sharma</h4>
                    <p class="text-[10px] text-green-500 font-bold uppercase tracking-wider">Online</p>
                </div>
            </div>
            <button class="text-text-secondary hover:text-text-primary"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg></button>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            <div class="flex justify-start">
                <div class="max-w-[70%] bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100">
                    <p class="text-sm text-text-primary">Hi, I'm interested in the Modern Villa. Is it available for next Monday to Friday?</p>
                    <span class="text-[10px] text-text-secondary mt-1 block">10:45 AM</span>
                </div>
            </div>
            <div class="flex justify-end">
                <div class="max-w-[70%] bg-primary p-4 rounded-2xl rounded-tr-none shadow-sm shadow-primary/20">
                    <p class="text-sm text-white font-medium">Hello Rahul! Yes, it is currently available. Would you like to proceed with the booking?</p>
                    <span class="text-[10px] text-white/70 mt-1 block">10:48 AM</span>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="p-6 bg-white border-t border-gray-100">
            <form class="flex gap-4">
                <input type="text" class="flex-1 px-4 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20" placeholder="Type your message...">
                <button type="submit" class="bg-primary text-white p-3 rounded-xl shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                    <svg class="w-6 h-6 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

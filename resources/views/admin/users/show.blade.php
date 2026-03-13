@extends('layouts.dashboard')

@section('title', 'User Profile - ' . $user->name)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="p-2 hover:bg-gray-100 rounded-xl transition-colors">
                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-text-primary">User Details</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn-secondary px-5 py-2.5 rounded-xl text-sm font-bold border border-gray-100 hover:bg-gray-50 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Profile
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Overview -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <div class="w-24 h-24 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-3xl mx-auto mb-4 border-4 border-white shadow-xl shadow-primary/10">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h2 class="text-xl font-bold text-text-primary">{{ $user->name }}</h2>
                <p class="text-sm text-text-secondary mb-4 capitalize">Role: {{ $user->role }}</p>
                <span class="px-4 py-1.5 rounded-full text-xs font-bold {{ $user->status === 'active' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} capitalize">
                    {{ $user->status ?? 'inactive' }}
                </span>

                <div class="mt-8 pt-8 border-t border-gray-50 text-left space-y-4">
                    <div>
                        <p class="text-xs font-bold text-text-secondary uppercase tracking-wider">Email Address</p>
                        <p class="text-sm font-medium text-text-primary mt-1">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-text-secondary uppercase tracking-wider">Phone Number</p>
                        <p class="text-sm font-medium text-text-primary mt-1">{{ $user->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-text-secondary uppercase tracking-wider">Joined On</p>
                        <p class="text-sm font-medium text-text-primary mt-1">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Verification Progress
                </h3>
                <div class="space-y-4">
                    @php
                        $types = ['aadhaar' => 'Aadhaar Card', 'pan' => 'PAN Card', 'driving_license' => 'Driving License'];
                    @endphp
                    @foreach($types as $type => $label)
                        @php $doc = $user->verifications->where('id_type', $type)->first(); @endphp
                        <div class="flex items-center justify-between p-3 rounded-2xl {{ $doc && $doc->status === 'approved' ? 'bg-green-50' : 'bg-gray-50' }}">
                            <span class="text-sm font-medium text-text-primary">{{ $label }}</span>
                            @if($doc)
                                <span class="text-xs font-bold {{ $doc->status === 'approved' ? 'text-green-600' : ($doc->status === 'rejected' ? 'text-red-500' : 'text-yellow-600') }} capitalize">{{ $doc->status }}</span>
                            @else
                                <span class="text-xs font-bold text-gray-400">Not Uploaded</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Documents & Activities -->
        <div class="lg:col-span-2 space-y-6" x-data="{ rejectionModal: false, selectedDocId: null }">
            @if($user->verifications->count() > 0)
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-text-primary mb-6">Submitted Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($user->verifications as $doc)
                    <div class="border border-gray-100 rounded-3xl p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-text-secondary uppercase tracking-wider">{{ str_replace('_', ' ', $doc->id_type) }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $doc->status === 'approved' ? 'bg-green-100 text-green-600' : ($doc->status === 'rejected' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600') }}">
                                {{ $doc->status }}
                            </span>
                        </div>
                        <p class="text-sm font-bold text-text-primary">ID: {{ $doc->id_number }}</p>
                        <a href="{{ asset('storage/' . $doc->id_image) }}" target="_blank" class="block group relative overflow-hidden rounded-2xl aspect-video bg-gray-100 border border-gray-50">
                            <img src="{{ asset('storage/' . $doc->id_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="ID Image">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all">
                                <span class="text-white text-xs font-bold">View Full Image</span>
                            </div>
                        </a>
                        
                        @if($doc->status === 'pending')
                        <div class="flex gap-2 pt-2">
                            <form action="{{ route('admin.verifications.approve', $doc) }}" method="POST" class="flex-1">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full py-2 bg-green-500 text-white rounded-xl text-xs font-bold hover:bg-green-600 transition-all">Approve</button>
                            </form>
                            <button @click="rejectionModal = true; selectedDocId = {{ $doc->id }}" class="flex-1 py-2 bg-red-500 text-white rounded-xl text-xs font-bold hover:bg-red-600 transition-all">Reject</button>
                        </div>
                        @elseif($doc->status === 'rejected' && $doc->rejection_reason)
                            <div class="p-3 bg-red-50 rounded-2xl">
                                <p class="text-[10px] font-bold text-red-700 uppercase">Reason for Rejection</p>
                                <p class="text-xs text-red-600 mt-1">{{ $doc->rejection_reason }}</p>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Properties/Rooms if Owner -->
            @if($user->role === 'owner')
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-text-primary mb-6">Listings Overall</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 p-4 rounded-2xl">
                        <p class="text-xs font-bold text-text-secondary uppercase">Properties</p>
                        <p class="text-2xl font-bold text-primary">{{ $user->properties->count() }}</p>
                    </div>
                    @php $roomsCount = $user->properties->flatMap->rooms->count(); @endphp
                    <div class="bg-gray-50 p-4 rounded-2xl">
                        <p class="text-xs font-bold text-text-secondary uppercase">Total Rooms</p>
                        <p class="text-2xl font-bold text-primary">{{ $roomsCount }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Bookings if Tenant -->
            @if($user->role === 'tenant')
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-text-primary mb-6">Booking History</h3>
                @forelse($user->bookings as $booking)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl mb-3">
                        <div>
                            <p class="text-sm font-bold text-text-primary">{{ $booking->room->property->name }} - {{ $booking->room->room_number }}</p>
                            <p class="text-xs text-text-secondary">{{ $booking->start_date }} to {{ $booking->end_date ?? 'Present' }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-primary/10 text-primary">
                            {{ $booking->status }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-text-secondary text-center py-4">No bookings found for this tenant.</p>
                @endforelse
            </div>
            @endif
        </div>
    </div>

    <!-- Rejection Modal -->
    <div x-show="rejectionModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="rejectionModal = false"></div>
        <div class="bg-white rounded-3xl p-8 max-w-md w-full relative z-10 shadow-2xl border border-gray-100">
            <h3 class="text-xl font-bold text-text-primary mb-4">Reject Document</h3>
            <p class="text-sm text-text-secondary mb-6">Provide a reason for rejection. This will be shown to the user.</p>
            
            <form :action="'/admin/verifications/' + selectedDocId + '/reject'" method="POST">
                @csrf @method('PATCH')
                <div class="mb-6">
                    <label class="block text-xs font-bold text-text-secondary uppercase mb-2">Rejection Reason</label>
                    <textarea name="rejection_reason" rows="4" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="e.g. Photo is blurry, ID number mismatch..." required></textarea>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" @click="rejectionModal = false" class="flex-1 py-3 bg-gray-100 text-text-primary rounded-2xl text-sm font-bold hover:bg-gray-200 transition-all">Cancel</button>
                    <button type="submit" class="flex-1 py-3 bg-red-500 text-white rounded-2xl text-sm font-bold hover:bg-red-600 shadow-lg shadow-red-500/20 transition-all">Confirm Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

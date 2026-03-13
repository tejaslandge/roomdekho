@extends('layouts.dashboard')

@section('title', 'Admin - Document Verifications')

@section('content')
<div class="space-y-6" x-data="{ rejectionModal: false, selectedDocId: null }">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Pending Verifications</h1>
            <p class="text-text-secondary">Review submitted documents and approve to activate users.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-text-secondary">
                    <tr>
                        <th class="px-8 py-4">User</th>
                        <th class="px-8 py-4">Document Type</th>
                        <th class="px-8 py-4">ID Number</th>
                        <th class="px-8 py-4">Photo</th>
                        <th class="px-8 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($verifications as $verification)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-semibold text-text-primary">{{ $verification->user->name }}</div>
                                <div class="text-xs text-text-secondary capitalize">{{ $verification->user->role }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="uppercase">{{ str_replace('_', ' ', $verification->id_type) }}</span>
                            </td>
                            <td class="px-8 py-5 text-text-secondary">
                                {{ $verification->id_number }}
                            </td>
                            <td class="px-8 py-5">
                                <a href="{{ asset('storage/' . $verification->id_image) }}" target="_blank" class="text-primary hover:underline font-medium">View Image</a>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.verifications.approve', $verification) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg text-xs font-bold hover:bg-green-600 transition-all">Approve</button>
                                    </form>
                                    <button @click="rejectionModal = true; selectedDocId = {{ $verification->id }}" class="px-3 py-1 bg-red-500 text-white rounded-lg text-xs font-bold hover:bg-red-600 transition-all">Reject</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-text-secondary">
                                No pending verifications to review.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 border-t border-gray-50">
            {{ $verifications->links() }}
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

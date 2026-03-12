@extends('layouts.dashboard')

@section('title', 'All Agreements')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">System Agreements</h1>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">ID</th>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Property & Owner</th>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Tenant</th>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($agreements as $agreement)
                    <tr class="group hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6 text-sm font-bold text-text-secondary">
                            #{{ str_pad($agreement->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-8 py-6">
                            <div>
                                <p class="font-black text-text-primary">{{ $agreement->booking->room->property->title }}</p>
                                <p class="text-[10px] text-text-secondary font-bold uppercase">{{ $agreement->owner->name }} (Owner)</p>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-black text-text-primary">{{ $agreement->tenant->name }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.agreements.show', $agreement) }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-black text-text-primary uppercase tracking-wider hover:bg-primary hover:text-white hover:border-primary transition-all">
                                Audit View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-text-secondary font-bold">No agreements found in the system.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $agreements->links() }}
    </div>
</div>
@endsection

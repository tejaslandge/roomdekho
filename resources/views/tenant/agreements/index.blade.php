@extends('layouts.dashboard')

@section('title', 'My Agreements')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Rental Agreements</h1>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Property & Owner</th>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Start Date</th>
                    <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($agreements as $agreement)
                    <tr class="group hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary font-black uppercase">
                                    {{ substr($agreement->booking->room->property->title, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-black text-text-primary">{{ $agreement->booking->room->property->title }}</p>
                                    <p class="text-xs text-text-secondary font-bold uppercase">{{ $agreement->owner->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-sm font-black text-text-secondary">{{ \Carbon\Carbon::parse($agreement->start_date)->format('d M, Y') }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('tenant.agreements.show', $agreement) }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-black text-text-primary uppercase tracking-wider hover:bg-primary hover:text-white hover:border-primary transition-all">
                                View Agreement
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-12 text-center text-text-secondary font-bold">No agreements found.</td>
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

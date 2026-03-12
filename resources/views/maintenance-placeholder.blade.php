@extends('layouts.dashboard')

@section('title', 'Maintenance Requests')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-text-primary">Maintenance Requests</h1>
        <button class="bg-primary text-white px-6 py-2.5 rounded-xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            New Request
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-4">
            <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Pending</p>
            <p class="text-2xl font-black text-blue-900">08</p>
        </div>
        <div class="bg-yellow-50/50 border border-yellow-100 rounded-2xl p-4">
            <p class="text-xs font-bold text-yellow-600 uppercase tracking-wider mb-1">In Progress</p>
            <p class="text-2xl font-black text-yellow-900">03</p>
        </div>
        <div class="bg-green-50/50 border border-green-100 rounded-2xl p-4">
            <p class="text-xs font-bold text-green-600 uppercase tracking-wider mb-1">Resolved</p>
            <p class="text-2xl font-black text-green-900">24</p>
        </div>
        <div class="bg-red-50/50 border border-red-100 rounded-2xl p-4">
            <p class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1">Urgent</p>
            <p class="text-2xl font-black text-red-900">02</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Issue Details</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Property</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Tenant</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-text-primary">Leaking Tap in Kitchen</p>
                            <p class="text-xs text-text-secondary mt-1">Reported 2 hours ago</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Modern Villa, Bng</td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Rahul Sharma</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-[10px] font-black uppercase rounded-full">Medium</span></td>
                        <td class="px-6 py-4"><x-status-badge status="pending" /></td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-primary font-bold text-xs hover:underline">View Details</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-text-primary">Short Circuit - Hallway</p>
                            <p class="text-xs text-text-secondary mt-1">Reported 5 hours ago</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Skyline Apt</td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Aditi Rao</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-red-100 text-red-700 text-[10px] font-black uppercase rounded-full">High</span></td>
                        <td class="px-6 py-4"><x-status-badge status="active" /></td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-primary font-bold text-xs hover:underline">View Details</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

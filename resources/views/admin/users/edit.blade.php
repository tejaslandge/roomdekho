@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <h1 class="text-2xl font-bold text-text-primary mb-6">Edit User Profile</h1>
        
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="flex items-center gap-6 mb-8">
                <img class="h-24 w-24 rounded-full object-cover border-4 border-gray-50 shadow-sm" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                <div class="space-y-1">
                    <label class="text-sm font-bold text-text-secondary block">Profile Photo</label>
                    <input type="file" name="profile_photo" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    @error('profile_photo')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Role</label>
                    <select name="role" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20">
                        <option value="tenant" {{ $user->role === 'tenant' ? 'selected' : '' }}>Tenant</option>
                        <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.users.index') }}" class="text-text-secondary font-bold hover:text-text-primary transition-colors">Cancel</a>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

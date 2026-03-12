@extends('layouts.dashboard')

@section('title', 'Profile Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <div class="w-20 h-20 rounded-3xl bg-primary/10 border-2 border-primary/20 flex items-center justify-center text-primary text-3xl font-bold">
            {{ substr($user->name, 0, 1) }}
        </div>
        <div>
            <h1 class="text-2xl font-bold text-text-primary">{{ $user->name }}</h1>
            <p class="text-text-secondary capitalize">{{ $user->role }} Account</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <h2 class="text-lg font-bold text-text-primary mb-6">Profile Information</h2>
                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="space-y-2">
                        <label for="name" class="text-sm font-bold text-text-primary">Full Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-soft/50 focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm outline-none" required autofocus autocomplete="name" />
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-sm font-bold text-text-primary">Email Address</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-soft/50 focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm outline-none" required autocomplete="username" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 active:scale-95">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <h2 class="text-lg font-bold text-text-primary mb-6">Update Password</h2>
                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div class="space-y-2">
                        <label for="current_password" class="text-sm font-bold text-text-primary">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-soft/50 focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm outline-none" autocomplete="current-password" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-sm font-bold text-text-primary">New Password</label>
                        <input id="password" name="password" type="password" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-soft/50 focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all text-sm outline-none" autocomplete="new-password" />
                    </div>

                    <button type="submit" class="bg-white text-text-primary border border-gray-200 px-8 py-3 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all active:scale-95">
                        Update Password
                    </button>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 border-l-4 border-l-secondary">
                <h3 class="font-bold text-text-primary mb-2">Account Status</h3>
                <p class="text-sm text-text-secondary mb-4">Your account is fully active and verified.</p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="text-xs font-bold text-green-600 uppercase">Verified</span>
                </div>
            </div>

            <div class="bg-red-50/50 rounded-3xl border border-red-100 p-8">
                <h3 class="font-bold text-red-600 mb-2">Delete Account</h3>
                <p class="text-sm text-red-500/80 mb-6">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                <button @click="$dispatch('open-modal', 'confirm-user-deletion')" class="w-full bg-white text-red-500 border border-red-100 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-red-50 transition-all active:scale-95 text-center">
                    Delete Account
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

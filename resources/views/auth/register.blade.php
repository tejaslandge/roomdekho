<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Create Account</h2>
        <p class="mt-2 text-sm text-gray-600">Join our community today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" class="text-gray-700 font-medium" />
            <x-text-input id="profile_photo" class="block mt-1 w-full" type="file" name="profile_photo" accept="image/*" />
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" class="text-gray-700 font-medium" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autocomplete="tel" placeholder="+91 98765 43210" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label :value="__('I want to')" class="text-gray-700 font-medium" />
            <div class="grid grid-cols-2 gap-3 mt-1">
                <label class="cursor-pointer">
                    <input type="radio" name="role" value="tenant" class="peer sr-only" @checked(old('role', 'tenant') === 'tenant')>
                    <div class="p-3 text-center rounded-xl border-2 border-gray-100 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition-all">
                        <p class="text-sm font-bold text-gray-800">Rent a Room</p>
                        <p class="text-xs text-gray-500">I'm a tenant</p>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="role" value="owner" class="peer sr-only" @checked(old('role') === 'owner')>
                    <div class="p-3 text-center rounded-xl border-2 border-gray-100 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition-all">
                        <p class="text-sm font-bold text-gray-800">List a Property</p>
                        <p class="text-xs text-gray-500">I'm an owner</p>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already registered? 
                <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-500">
                    Sign in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

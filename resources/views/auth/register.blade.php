<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black uppercase tracking-tight">Create Account</h2>
        <p class="mt-2 text-sm font-mono text-gray-600">Join the community</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full">
                {{ __('Create account') }}
            </x-primary-button>
        </div>

        <!-- Sign In Link -->
        <div class="mt-6 text-center">
            <p class="text-sm font-mono">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-black hover:bg-neo-yellow px-1 transition-colors border-b-2 border-black">
                    {{ __('Sign in') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

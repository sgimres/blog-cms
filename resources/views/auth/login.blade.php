<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black uppercase tracking-tight">Welcome back</h2>
        <p class="mt-2 text-sm font-mono text-gray-600">Sign in to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-bold text-black hover:text-neo-blue hover:underline decoration-2 underline-offset-2">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="h-5 w-5 text-black focus:ring-black border-2 border-black rounded-none shadow-neo-sm checked:bg-black">
            <label for="remember_me" class="ml-2 block text-sm font-bold text-gray-700">
                {{ __('Remember me') }}
            </label>
        </div>

        <div>
            <x-primary-button class="w-full">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>

        <!-- Sign Up Link -->
        <div class="mt-6 text-center">
            <p class="text-sm font-mono">
                New here? 
                <a href="{{ route('register') }}" class="font-bold text-black hover:bg-neo-yellow px-1 transition-colors border-b-2 border-black">
                    {{ __('Create an account') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

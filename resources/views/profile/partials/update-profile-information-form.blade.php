<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('patch')

    <div>
        <x-input-label for="name" :value="__('Full Name')" />
        <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="ENTER YOUR FULL NAME" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email Address')" />
        <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" placeholder="ENTER YOUR EMAIL ADDRESS" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4 p-4 bg-neo-yellow border-2 border-black shadow-neo-sm">
                <div class="flex items-start">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-black">
                            {{ __('Your email address is unverified.') }}
                        </p>
                        <button form="send-verification" class="mt-2 text-sm font-black text-black underline decoration-2 underline-offset-2 hover:text-neo-blue">
                            {{ __('Click here to re-send verification email.') }}
                        </button>
                    </div>
                </div>
            </div>

            @if (session('status') === 'verification-link-sent')
                <div class="mt-4 p-4 bg-neo-green border-2 border-black shadow-neo-sm">
                    <p class="text-sm font-bold text-black">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                </div>
            @endif
        @endif
    </div>

    <div class="flex items-center gap-4 pt-4 border-t-4 border-black">
        <x-primary-button>
            {{ __('Save Changes') }}
        </x-primary-button>

        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-bold text-neo-green uppercase bg-black text-white px-2 py-1">
                {{ __('Saved!') }}
            </div>
        @endif
    </div>
</form>

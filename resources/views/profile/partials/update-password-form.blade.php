<form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
        <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" placeholder="ENTER CURRENT PASSWORD" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="update_password_password" :value="__('New Password')" />
        <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" placeholder="ENTER NEW PASSWORD" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        <p class="mt-2 text-xs font-mono font-bold text-gray-500">
            USE 8+ CHARACTERS WITH MIXED CASE, NUMBERS & SYMBOLS.
        </p>
    </div>

    <div>
        <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" />
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="CONFIRM NEW PASSWORD" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4 pt-4 border-t-4 border-black">
        <x-primary-button>
            {{ __('Update Password') }}
        </x-primary-button>

        @if (session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-bold text-neo-green uppercase bg-black text-white px-2 py-1">
                {{ __('Updated!') }}
            </div>
        @endif
    </div>
</form>

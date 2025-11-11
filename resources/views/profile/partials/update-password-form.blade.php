<form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
        <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" placeholder="Enter your current password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" />
    </div>

    <div>
        <x-input-label for="update_password_password" :value="__('New Password')" />
        <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" placeholder="Enter your new password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" />
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Use at least 8 characters with a mix of letters, numbers, and symbols.
        </p>
    </div>

    <div>
        <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" />
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Confirm your new password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
    </div>

    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <x-primary-button>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Update Password') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="flex items-center text-sm text-green-600 dark:text-green-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ __('Password updated successfully!') }}
                </div>
            @endif
        </div>
    </div>
</form>

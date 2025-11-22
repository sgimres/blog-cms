<div class="space-y-6">
    <div class="p-4 bg-red-100 border-2 border-black shadow-neo-sm">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <div class="ml-3">
                <h4 class="text-base font-black text-red-800 uppercase">{{ __('Warning: Irreversible Action') }}</h4>
                <p class="text-sm font-mono font-bold text-red-700 mt-1">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
            </div>
        </div>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-red-600 border-2 border-black text-white font-black uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white border-4 border-black">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-black uppercase">
                {{ __('Delete Account?') }}
            </h2>

            <p class="mt-2 text-sm font-mono text-gray-600 font-bold">
                {{ __('This action cannot be undone. All your posts, comments, and data will be permanently removed.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" :value="__('Password')" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('ENTER PASSWORD TO CONFIRM') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-white border-2 border-black text-black font-bold uppercase hover:bg-gray-100 transition-colors">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="px-4 py-2 bg-red-600 border-2 border-black text-white font-bold uppercase hover:bg-red-700 shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</div>

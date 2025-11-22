<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black uppercase leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-4 border-black shadow-neo-lg p-8 relative overflow-hidden">
                <!-- Decorative corner -->
                <div class="absolute top-0 right-0 w-16 h-16 bg-neo-blue border-b-4 border-l-4 border-black -mr-8 -mt-8 transform rotate-45"></div>

                <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="parent_id" :value="__('Parent Category (Optional)')" />
                        <div class="relative">
                            <select id="parent_id" name="parent_id" class="block mt-1 w-full px-4 py-3 bg-neo-white border-2 border-black text-black font-bold focus:outline-none focus:border-neo-blue focus:shadow-neo-sm transition-all duration-200 appearance-none">
                                <option value="">NO PARENT</option>
                                @foreach($categories as $cat)
                                    @if($cat->id !== $category->id)
                                        <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ strtoupper($cat->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                             <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t-4 border-black">
                        <a href="{{ route('categories.index') }}" class="mr-4 font-bold uppercase text-black hover:text-neo-blue hover:underline decoration-2 underline-offset-2">
                            Cancel
                        </a>
                        <x-primary-button>
                            {{ __('Update Category') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
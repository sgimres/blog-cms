<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black uppercase leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <!-- Profile Header -->
    <div class="mb-10">
        <div class="bg-white border-4 border-black shadow-neo p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-neo-yellow border-b-4 border-l-4 border-black -mr-12 -mt-12 transform rotate-45"></div>
            
            <div class="flex flex-col md:flex-row items-center relative z-10">
                <div class="w-24 h-24 bg-black text-white border-4 border-black flex items-center justify-center text-4xl font-black shadow-neo-sm mb-6 md:mb-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="md:ml-8 text-center md:text-left">
                    <h1 class="text-4xl font-black uppercase tracking-tight">{{ Auth::user()->name }}</h1>
                    <p class="font-mono text-gray-600 font-bold">{{ Auth::user()->email }}</p>
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                        <span class="inline-flex items-center px-3 py-1 text-xs font-black uppercase bg-neo-blue text-white border-2 border-black shadow-neo-sm">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 text-xs font-black uppercase bg-neo-white text-black border-2 border-black shadow-neo-sm">
                            Joined {{ Auth::user()->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white border-4 border-black shadow-neo">
                <div class="p-6 border-b-4 border-black bg-neo-white">
                    <h3 class="text-xl font-black uppercase">Profile Information</h3>
                    <p class="font-mono text-sm text-gray-600">Update your account's profile information and email address.</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-neo">
                <div class="p-6 border-b-4 border-black bg-neo-white">
                    <h3 class="text-xl font-black uppercase">Update Password</h3>
                    <p class="font-mono text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Quick Stats -->
            <div class="bg-white border-4 border-black shadow-neo p-6">
                <h3 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-2">Your Activity</h3>
                <div class="space-y-4 font-mono">
                    <div class="flex items-center justify-between p-2 bg-gray-100 border-2 border-black">
                        <span class="text-sm font-bold">Posts Created</span>
                        <span class="text-lg font-black">{{ Auth::user()->posts()->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-green-100 border-2 border-black">
                        <span class="text-sm font-bold">Published</span>
                        <span class="text-lg font-black text-green-800">{{ Auth::user()->posts()->where('status', 'published')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-yellow-100 border-2 border-black">
                        <span class="text-sm font-bold">Drafts</span>
                        <span class="text-lg font-black text-yellow-800">{{ Auth::user()->posts()->where('status', 'draft')->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white border-4 border-black shadow-neo p-6">
                <h3 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-2">Quick Actions</h3>
                <div class="space-y-4">
                    <a href="{{ route('posts.create') }}" class="w-full flex items-center justify-center px-4 py-3 bg-neo-blue text-white font-black uppercase border-2 border-black shadow-neo-sm hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                        <span class="mr-2 text-xl">+</span> Create New Post
                    </a>
                    <a href="{{ route('posts.my') }}" class="w-full flex items-center justify-center px-4 py-3 bg-white text-black font-black uppercase border-2 border-black shadow-neo-sm hover:bg-black hover:text-white hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                        My Posts Dashboard
                    </a>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-red-50 border-4 border-black shadow-neo">
                <div class="p-6 border-b-4 border-black bg-red-100">
                    <h3 class="text-xl font-black uppercase text-red-600">Delete Account</h3>
                    <p class="font-mono text-sm text-red-800">Permanently delete your account and all associated data.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

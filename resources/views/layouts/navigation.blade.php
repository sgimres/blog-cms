<nav x-data="{ open: false }" class="bg-white border-b-4 border-black sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-neo-yellow border-2 border-black shadow-neo-sm group-hover:shadow-none group-hover:translate-x-[2px] group-hover:translate-y-[2px] transition-all flex items-center justify-center">
                            <span class="font-black text-xl italic">B</span>
                        </div>
                        <span class="font-black text-xl tracking-tighter uppercase italic hidden sm:block">
                            BLOG<span class="text-white text-stroke-black" style="-webkit-text-stroke: 1px black;">CMS</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    @if(Auth::check())
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-bold uppercase tracking-wider {{ request()->routeIs('dashboard') ? 'border-b-4 border-neo-blue' : 'border-b-4 border-transparent hover:border-gray-300' }} transition-all h-full">
                            Dashboard
                        </a>
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-bold uppercase tracking-wider {{ request()->routeIs('posts.*') ? 'border-b-4 border-neo-green' : 'border-b-4 border-transparent hover:border-gray-300' }} transition-all h-full">
                            Posts
                        </a>
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-bold uppercase tracking-wider {{ request()->routeIs('categories.*') ? 'border-b-4 border-neo-purple' : 'border-b-4 border-transparent hover:border-gray-300' }} transition-all h-full">
                            Categories
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-bold uppercase tracking-wider {{ request()->routeIs('admin.*') ? 'border-b-4 border-red-500' : 'border-b-4 border-transparent hover:border-gray-300' }} transition-all h-full">
                                Admin
                            </a>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                @if(Auth::check())
                    <!-- Notification Dropdown -->
                    <div class="relative" x-data="{ notificationOpen: false }">
                        <button @click="notificationOpen = ! notificationOpen" class="relative p-2 text-black hover:bg-gray-100 transition-colors border-2 border-transparent hover:border-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 border-2 border-black rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div x-show="notificationOpen" @click.away="notificationOpen = false" style="display: none;" class="absolute right-0 mt-2 w-80 bg-white border-4 border-black shadow-neo-lg z-50">
                            <div class="flex justify-between items-center px-4 py-2 border-b-2 border-black bg-gray-50">
                                <span class="font-bold uppercase text-sm">Notifications</span>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                                        @csrf
                                        <button type="submit" class="text-xs font-bold text-neo-blue hover:underline">Mark all read</button>
                                    </form>
                                @endif
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <div class="p-4 border-b-2 border-black last:border-0 hover:bg-gray-50 transition-colors">
                                        <div class="flex justify-between items-start gap-2">
                                            <div>
                                                <p class="font-bold text-sm">{{ $notification->title }}</p>
                                                <p class="text-xs text-gray-600 mt-1">{{ $notification->message }}</p>
                                                <p class="text-[10px] text-gray-400 mt-2 font-mono">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                            <form method="POST" action="{{ route('notifications.mark-read', $notification->id) }}">
                                                @csrf
                                                <button type="submit" class="text-gray-400 hover:text-green-600 transition-colors" title="Mark as read">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-gray-500 text-sm italic">
                                        No new notifications.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="font-mono text-sm font-bold bg-neo-white px-2 py-1 border-2 border-black hover:bg-black hover:text-white transition-colors cursor-pointer">
                        {{ Auth::user()->name }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold font-mono text-xs uppercase bg-black text-white px-4 py-2 border-2 border-transparent hover:bg-white hover:text-black hover:border-black transition-all shadow-neo-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-bold font-mono text-sm uppercase text-gray-500 hover:text-black">Log in</a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t-4 border-black bg-neo-white">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::check())
                <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-bold uppercase {{ request()->routeIs('dashboard') ? 'border-neo-blue bg-blue-50' : 'border-transparent hover:bg-gray-50 hover:border-gray-300' }}">
                    Dashboard
                </a>
                <a href="{{ route('posts.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-bold uppercase {{ request()->routeIs('posts.*') ? 'border-neo-green bg-green-50' : 'border-transparent hover:bg-gray-50 hover:border-gray-300' }}">
                    Posts
                </a>
                <a href="{{ route('categories.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-bold uppercase {{ request()->routeIs('categories.*') ? 'border-neo-purple bg-purple-50' : 'border-transparent hover:bg-gray-50 hover:border-gray-300' }}">
                    Categories
                </a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-bold uppercase {{ request()->routeIs('admin.*') ? 'border-red-500 bg-red-50' : 'border-transparent hover:bg-gray-50 hover:border-gray-300' }}">
                        Admin
                    </a>
                @endif
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t-4 border-black">
            @if(Auth::check())
                <div class="px-4">
                    <a href="{{ route('profile.edit') }}" class="block font-black text-base text-gray-800 hover:text-neo-blue underline decoration-2 underline-offset-2 decoration-transparent hover:decoration-neo-blue transition-all">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>

                    <!-- Mobile Notifications -->
                    <div class="mt-4 border-t-2 border-gray-200 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold uppercase text-sm">Notifications</h3>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                                    @csrf
                                    <button type="submit" class="text-xs font-bold text-neo-blue hover:underline">Mark All Read</button>
                                </form>
                            @endif
                        </div>
                        
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <div class="space-y-3">
                                @foreach(auth()->user()->unreadNotifications->take(3) as $notification)
                                    <div class="bg-gray-50 p-3 border border-black">
                                        <p class="font-bold text-sm">{{ $notification->title }}</p>
                                        <p class="text-xs text-gray-600 mt-1">{{ Str::limit($notification->message, 60) }}</p>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-[10px] text-gray-400 font-mono">{{ $notification->created_at->diffForHumans() }}</span>
                                            <form method="POST" action="{{ route('notifications.mark-read', $notification->id) }}">
                                                @csrf
                                                <button type="submit" class="text-neo-blue hover:underline text-[10px] uppercase font-bold">Mark Read</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                                @if(auth()->user()->unreadNotifications->count() > 3)
                                    <p class="text-xs text-center text-gray-500 mt-2">+ {{ auth()->user()->unreadNotifications->count() - 3 }} more</p>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-gray-500 italic">No new notifications.</p>
                        @endif
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent hover:bg-gray-50 hover:border-gray-300 text-base font-bold uppercase">
                            Log Out
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</nav>
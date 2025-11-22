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
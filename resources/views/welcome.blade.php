<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,700,900|jetbrains-mono:400,700&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-neo-white text-black selection:bg-black selection:text-neo-white">
        <div class="min-h-screen flex flex-col relative overflow-x-hidden">
            
            <!-- Navigation -->
            <nav class="w-full border-b-4 border-black bg-white z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <div class="text-4xl font-black uppercase tracking-tighter italic transform -rotate-2 bg-neo-yellow px-2 border-2 border-black shadow-neo-sm">
                                BLOG<span class="text-white text-stroke-black">CMS</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="font-bold font-mono uppercase border-2 border-transparent hover:border-black hover:bg-neo-green px-4 py-2 transition-all">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-bold font-mono uppercase border-2 border-black bg-white hover:bg-black hover:text-white px-4 py-2 transition-all shadow-neo-sm hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="font-bold font-mono uppercase border-2 border-black bg-neo-blue text-white hover:bg-blue-700 px-4 py-2 transition-all shadow-neo-sm hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="space-y-8">
                            <div class="inline-block bg-black text-white font-mono font-bold px-3 py-1 transform rotate-1">
                                v1.0.0 // PRODUCTION READY
                            </div>
                            <h1 class="text-6xl md:text-8xl font-black uppercase leading-[0.9] tracking-tighter">
                                WRITE<br>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-neo-blue to-neo-purple" style="-webkit-text-stroke: 2px black;">LOUDly.</span>
                            </h1>
                            <p class="text-xl md:text-2xl font-bold border-l-8 border-neo-yellow pl-6 py-2">
                                A raw, unfiltered content management system for those who dare to break the mold.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('register') }}" class="text-center px-8 py-4 bg-black text-white font-black text-lg uppercase border-4 border-transparent hover:bg-white hover:text-black hover:border-black transition-all shadow-neo hover:shadow-neo-sm">
                                    Start Writing
                                </a>
                                <a href="#features" class="text-center px-8 py-4 bg-white text-black font-black text-lg uppercase border-4 border-black hover:bg-neo-yellow transition-all shadow-neo hover:shadow-neo-sm">
                                    Explore Features
                                </a>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="absolute top-0 right-0 w-full h-full bg-neo-purple border-4 border-black transform translate-x-4 translate-y-4 z-0"></div>
                            <div class="relative z-10 bg-white border-4 border-black p-2 shadow-neo">
                                <div class="bg-gray-100 border-2 border-dashed border-gray-300 p-8 min-h-[400px] flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-6xl mb-4">✍️</div>
                                        <h3 class="text-2xl font-black uppercase mb-2">Your Content Here</h3>
                                        <p class="font-mono text-sm text-gray-500">Wait for the inspiration...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Marquee Divider -->
                <div class="border-y-4 border-black bg-neo-yellow overflow-hidden py-4 mb-20">
                    <div class="whitespace-nowrap animate-marquee inline-block">
                        <span class="text-4xl font-black uppercase mx-8">NO TEMPLATES.</span>
                        <span class="text-4xl font-black uppercase mx-8 text-white text-stroke-black">JUST RAW CONTENT.</span>
                        <span class="text-4xl font-black uppercase mx-8">PURE EXPRESSION.</span>
                        <span class="text-4xl font-black uppercase mx-8 text-white text-stroke-black">BREAK THE RULES.</span>
                        <span class="text-4xl font-black uppercase mx-8">NO TEMPLATES.</span>
                        <span class="text-4xl font-black uppercase mx-8 text-white text-stroke-black">JUST RAW CONTENT.</span>
                    </div>
                </div>

                <!-- Features Grid -->
                <div id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white border-4 border-black p-8 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                            <div class="w-16 h-16 bg-neo-blue border-4 border-black mb-6 flex items-center justify-center text-white text-2xl font-bold">
                                01
                            </div>
                            <h3 class="text-2xl font-black uppercase mb-4">Fast & Furious</h3>
                            <p class="font-mono text-sm leading-relaxed">
                                Optimized for speed. No bloat. Just the code you need to get your words out there.
                            </p>
                        </div>
                        <!-- Feature 2 -->
                        <div class="bg-white border-4 border-black p-8 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                            <div class="w-16 h-16 bg-neo-green border-4 border-black mb-6 flex items-center justify-center text-black text-2xl font-bold">
                                02
                            </div>
                            <h3 class="text-2xl font-black uppercase mb-4">Brutally Simple</h3>
                            <p class="font-mono text-sm leading-relaxed">
                                A dashboard that doesn't hide behind fancy gradients. It tells you what you need to know.
                            </p>
                        </div>
                        <!-- Feature 3 -->
                        <div class="bg-white border-4 border-black p-8 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                            <div class="w-16 h-16 bg-neo-pink border-4 border-black mb-6 flex items-center justify-center text-white text-2xl font-bold" style="background-color: #FF69B4;">
                                03
                            </div>
                            <h3 class="text-2xl font-black uppercase mb-4">Secure Core</h3>
                            <p class="font-mono text-sm leading-relaxed">
                                Built on Laravel. Rock solid security standards to keep your thoughts safe.
                            </p>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-black text-white py-12 border-t-4 border-neo-blue">
                <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-2xl font-black uppercase italic">BLOGCMS</h2>
                    </div>
                    <div class="font-mono text-sm text-gray-400">
                        DESIGNED FOR THE BOLD.
                    </div>
                </div>
            </footer>
        </div>

        <style>
            .text-stroke-black {
                -webkit-text-stroke: 1px black;
            }
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee {
                animation: marquee 20s linear infinite;
            }
        </style>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,900|jetbrains-mono:400,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f0f0f0] text-neo-black selection:bg-neo-yellow selection:text-black min-h-screen flex flex-col justify-center items-center py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Logo Section -->
            <div class="flex justify-center">
                <a href="/" class="group">
                   <div class="bg-black p-4 border-2 border-black shadow-neo group-hover:translate-x-[2px] group-hover:translate-y-[2px] group-hover:shadow-none transition-all duration-200">
                        <x-application-logo class="w-12 h-12 fill-current text-white" />
                   </div>
                </a>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white border-4 border-black shadow-neo-lg p-8 relative overflow-hidden">
                <!-- decorative corner -->
                <div class="absolute top-0 right-0 w-8 h-8 bg-neo-yellow border-b-4 border-l-4 border-black"></div>
                
                {{ $slot }}
            </div>
            
            <!-- Footer Links -->
            <div class="text-center">
                <p class="text-sm font-mono font-bold">&copy; {{ date('Y') }} {{ config('app.name') }}.</p>
            </div>
        </div>

        <!-- Toast Notifications Container -->
        <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-3 pointer-events-none"></div>
    </body>
</html>

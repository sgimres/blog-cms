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
    <body class="font-sans antialiased bg-[#f0f0f0] text-neo-black selection:bg-neo-yellow selection:text-black">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b-4 border-black">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="font-black text-3xl tracking-tight uppercase transform -rotate-1">
                            {{ $header }}
                        </div>
                        @isset($actions)
                            <div class="flex items-center gap-3">
                                {{ $actions }}
                            </div>
                        @endisset
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 py-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-black text-white py-8 border-t-4 border-neo-yellow">
                <div class="max-w-7xl mx-auto px-4 text-center font-mono text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. ALL RIGHTS RESERVED.
                </div>
            </footer>
        </div>

        <!-- Toast Notifications Container -->
        <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-3 pointer-events-none"></div>
    </body>
</html>
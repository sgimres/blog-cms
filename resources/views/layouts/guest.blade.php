<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-inter antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12">
            <!-- Logo Section -->
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-200">
                        <x-application-logo class="w-8 h-8 fill-current text-white" />
                    </div>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Welcome back to your blog</p>
            </div>

            <!-- Main Content Card -->
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>
        </div>

        <!-- Toast Notifications Container -->
        <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>
    </body>
</html>

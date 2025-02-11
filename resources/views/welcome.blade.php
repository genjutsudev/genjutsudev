<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/assets/css/app.css', 'resources/assets/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6 container">
                        <h1 class="text-center">Hello, World!</h1>

                        <x-ui.subheadline :label="__('test - default')" />
                        <x-ui.subheadline :label="__('test - default (blue)')" class="blue" />
                        <x-ui.subheadline :label="__('test - default (azure)')" class="azure" />
                        <x-ui.subheadline :label="__('test - default (indigo)')" class="indigo" />
                        <x-ui.subheadline :label="__('test - default (purple)')" class="purple" />
                        <x-ui.subheadline :label="__('test - default (pink)')" class="pink" />
                        <x-ui.subheadline :label="__('test - default (red)')" class="red" />
                        <x-ui.subheadline :label="__('test - default (orange)')" class="orange" />
                        <x-ui.subheadline :label="__('test - default (yellow)')" class="yellow" />
                        <x-ui.subheadline :label="__('test - default (green)')" class="green" />
                        <x-ui.subheadline :label="__('test - default (teal)')" class="teal" />
                        <x-ui.subheadline :label="__('test - default (cyan)')" class="cyan" />
                        <x-ui.subheadline :label="__('test - default - link')" :href="__('/')" />
                        <div class="block">
                            <x-ui.subheadline :label="__('test - default - options')">
                                <x-slot:options>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                                        </ol>
                                    </nav>
                                </x-slot:options>
                                slot
                            </x-ui.subheadline>
                        </div>

                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>

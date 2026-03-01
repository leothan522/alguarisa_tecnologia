<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Alguarisa') - {{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="App de la Dirección de Tecnología y Sistemas de Alimentos del Guárico S.A.">
        <meta name="theme-color" content="#ffffff">

        <meta property="og:title" content="Tecnología ALGUARISA">
        <meta property="og:description" content="App de la Dirección de Tecnología y Sistemas de Alimentos del Guárico S.A.">
        <meta property="og:image" content="{{ asset('favicons/favicon-128x128.png') }}">

        {{-- Favicon y PWA --}}
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicons/favicon-128x128.png') }}">

        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">

            @if(\Illuminate\Support\Facades\Route::currentRouteName() != 'usuarios.perfil' &&
                \Illuminate\Support\Facades\Route::currentRouteName() != 'web.perfil' )
                @livewire('navigation-menu')
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>

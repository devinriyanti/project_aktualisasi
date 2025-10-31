<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Portamu Kalsel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .bg-biru-tua{
                background-color: #1B2C5D;
            }
            .text-biru-tua{
                color: #1B2C5D;
            }
            .bg-kuning-emas{
                background-color: #FFCB05;
            }
            .text-kuning-emas{
                color: #FFCB05;
            }
            body {
                background-image: 
                    linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.2)), 
                    url('{{ asset("brand/bgbg.jpeg") }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }


        </style>
    </head>
    <body class="font-sans antialiased">
        <div class=" bg-gray-100d">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main style="height: 100vh;">
                @yield('content')
            </main>
        </div>
    </body>
</html>

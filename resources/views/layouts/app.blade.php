<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- jQuery CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/css/commom.css'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
         <!-- Tailwind CSS and Custom JS -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     const items = document.querySelectorAll('[data-carousel-item]');
        //     let currentIndex = 0;

        //     function showSlide(index) {
        //         items.forEach((item, i) => {
        //             item.classList.toggle('hidden', i !== index);
        //         });
        //     }

        //     document.querySelector('[data-carousel-prev]').addEventListener('click', () => {
        //         currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
        //         showSlide(currentIndex);
        //     });

        //     document.querySelector('[data-carousel-next]').addEventListener('click', () => {
        //         currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
        //         showSlide(currentIndex);
        //     });

        //     showSlide(currentIndex); // Show the first slide initially
        // });
    </script>
    </body>
</html>

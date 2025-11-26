<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Advance Micro device (MDI)') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Tailwind & Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine (first, defer) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Critical CSS + Page Loader -->
    <style>
        [x-cloak] { display: none !important; }

        /* Page Transition Loader */
        #page-loader {
            position: fixed;
            inset: 0;
            background: rgb(249 250 251); /* bg-gray-50 */
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        #page-loader.hidden { opacity: 0; }
        #page-loader.done { display: none; }

        /* Spinner */
        .spinner {
            width: 3rem;
            height: 3rem;
            border: 4px solid #dbeafe;
            border-top-color: #2563eb;
            border-radius: 9999px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 min-h-screen">

    <!-- PAGE TRANSITION LOADER -->
    <div id="page-loader" x-data x-init="
        // Hide loader after page load
        window.addEventListener('load', () => {
            setTimeout(() => $el.classList.add('hidden'), 100);
            setTimeout(() => $el.classList.add('done'), 400);
        });
    ">
        <div class="text-center">
            <div class="spinner"></div>
            <p class="mt-4 text-sm font-medium text-gray-600">Loading...</p>
        </div>
    </div>

    <!-- MAIN LAYOUT -->
    <div class="flex h-screen overflow-hidden">
        @include('layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300"
             :class="open ? 'lg:ml-72' : 'lg:ml-20'">
            @include('layouts.navigation')

            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-4 py-8">
                    {{ $slot }}
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </div>

    <!-- MOBILE MENU TOGGLE -->
    <button @click="mobileOpen = true"
            class="fixed bottom-6 right-6 lg:hidden z-40 w-14 h-14 bg-blue-600 text-white rounded-full shadow-xl flex items-center justify-center hover:bg-blue-700 transition-all">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- PAGE TRANSITION SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loader = document.getElementById('page-loader');

            // Show loader on EVERY navigation click
            document.body.addEventListener('click', (e) => {
                const link = e.target.closest('a[href]');
                if (
                    link &&
                    link.href &&
                    !link.href.includes('#') &&
                    link.target !== '_blank' &&
                    !link.closest('[data-turbo]') &&
                    new URL(link.href).origin === location.origin
                ) {
                    e.preventDefault();
                    loader.classList.remove('hidden', 'done');
                    loader.style.opacity = '1';

                    // Navigate after tiny delay
                    setTimeout(() => {
                        window.location = link.href;
                    }, 50);
                }
            });

            // Hide loader when page fully loads
            window.addEventListener('load', () => {
                setTimeout(() => loader.classList.add('hidden'), 100);
                setTimeout(() => loader.classList.add('done'), 400);
            });
        });
    </script>

</body>
</html>
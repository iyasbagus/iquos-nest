<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'IQUOS Nest') }}</title> --}}

    <title id="dynamicTitle" >IQUOS Nest Admin</title>

    <link rel="Icon" type="png" href="../iquosnest-logo-title.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <link href="https://unpkg.com/aos@2.3.1a/dist/aos.css" rel="stylesheet">


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar di Kiri -->
        <div class="fixed top-0 left-0 w-64 h-screen bg-white shadow-lg">
            @include('admin.components.sidebar')
        </div>


        <!-- Konten di Kanan -->
        <div class="flex-1 ml-64">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        AOS.init();

        lucide.createIcons(); // auto replace all <i data-lucide="icon-name"></i>
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let pageTitle = document.title;

            function updateTitle(newTitle) {
                document.title = newTitle + " | IQUOS Nest";
            }

            // Contoh penggunaan: Ubah title berdasarkan halaman
            if (window.location.pathname.includes("dashboard")) {
                updateTitle("Dashboard");
            } else if (window.location.pathname.includes("profile")) {
                updateTitle("Profile");
            } else if (window.location.pathname.includes("category")) {
                updateTitle("Category")
            } else if (window.location.pathname.includes("tag")) {
                updateTitle("Tag")
            } else if (window.location.pathname.includes("asset")) {
                updateTitle("Assets")
            } else {
                document.title = pageTitle; // Kembalikan ke default
            }
        });
    </script>
</body>

</html>

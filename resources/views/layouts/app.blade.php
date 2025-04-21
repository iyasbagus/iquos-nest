<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'IQUOS Nest') }}</title> --}}

    <title id="dynamicTitle">IQUOS Nest Admin</title>

    <link rel="Icon" type="png" href="../iquosnest-logo-title.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <link href="https://unpkg.com/aos@2.3.1a/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <style>
        [x-cloak] {
            display: none !important;
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #60a5fa, #a78bfa, #f472b6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
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


    <div id="loading-overlay"
        class="hidden fixed inset-0 bg-white/90 z-[9999] flex flex-col items-center justify-center space-y-2">
        <lottie-player id="lottie-loader" src="{{ asset('lottie/main-loading.json') }}" background="transparent"
            speed="1" class="w-32 h-32" loop autoplay></lottie-player>
        <p id="loading-text" class="text-gray-600 text-lg font-medium">Loading...</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        AOS.init();

        lucide.createIcons(); // auto replace all <i data-lucide="icon-name"></i>
    </script>

    {{-- script untuk page title --}}
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

    @php
        $lottiePaths = [
            'page' => asset('lottie/main-loading.json'),
            'submit' => asset('lottie/submit-loading.json'),
            'download' => asset('lottie/download-loading.json'),
        ];
    @endphp

    {{-- script untuk loading --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const overlay = document.getElementById("loading-overlay");
            const lottie = document.getElementById("lottie-loader");
            const loadingText = document.getElementById("loading-text");

            // Ambil path dari Blade (via PHP)
            const lottieSources = @json($lottiePaths);

            // Flag untuk memeriksa navigasi back dari browser
            let navigationType = "navigate";

            // Deteksi navigasi back dari browser dengan Navigation API (modern browsers)
            if (window.navigation && window.navigation.type) {
                navigationType = window.navigation.type;
            }

            // Deteksi navigasi back dari browser dengan Performance API (fallback)
            if (window.performance && window.performance.getEntriesByType && window.performance.getEntriesByType(
                    "navigation").length) {
                navigationType = window.performance.getEntriesByType("navigation")[0].type;
            }

            // Deteksi navigasi back dengan event pageshow (compatible dengan browser lebih lama)
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    // Halaman dimuat dari bfcache (digunakan saat back/forward)
                    // Sembunyikan loading screen jika ada
                    if (overlay && !overlay.classList.contains("hidden")) {
                        overlay.classList.add("hidden");
                    }
                }
            });

            // Deteksi browser back button dengan popstate
            window.addEventListener('popstate', function() {
                // Sembunyikan loading screen jika ada
                if (overlay && !overlay.classList.contains("hidden")) {
                    overlay.classList.add("hidden");
                }
            });

            function showLoading(src, text = "") {
                // Jangan tampilkan loading jika navigasi berasal dari back/forward browser
                if (
                    navigationType === "back_forward" ||
                    navigationType === "backforward" ||
                    (window.performance && window.performance.navigation &&
                        window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD)
                ) {
                    return;
                }

                lottie.setAttribute("src", src);
                loadingText.textContent = text;
                overlay.classList.remove("hidden");
            }

            // Pindah halaman biasa
            document.querySelectorAll("a[href]").forEach(link => {
                if (!link.target || link.target === "_self") {
                    link.addEventListener("click", function(e) {
                        const href = link.getAttribute("href");

                        // Skip jika link adalah anchor, javascript, atau halaman yang sama
                        if (
                            href.startsWith("#") ||
                            href.startsWith("javascript:") ||
                            href === window.location.href
                        ) return;

                        e.preventDefault();
                        showLoading(lottieSources.page);
                        setTimeout(() => {
                            window.location.href = href;
                        }, 1000);
                    });
                }
            });

            // Submit form (login/register/checkout)
            document.querySelectorAll("form").forEach(form => {
                form.addEventListener("submit", function(e) {
                    showLoading(lottieSources.submit, "Processing...");
                });
            });

            // Tombol download
            document.querySelectorAll(".with-download-loading").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    showLoading(lottieSources.download, "Downloading asset...");
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4ade80",
                stopOnFocus: true,
            }).showToast();
        </script>
    @endif

    @if (session('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f87171",
                stopOnFocus: true,
            }).showToast();
        </script>
    @endif

    @if ($errors->any())
        <script>
            Toastify({
                text: "{{ $errors->first() }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f87171",
            }).showToast();
        </script>
    @endif
</body>

</html>

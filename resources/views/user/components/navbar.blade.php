<header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 dark:bg-gray-900">
    <div class="container mx-auto px-4 md:px-14 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <a href="{{ route('welcome') }}">
                    <span class="text-xl font-bold gradient-text">IQUOS Nest</span>
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-8 lg:space-x-14">
                <a href="{{ route('user.explore.listAssetView') }}"
                    class="hover:text-indigo-600 font-medium transition-colors">Explore</a>
                <a href="{{ route('creator-list.profile') }}"
                    class="hover:text-indigo-600 font-medium transition-colors">Creator</a>
                <a href="#" class="hover:text-indigo-600 font-medium transition-colors">About</a>
                <a href="{{ route('subscription.premium') }}"
                    class="hover:text-indigo-600 font-medium transition-colors">Subscription</a>
            </nav>

            @if (Route::has('login'))
                <div class="flex items-center space-x-4">

                    @auth

                        @if (auth()->user()->hasRole('admin'))
                            <div class="hidden md:block md:absolute md:right-52">
                                <a class="group relative inline-flex items-center overflow-hidden rounded-sm border border-current px-8 py-3 text-indigo-600 focus:ring-3 focus:outline-hidden dark:text-indigo-400"
                                    href="{{ route('dashboard') }}">
                                    <span class="absolute -end-full transition-all group-hover:end-4">
                                        <svg class="size-5 shadow-sm rtl:rotate-180" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>

                                    <span class="text-sm font-medium transition-all group-hover:me-4"> Dashboard </span>
                                </a>
                            </div>
                        @elseif (auth()->user()->hasRole('creator'))
                            <div class="hidden md:block md:absolute md:right-52">
                                <a class="group relative inline-flex items-center overflow-hidden rounded-sm border border-current px-8 py-3 text-indigo-600 focus:ring-3 focus:outline-hidden"
                                    href="{{ route('creator.dashboard') }}">
                                    <span class="absolute -end-full transition-all group-hover:end-4">
                                        <svg class="size-5 shadow-sm rtl:rotate-180" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>

                                    <span class="text-sm font-medium transition-all group-hover:me-4"> Dashboard </span>
                                </a>
                            </div>
                        @else
                            <div class="hidden md:block md:absolute md:right-52">
                                <a class="group relative inline-flex items-center overflow-hidden rounded-sm border border-current px-8 py-3 text-indigo-600 focus:ring-3 focus:outline-hidden"
                                    href="{{ route('creator.apply') }}">
                                    <span class="absolute -end-full transition-all group-hover:end-4">
                                        <svg class="size-5 shadow-sm rtl:rotate-180" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>

                                    <span class="text-sm font-medium transition-all group-hover:me-4"> Join Creator </span>
                                </a>
                            </div>
                        @endif

                        {{-- Notifikasi --}}
                        <div class="relative group">
                            <a href="#">
                                <button class="relative hover:text-indigo-600 transition-colors">
                                    <span class="material-icons-outlined">notifications</span>
                                    @php
                                        $unread = auth()->user()->unreadNotifications->count();
                                    @endphp
                                    @if ($unread > 0)
                                        <span
                                            class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                                            {{ $unread }}
                                        </span>
                                    @endif
                                </button>
                            </a>

                            {{-- Dropdown tampil saat hover --}}
                            <div
                                class="hidden group-hover:block absolute right-0 w-80 bg-white shadow-lg rounded-md z-50 dark:bg-gray-800">
                                <div class="p-3 font-bold border-b dark:border-gray-500">Notifikasi</div>
                                <div class="max-h-60 overflow-y-auto">
                                    @forelse(auth()->user()->notifications as $notification)
                                        <div class="px-4 py-3 border-b hover:bg-gray-100">
                                            <div class="text-sm font-semibold">{{ $notification->data['title'] }}</div>
                                            <div class="text-sm text-gray-600">{{ $notification->data['message'] }}</div>
                                            <div class="text-xs text-gray-400">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-sm text-gray-500 dark:text-gray-300">Tidak ada notifikasi.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <x-dropdown>
                            <x-slot name="trigger">
                                <img src="{{ $user->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($user->name) }}"
                                    class="object-cover w-10 h-10 rounded-full" alt="User" />
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profileUser.show') }}">
                                    <div class="flex items-center py-1 text-gray-600 transition">
                                        {{-- <i class="material-icons-outlined">account_circle</i> --}}
                                        <span class="text-sm font-medium dark:text-white">Profile</span>
                                    </div>
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('subscription.history') }}">
                                    <div class="flex items-center py-1 text-gray-600 transition">
                                        {{-- <i class="material-icons-outlined">history</i> --}}
                                        <span class="text-sm font-medium dark:text-white">Subscription History</span>
                                    </div>
                                </x-dropdown-link>

                                <x-dropdown-link href="#">
                                    <div class="flex items-center py-1 text-gray-600 transition">
                                        {{-- <i class="material-icons-outlined">history</i> --}}
                                        <span class="text-sm font-medium dark:text-white">Setting</span>
                                    </div>
                                </x-dropdown-link>

                                <div x-data="{ darkMode: JSON.parse(localStorage.getItem('darkMode') || 'false') }" x-init="document.documentElement.classList.toggle('dark', darkMode)"
                                    class="flex items-center pl-4 py-1 text-gray-600" @click.stop>
                                    <span class="text-sm font-medium mr-3 dark:text-white">Dark Mode</span>

                                    <label
                                        class="relative block h-8 w-14 rounded-full bg-gray-300 transition-colors cursor-pointer"
                                        :class="darkMode ? 'bg-blue-500' : 'bg-gray-300'" @click.stop>
                                        <input type="checkbox" class="sr-only peer" x-model="darkMode"
                                            @change.stop="
                localStorage.setItem('darkMode', darkMode);
                document.documentElement.classList.toggle('dark', darkMode);
               ">
                                        <span
                                            class="absolute inset-y-0 left-0 m-1 h-6 w-6 rounded-full bg-white transition-all"
                                            :class="{ 'translate-x-6': darkMode }"></span>
                                    </label>
                                </div>

                                <x-dropdown-link href="#">
                                    <div class="flex items-center py-1 text-gray-600 transition">
                                        <span class="text-sm font-medium dark:text-white">
                                            Free Dowload Today: {{ $remainingFreeDownloads ?? '-' }}
                                        </span>
                                    </div>
                                    </x-dropdown-link>

                                    @auth
                                        @if (auth()->user()->isPremium())
                                            <x-dropdown-link href="#">
                                                <div class="flex items-center py-1 text-gray-600 transition">
                                                    <span class="text-sm font-medium dark:text-white">
                                                        Pro Download Today: {{ $remainingPremiumDownloads ?? '-' }}
                                                    </span>
                                                </div>
                                            </x-dropdown-link>
                                        @endif
                                    @endauth

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left">
                                            <div
                                                class="flex items-center py-2 text-red-600 transition hover:bg-gray-100 dark:hover:bg-gray-900">
                                                {{-- <i class="material-icons-outlined ml-5">logout</i> --}}
                                                <span class="ml-4 text-sm font-medium">Logout</span>
                                            </div>
                                        </button>
                                    </form>

                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-200 transition">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-medium transition">Sign
                                Up</a>
                        @endif
                    @endauth
                </div>

                <button id="mobile-menu-button"
                    class="md:hidden text-gray-800 hover:text-indigo-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <!-- Mobile menu, hidden by default -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('user.explore.listAssetView') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-indigo-600 hover:bg-gray-50">
                Explore
            </a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-indigo-600 hover:bg-gray-50">
                Creator
            </a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-indigo-600 hover:bg-gray-50">
                About
            </a>
            <a href="{{ route('subscription.premium') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-indigo-600 hover:bg-gray-50">
                Subscription
            </a>
            @auth
                <a href="{{ route('creator.apply') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-indigo-600 hover:bg-indigo-700 hover:text-white">
                    Join Creator
                </a>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // Set initial state
        navbar.classList.add('backdrop-filter', 'backdrop-blur-lg', 'bg-opacity-30', 'bg-white');

        // Handle scroll events
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                // Scrolled state
                navbar.classList.remove('backdrop-filter', 'backdrop-blur-lg', 'bg-opacity-30', 'py-4');
                navbar.classList.add('bg-white', 'shadow-md', 'py-2');
            } else {
                // Initial state
                navbar.classList.add('backdrop-filter', 'backdrop-blur-lg', 'bg-opacity-30', 'py-4');
                navbar.classList.remove('bg-white', 'shadow-md', 'py-2');
            }
        });

        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>

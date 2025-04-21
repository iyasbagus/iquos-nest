<aside
    class="fixed top-0 left-0 h-full flex flex-col items-center w-16 py-8 overflow-y-auto bg-white border-r rtl:border-l rtl:border-r-0 dark:bg-gray-800 dark:border-gray-800">
    <nav class="flex flex-col flex-1 space-y-6">
        <a href="{{ route('welcome') }}">
            <img class="w-auto ml-1 h-7" src="{{ asset('images/iquosnest-logo.png') }}" alt="images">
        </a>

        <a href="{{ route('user.explore.listAssetView') }}"
            class="p-1.5 text-gray-700 transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">
            <i class="material-icons-outlined">home</i>
        </a>

        <a href="{{ route('user.explore.assets') }}"
            class="p-1.5 text-gray-700 transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">
            <i class="material-icons-outlined">explore</i>
        </a>

        <div class="relative">
            <a href="#"
                class="relative p-1.5 text-gray-700 transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100"
                x-data @click="$dispatch('open-modal', 'notification')">
                <span class="material-icons-outlined">notifications</span>
                @php
                    $unread = auth()->user()->unreadNotifications->count();
                @endphp
                @if ($unread > 0)
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">
                        {{ $unread }}
                    </span>
                @endif
            </a>
        </div>

    </nav>

    <div class="flex flex-col space-y-6">
        <a href="#"
            class="p-1.5 text-gray-700 transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">
            <i class="material-icons-outlined">settings</i>
        </a>

        <a href="#" x-data @click="$dispatch('open-modal', 'profile')">
            <img class="object-cover w-8 h-8 rounded-full"
                src="{{ $user->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($user->name) }}"
                alt="" />
        </a>
    </div>
</aside>

<!-- Modal Management Component -->
<div x-data="{
    activeModal: null,
    profiles: {
        'profile': {
            open: false,
            width: '272px'
        },
        'notification': {
            open: false,
            width: '320px'
        }
    }
}"
    @open-modal.window="
        activeModal = $event.detail;
        profiles[activeModal].open = true;
     "
    @close-modals.window="
        profiles[activeModal].open = false;
        activeModal = null;
        document.body.style.overflow = 'auto';
     ">

    <!-- Profile Modal Slide -->
    <div x-show="profiles.profile.open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40" @click="$dispatch('close-modals')" x-cloak>

        <div class="fixed top-0 left-0 w-full h-full bg-white dark:bg-gray-800 shadow-lg z-50 overflow-hidden transition-all duration-300 ease-in-out"
            :style="`width: ${profiles.profile.open ? profiles.profile.width : '0'}`" @click.stop>
            <div class="relative h-full w-full p-6">
                <!-- Close Button -->
                <button @click="$dispatch('close-modals')"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
                    <i class="material-icons-outlined">close</i>
                </button>

                <!-- Profile Header -->
                <div class="flex flex-col items-center pb-6 border-b border-gray-200 dark:border-gray-700">
                    <img class="object-cover w-24 h-24 rounded-full mb-3"
                        src="{{ $user->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($user->name) }}"
                        alt="Profile Picture" />
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>

                    <div class="mt-4 w-full">
                        <a href="{{ route('profileUser.show') }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="material-icons-outlined text-sm mr-2">edit</i>
                            Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Menu Items -->
                <nav class="mt-6 space-y-2">
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="material-icons-outlined mr-3">account_circle</i>
                        <span>My Account</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="material-icons-outlined mr-3">bookmark</i>
                        <span>Saved Items</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="material-icons-outlined mr-3">history</i>
                        <span>Activity History</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="material-icons-outlined mr-3">settings</i>
                        <span>Settings</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 transition-colors rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="material-icons-outlined mr-3">help_outline</i>
                        <span>Help & Support</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="absolute bottom-8 w-[calc(100%-3rem)]">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-red-600 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-red-400 dark:hover:bg-gray-600">
                            <i class="material-icons-outlined mr-2">logout</i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Modal Slide -->
    <div x-show="profiles.notification.open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 " @click="$dispatch('close-modals')" x-cloak>

        <div class="fixed top-0 left-0 w-full h-full bg-white dark:bg-gray-800 shadow-lg z-50 overflow-hidden transition-all duration-300 ease-in-out"
            :style="`width: ${profiles.notification.open ? profiles.notification.width : '0'}`" @click.stop>
            <div class="relative h-full w-full p-6">
                <!-- Close Button -->
                <button @click="$dispatch('close-modals')"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
                    <i class="material-icons-outlined">close</i>
                </button>

                <!-- Notifications Header -->
                <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Notifications</h3>
                    {{-- <button class="text-sm text-blue-600 hover:underline dark:text-blue-400">Mark all as read</button> --}}
                </div>

                <!-- Notifications List -->
                <div class="mt-4 space-y-4 overflow-y-auto max-h-[calc(100%-8rem)]">
                    {{-- <!-- Unread Notification -->
                    <div class="p-3 bg-blue-50 dark:bg-gray-700 rounded-lg relative">
                        <span class="absolute right-3 top-3 w-2 h-2 bg-blue-600 rounded-full"></span>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-3">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center">
                                    <i class="material-icons-outlined text-blue-600 dark:text-blue-300">person_add</i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-200"><span class="font-semibold">John Doe</span> started following you</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 minutes ago</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Regular Notification -->
                    <div class="p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                        @forelse (auth()->user()->notifications as $notification)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-3">
                                    <div
                                        class="w-10 h-10 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center">
                                        <i class="material-icons-outlined text-red-600 dark:text-red-300">cancel</i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-800 dark:text-gray-200"><span
                                            class="font-semibold"></span>{{ $notification->data['message'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-sm text-gray-500 dark:text-gray-300">Tidak ada notifikasi.
                            </div>
                        @endforelse
                    </div>

                    <!-- Regular Notification -->
                    {{-- <div class="p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-800 rounded-full flex items-center justify-center">
                                    <i class="material-icons-outlined text-purple-600 dark:text-purple-300">favorite</i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-200"><span class="font-semibold">Alex Johnson</span> liked your photo</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">3 hours ago</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- More notifications can be added here -->
                </div>

                <!-- View All Button -->
                {{-- <div class="absolute bottom-8 w-[calc(100%-3rem)]">
                    <a href="#" class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        View All Notifications
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Make sure Alpine.js is included in your layout or add this before the closing body tag -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js" defer></script> -->

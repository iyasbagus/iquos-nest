<nav class="flex justify-between pt-4 items-center px-14 py-4">
    <h1 class="text-xl font-bold">IQUOS Nest</h1>

    <ul class="hidden md:flex space-x-16">
        <li><a href="{{ route('user.explore.listAssetView') }}" class="text-gray-700 dark:text-white">Explore</a></li>
        <li><a href="#" class="text-gray-700 dark:text-white">Creator</a></li>
        <li><a href="#" class="text-gray-700 dark:text-white">About</a></li>
        <li><a href="#" class="text-gray-700 dark:text-white">Blog</a></li>
    </ul>

    @if (Route::has('login'))
        <div class="flex items-center space-x-4">


            @auth
                <button><span class="material-icons-outlined">notifications</span></button>
                <x-dropdown>
                    <x-slot name="trigger">
                        <img src="{{ $user['profile_picture'] ?? \App\Helpers\AvatarHelper::generateAvatar($user['name']) }}" class="w-10 h-10 rounded-full" alt="User" />
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profileUser.edit') }}">
                            <div class="flex items-center py-2 text-gray-600 transition hover:bg-gray-100">
                                <i class="material-icons-outlined">account_circle</i>
                                <span class="mx-2 text-sm font-medium">Profile</span>
                            </div>
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">
                                <div class="flex items-center py-2 text-gray-600 transition hover:bg-gray-100">
                                    <i class="material-icons-outlined ml-5">logout</i>
                                    <span class="mx-2 text-sm font-medium">Logout</span>
                                </div>
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
</nav>
@endif

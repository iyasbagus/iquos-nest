<nav class="flex justify-between mt-3 items-center px-10 py-4">

    <div class="w-full">
        <input type="text" placeholder="Search Here..."
            class="block mt-2 w-full placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
    </div>
    @if (Route::has('login'))
        <div class="flex items-center space-x-4">


            @auth
                {{-- <button><span class="material-icons-outlined">notifications</span></button>
                <a href="{{ route('profileUser.edit') }}"><img src="{{ $user['profile_picture'] ?? \App\Helpers\AvatarHelper::generateAvatar($user['name']) }}" class="w-10 h-10 rounded-full"
                        alt="User" /></a> --}}
            @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
</nav>
@endif

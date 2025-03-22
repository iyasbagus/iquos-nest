<nav class="flex justify-between pt-4 items-center px-14 py-4">
        <h1 class="text-xl font-bold">IQUOS Nest</h1>

        <ul class="hidden md:flex space-x-16">
            <li><a href="{{route('user.explore.listAssetView')}}" class="text-gray-700">Explore</a></li>
            <li><a href="#" class="text-gray-700">Creator</a></li>
            <li><a href="#" class="text-gray-700">About</a></li>
            <li><a href="#" class="text-gray-700">Blog</a></li>
        </ul>
        @if (Route::has('login'))
            <div class="flex items-center space-x-4">


                @auth
                    <button><span class="material-icons-outlined">notifications</span></button>
                    <a href="{{ route('profileUser.edit') }}"><img src="https://i.pravatar.cc/40"
                            class="w-10 h-10 rounded-full" alt="User" /></a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
    </nav>
    @endif

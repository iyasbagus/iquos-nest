<aside class="fixed top-0 left-0 h-full flex flex-col items-center w-16 py-8 overflow-y-auto bg-white border-r rtl:border-l rtl:border-r-0 dark:bg-gray-800 dark:border-gray-800">
    <nav class="flex flex-col flex-1 space-y-6">
        <a href="#">
            <img class="w-auto ml-1 h-7" src="{{ asset('images/iquosnest-logo.png') }}" alt="images">
        </a>

        <a href="{{url('')}}" class="p-1.5 text-gray-700 transition-colors duration-200 rounded-lg dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">
            <i class="material-icons-round">home</i>
        </a>
    </nav>


    <div class="flex flex-col space-y-6">
        <i class="p-1.5 material-icons-outlined">notifications</i>
        <a href="{{ route('profileUser.show') }}">
            <img class="object-cover w-8 h-8 rounded-full" src="{{ $user->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($user->name) }}" alt="" />
        </a>
    </div>
</aside>

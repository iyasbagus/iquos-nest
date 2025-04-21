<aside
    class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
    <a class="flex" href="{{url('')}}">
        <img class="w-auto h-9" src="{{asset('images/iquosnest-logo.png')}}" alt="">

        <span class="ml-4 mt-1 font-extrabold text-gray-800">IQUOS Nest <br>

        @role('creator')
        <span class="font-normal text-sm">Creator</span>

    </span>
    @endrole
    </a>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="flex-1 -mx-3 space-y-3 ">
            <div class="relative mx-3">

                <p class="text-gray-800 text-lg font-medium">Hi <span class="font-bold gradient-text">{{auth()->user()->name}} !!</span></p>
            </div>

            @role('admin')
            <div class="space-y-3">
                <label class="px-3 text-xs text-gray-500 uppercase">Admin Punya</label>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{ route('dashboard') }}">
                    <i class="material-icons-outlined">space_dashboard</i>

                    <span class="mx-2 text-sm font-medium">Dashboard</span>
                </a>

                <x-dropdown>

                    <x-slot name="trigger">
                        <button
                            class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"">
                            <i class="material-icons-outlined">table_chart</i>
                            <span class="mx-2 text-sm font-medium">Table Data</span>


                            <div class="ms-1 ml-24">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('category.index')">
                            {{ __('Category') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('tag.index')">
                            {{ __('Tag') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('adminAsset.index')">
                            {{ __('Asset') }}
                        </x-dropdown-link>
                    </x-slot>

                </x-dropdown>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('user.index')}}">
                    <i class="material-icons-outlined">manage_accounts</i>

                    <span class="mx-2 text-sm font-medium">User Accounts</span>
                </a>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('creator-applications.index')}}">
                    <i class="material-icons-outlined">workspace_premium</i>

                    <span class="mx-2 text-sm font-medium">Creator Applications</span>
                </a>

                 <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('subscription.index')}}">
                    <i class="material-icons-outlined">subscriptions</i>

                    <span class="mx-2 text-sm font-medium">Premium Features</span>
                </a>

            </div>
            @endrole

            <div class="space-y-3">

                <label class="px-3 text-xs text-gray-500 uppercase">Creator Punya</label>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('creator.dashboard')}}">
                    <i class="material-icons-outlined">dashboard</i>

                    <span class="mx-2 text-sm font-medium">Dashboard</span>
                </a>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('asset.index')}}">
                    <i class="material-icons-outlined">thumb_up</i>

                    <span class="mx-2 text-sm font-medium">Approve Assets</span>
                </a>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('asset.index')}}">
                    <i class="material-icons-outlined">cancel</i>

                    <span class="mx-2 text-sm font-medium">Reject Assets</span>
                </a>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('asset.index')}}">
                    <i class="material-icons-outlined">post_add</i>

                    <span class="mx-2 text-sm font-medium">Upload Assets</span>
                </a>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('asset.index')}}">
                    <i class="material-icons-outlined">notifications</i>

                    <span class="mx-2 text-sm font-medium">Notifications</span>
                </a>

            </div>

        </nav>

        <div class="mt-6">
            <div class="p-3 bg-gray-100 rounded-lg dark:bg-gray-800">
                <h2 class="text-sm font-medium text-gray-800 dark:text-white">New feature availabel!</h2>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Natus harum officia eligendi velit.</p>

                <img class="object-cover w-full h-32 mt-2 rounded-lg"
                    src="https://images.unsplash.com/photo-1658953229664-e8d5ebd039ba?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&h=1374&q=80"
                    alt="">
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="#" class="flex items-center gap-x-2">
                    <img class="object-cover rounded-full h-7 w-7"
                        src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&h=634&q=80"
                        alt="avatar" />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{auth()->user()->name}}</span>
                </a>

                <a href="{{route('logout')}}"
                    class="text-gray-500 transition-colors duration-200 rotate-180 dark:text-gray-400 rtl:rotate-0 hover:text-blue-500 dark:hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</aside>

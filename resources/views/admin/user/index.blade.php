<x-app-layout>
    <main>
        <div class="px-1 mt-5">
            <section class="container px-4 mx-auto">
                <div class="sm:flex sm:items-center sm:justify-between">

                    <div>
                        <div class="flex items-center gap-x-3">
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Users Data</h2>

                            <span
                                class="px-3 py-1 text-xs text-purple-600 bg-purple-200 rounded-full dark:bg-gray-800 dark:text-blue-400">{{$userTotal}}
                                User</span>
                        </div>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">This is the available User Data Accounts.</p>
                    </div>
                </div>

                <div class="mt-6 md:flex md:items-center md:justify-between">

                    <div
                        class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                        {{-- <button
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-white sm:text-sm dark:bg-gray-800 dark:text-gray-300"><a
                                href="{{ route('subscription.create') }}">Add Subscription</a>
                        </button> --}}
                        {{-- <button @click="addModal = true"
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-white sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                            Add Subscription
                        </button> --}}
                    </div>

                    <div class="relative flex items-center mt-4 md:mt-0">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </span>

                        <input type="text" placeholder="Search"
                            class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                    </div>
                </div>


                <div class="flex flex-col mt-6">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-white dark:bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <button class="flex items-center gap-x-3 focus:outline-none">
                                                    <span>No</span>
                                                </button>
                                            </th>

                                            <th scope="col"
                                                class="px-7 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Profile
                                            </th>

                                            <th scope="col"
                                                class="px-7 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Name</th>

                                            <th scope="col"
                                                class="px-7 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Email</th>

                                            <th scope="col"
                                                class="px-7 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Role</th>
                                            <th scope="col"
                                                class="px-7 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Action</th>

                                        </tr>
                                    </thead>
                                    @php

                                        $no = 1;

                                    @endphp
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @foreach ($user as $item)
                                            <tr>
                                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->id }}</h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            <img src="{{ $item->profile_picture ?? \App\Helpers\AvatarHelper::generateAvatar($item->name) }}" class="w-8 h-8 rounded-full">
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->name }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->email}}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->getRoleNames()->first() }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <button
                                                            class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 mr-4 text-xs font-medium text-indigo-600 ring-1 ring-indigo-500/10 ring-inset">Edit</button>
                                                        <button
                                                            class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 mr-4 text-xs font-medium text-yellow-600 ring-1 ring-yellow-500/10 ring-inset">Show</button>
                                                        <form action="#"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button
                                                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs
                                                        font-medium text-red-600 ring-1 ring-red-500/10 ring-inset"
                                                                type="submit"
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Page <span class="font-medium text-gray-700 dark:text-gray-100">1 of 10</span>
                    </div>

                    <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                        <a href="#"
                            class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                            </svg>

                            <span>
                                previous
                            </span>
                        </a>

                        <a href="#"
                            class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                            <span>
                                Next
                            </span>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        </div>

        {{-- <script>
            function planModal() {
                return {
                    addModal: false,
                    showModal: false,
                    editModal: false,
                    plans: {}, // Data plan yang ditampilkan atau diedit
                    newPlan: {
                        name: '',
                        price: '',
                        duration: '',
                        max_downloads: '',
                        revenue_share_percentage: '',
                        features: [],
                    },
                    showPlan(plans) {
                        this.plans = plans;
                        this.showModal = true;
                        // features: Array.isArray(plans.features) ? plans.features : plans.features.split(', ')
                    },
                    editPlan(plans) {
                        this.plans = plans;
                        this.editModal = true;
                        // features: Array.isArray(plans.features) ? plans.features : plans.features.split(', ')
                    },
                    closeModal() {
                        this.addModal = false;
                        this.showModal = false;
                        this.editModal = false;
                        this.plans = {};
                    },
                };
            }
        </script> --}}

    </main>
</x-app-layout>

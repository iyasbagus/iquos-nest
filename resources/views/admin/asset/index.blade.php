<x-app-layout>
    <main>
        <div class="px-1 mt-5">
            <section class="container px-4 mx-auto">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center gap-x-3">
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Assets</h2>

                            <span
                                class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                                vendors</span>
                        </div>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in
                            the last 12 months.</p>
                    </div>
                </div>

                <div class="mt-6 md:flex md:items-center md:justify-between">

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
                                                Title
                                            </th>

                                            <th scope="col"
                                                class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Thumbnail</th>

                                            <th scope="col"
                                                class="px-10 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Creator</th>

                                            <th scope="col"
                                                class="px-14 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Licences</th>

                                            <th scope="col"
                                                class="px-10 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Status</th>

                                            <th scope="col"
                                                class="px-10 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    @php

                                        $no = 1;

                                    @endphp
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @foreach ($asset as $item)
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
                                                            {{ \Illuminate\Support\Str::limit($item->title, 11, '...') }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                                                            src="{{ asset('admin/images/asset/' . $item->thumbnail_url) }}"
                                                            alt="">
                                                    </div>
                                                </td>
                                                <td class="px-9 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->creator->name }}</h2>
                                                    </div>
                                                </td>
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="inline px-3 py-1 text-sm font-normal
                                                            {{ $item->is_premium_only ? 'text-yellow-600 bg-yellow-100' : 'text-green-600 bg-green-100' }}
                                                            rounded-full dark:text-gray-400 gap-x-2 dark:bg-gray-800">
                                                        {{ $item->is_premium_only ? 'Free' : 'Premium' }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="inline px-3 py-1 text-sm font-normal text-gray-500 bg-gray-100 rounded-full dark:text-gray-400 gap-x-2 dark:bg-gray-800">
                                                        @if ($item->status == 'pending')
                                                            <span class="text-yellow-500">Pending</span>
                                                        @elseif ($item->status == 'active')
                                                            <span class="text-green-500">Approved</span>
                                                        @else
                                                            <span class="text-red-500">Rejected</span>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="absolute px-10 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div x-data="{ isOpen: false }" class="relative inline-block ">
                                                        <!-- Dropdown toggle button -->
                                                        <button @click="isOpen = !isOpen"
                                                            class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path
                                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                            </svg>
                                                        </button>

                                                        <!-- Dropdown menu -->
                                                        <div x-show="isOpen" @click.away="isOpen = false"
                                                            x-transition:enter="transition ease-out duration-100"
                                                            x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="transition ease-in duration-100"
                                                            x-transition:leave-start="opacity-100 scale-100"
                                                            x-transition:leave-end="opacity-0 scale-90"
                                                            class="absolute right-0 z-20 w-40 py-2 mt-2 origin-top-left bg-white rounded-md shadow-xl dark:bg-gray-800">
                                                            @if ($item->status == 'pending')
                                                                <form
                                                                    class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-emerald-300 dark:hover:bg-gray-700 dark:hover:text-white"
                                                                    action="{{ route('admin.asset.active', $item->id) }}"
                                                                    method="POST"> @csrf @method('PUT')

                                                                    <i class="material-icons-outlined">task_alt</i>

                                                                    <button class="ml-2" type="submit">Active</button>
                                                                </form>

                                                                <form
                                                                    class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-red-300 dark:hover:bg-gray-700 dark:hover:text-white"
                                                                    action="{{ route('admin.asset.rejected', $item->id) }}"
                                                                    method="POST"> @csrf @method('PUT')

                                                                    <i class="material-icons-outlined">highlight_off</i>

                                                                    <button class="ml-2" type="submit">Rejected</button>
                                                                </form>
                                                            @endif
                                                            <a href="{{route('adminAsset.show', $item->id)}}"
                                                                    class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">

                                                                    <i class="material-icons-outlined">info</i>

                                                                    <span class="mx-1">
                                                                        Show Data
                                                                    </span>
                                                                </a>

                                                                <form action="{{route('adminAsset.destroy', $item->id)}}" method="POST" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"">
                                                                    @method('DELETE')
                                                                    @csrf

                                                                    <i class="material-icons-outlined">delete</i>

                                                                    <button class="ml-2" type="submit">Delete Data</button>
                                                                </form>
                                                        </div>
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
    </main>
</x-app-layout>

<x-app-layout>
    <main>
        <div class="px-1 mt-5">

            @if ($errors->has('name'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-[-10px]" class="absolute top-20 right-4 z-50">

                    <div class="flex w-full max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-hidden">
                        <div class="flex items-center justify-center w-12 bg-red-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
                            </svg>
                        </div>

                        <div class="px-4 py-2">
                            <div class="text-red-500 font-semibold">Error</div>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $errors->first('name') }}
                            </p>
                        </div>
                    </div>
                </div>
            @elseif(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-[-10px]" class="absolute top-20 right-4 z-50">

                    <div class="flex w-full max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-hidden">
                        <div class="flex items-center justify-center w-12 bg-emerald-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                            </svg>
                        </div>

                        <div class="px-4 py-2">
                            <div class="text-emerald-500 font-semibold">Success</div>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <section class="container px-4 mx-auto">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center gap-x-3">
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Tags</h2>

                            <span
                                class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                                vendors</span>
                        </div>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in
                            the last 12 months.</p>
                    </div>
                </div>

                <div class="px-1 mt-6 p-6 ">
                    <h2 class="text-xl font-semibold mb-4">Create Tags</h2>

                    <div class="grid grid-flow-col grid-rows-2 gap-4">
                        <!-- Left Section: Search and Tags -->
                        <div class="row-span-2 w-12/12 p-6 bg-white rounded-lg shadow-md">
                            <!-- Search Bar -->
                            <div class="relative flex items-center mt-4 mb-4 md:mt-0">
                                <span class="absolute">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </span>

                                <input type="text" placeholder="Search"
                                    class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-500 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                            </div>

                            <!-- Tags List -->
                            <div class="border p-4 rounded-lg">
                                @php $no = 1; @endphp
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($tag as $item)
                                        <span
                                            class="flex px-3 py-1 text-sm font-normal text-gray-500 bg-gray-100 rounded-full dark:text-gray-400 gap-x-2 dark:bg-gray-800"">
                                            {{ $item->name }}

                                            <form action="{{route('tag.destroy', $item->slug)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="text-red-500">&times;</button>
                                            </form>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Add Tag Form -->
                        <div class="row-span-1 p-6 bg-white rounded-lg shadow-md">
                            <form action="{{ route('tag.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="name" class="block text-sm font-medium mb-1">Add Tag</label>
                                <input type="text" name="name" id="name" placeholder="Add New Tags"
                                    class="w-full p-2 border rounded mb-2" />
                                <div class="flex gap-2 mt-3">
                                    <button type="submit"
                                        class="px-3 py-1 bg-gray-800 text-white rounded">Submit</button>
                                    <button type="reset" class="px-3 py-1 bg-white border rounded">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
</x-app-layout>

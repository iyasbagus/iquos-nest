<x-app-layout>
    <main x-data="planModal()">
        <div class="px-1 mt-5">
            <section class="container px-4 mx-auto">
                <div class="sm:flex sm:items-center sm:justify-between">

                    <div>
                        <div class="flex items-center gap-x-3">
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Subscription Plans</h2>

                            <span
                                class="px-3 py-1 text-xs text-purple-600 bg-purple-200 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                                vendors</span>
                        </div>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">This is the available subscription
                            package data.</p>
                    </div>
                </div>

                <div class="mt-6 md:flex md:items-center md:justify-between">

                    <div
                        class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                        {{-- <button
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-white sm:text-sm dark:bg-gray-800 dark:text-gray-300"><a
                                href="{{ route('subscription.create') }}">Add Subscription</a>
                        </button> --}}
                        <button @click="addModal = true"
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-white sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                            Add Subscription
                        </button>
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
                                                Name
                                            </th>

                                            <th scope="col"
                                                class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Price</th>

                                            <th scope="col"
                                                class="px-7 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Duration</th>

                                            <th scope="col"
                                                class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Max Downloads</th>

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
                                        @foreach ($plans as $item)
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
                                                            {{ $item->name }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->price }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->duration }} Month
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-7 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->max_downloads }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <button @click="editPlan({{ $item }})"
                                                            class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 mr-4 text-xs font-medium text-indigo-600 ring-1 ring-indigo-500/10 ring-inset">Edit</button>
                                                        <button @click="showPlan({{ $item }})"
                                                            class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 mr-4 text-xs font-medium text-yellow-600 ring-1 ring-yellow-500/10 ring-inset">Show</button>
                                                        <form action="{{ route('subscription.destroy', $item->id) }}"
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

                <div x-show="addModal" x-transition:enter="transition ease-out duration-100" x-cloak
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-30">

                    <section @click.away="addModal = false"
                        class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
                        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Subscription Plans
                        </h2>

                        <form action="{{ route('subscription.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="name">Package
                                        Name</label>
                                    <input id="name" name="name" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="price">Price (IDR)</label>
                                    <input id="price" name="price" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="duration">Duration
                                        (Month)</label>
                                    <input id="duration" name="duration" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="max_downloads">Max
                                        Downloads</label>
                                    <input id="max_downloads" name="max_downloads" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="revenue_share_percentage">Revenue Share
                                        (%)</label>
                                    <input id="revenue_share_percentage" name="revenue_share_percentage"
                                        type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200">Subscription
                                        Features</label>
                                    <div id="feature-list">
                                        <input name="features[]" type="text"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button
                                    class="mr-3 px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                                <button type="button"
                                    class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                                    onclick="addFeature()">Add Feature</button>
                            </div>

                        </form>
                    </section>

                    <script>
                        function addFeature() {
                            let featureList = document.getElementById('feature-list');
                            let input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'features[]';
                            input.classList.add('block', 'w-full', 'px-4', 'py-2', 'mt-2', 'text-gray-700', 'bg-white', 'border',
                                'border-gray-200', 'rounded-md', 'dark:bg-gray-800', 'dark:text-gray-300', 'dark:border-gray-600');
                            input.placeholder = 'Masukkan fitur';
                            featureList.appendChild(input);
                        }
                    </script>

                </div>

                <div x-show="showModal" x-transition:enter="transition ease-out duration-100" x-cloak
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center z-50">

                    <section @click.away="showModal = false">
                        <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                            <div
                                class="rounded-2xl bg-white border border-indigo-600 p-6 ring-1 shadow-xs ring-indigo-600 sm:order-last sm:px-8 lg:p-12">
                                <div class="text-center">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        <span x-text="plans.name"></span>
                                    </h2>

                                    <p class="mt-2 sm:mt-4">
                                        <strong class="text-3xl font-bold text-gray-900 sm:text-4xl">
                                            <span x-text="plans.price"></span>
                                        </strong>

                                        <span class="text-sm font-medium text-gray-700">/
                                            <span x-text="plans.duration"></span> Month
                                        </span>
                                    </p>
                                </div>

                                <ul class="mt-6 space-y-2">
                                    <template x-for="(feature, index) in [...new Set(plans.features)]" :key="index">
                                        <li class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-5 text-indigo-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>

                                            <span class="text-gray-700"
                                                x-text="feature.feature"></span>
                                        </li>
                                    </template>
                                </ul>

                                {{-- <a href="#"
                                        class="mt-8 block rounded-full border border-indigo-600 bg-indigo-600 px-12 py-3 text-center text-sm font-medium text-white hover:bg-indigo-700 hover:ring-1 hover:ring-indigo-700 focus:ring-3 focus:outline-hidden">
                                        Get Started
                                    </a> --}}
                            </div>
                        </div>

                    </section>

                </div>

                <div x-show="editModal" x-transition:enter="transition ease-out duration-300" x-cloak
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-30">

                    <section @click.away="editModal = false"
                        class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
                        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Subscription Plans
                        </h2>

                        <form :action="`/admin/subscription/${plans.id}`"  method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" x-model="plans.id">
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="name">Package
                                        Name</label>
                                    <input id="name" name="name" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" x-model="plans.name">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="price">Price (IDR)</label>
                                    <input id="price" name="price" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" x-model="plans.price">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="duration">Duration
                                        (Month)</label>
                                    <input id="duration" name="duration" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" x-model="plans.duration">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="max_downloads">Max
                                        Downloads</label>
                                    <input id="max_downloads" name="max_downloads" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" x-model="plans.max_downloads">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="revenue_share_percentage">Revenue Share
                                        (%)</label>
                                    <input id="revenue_share_percentage" name="revenue_share_percentage"
                                        type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" x-model="plans.revenue_share_percentage">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200">Subscription
                                        Features</label>
                                    <div id="feature-list-edit">
                                        <template x-for="(feature, index) in plans.features" :key="index"">
                                            <input name="features[]" type="text"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"  x-model="feature.feature">
                                        </template>
                                        </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                    class="mr-3 px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                                <button type="button"
                                    class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                                    onclick="addFeatureEdit()">Add Feature</button>
                            </div>

                        </form>
                    </section>

                    <script>
                        function addFeatureEdit() {
                            let featureList = document.getElementById('feature-list-edit');
                            let input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'features[]';
                            input.classList.add('block', 'w-full', 'px-4', 'py-2', 'mt-2', 'text-gray-700', 'bg-white', 'border',
                                'border-gray-200', 'rounded-md', 'dark:bg-gray-800', 'dark:text-gray-300', 'dark:border-gray-600');
                            input.placeholder = 'Masukkan fitur';
                            featureList.appendChild(input);
                        }
                    </script>

                </div>

            </section>
        </div>

        <script>
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
        </script>

    </main>
</x-app-layout>

    <x-app-layout>

        <main x-data="applyModal()">
            <section class="container px-4 mx-auto">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center gap-x-3">
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Creator Application</h2>

                            <span
                                class="px-3 py-1 text-xs text-purple-600 bg-purple-200 rounded-full dark:bg-gray-800 dark:text-blue-400">50
                                data</span>
                        </div>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">This is the available application data.
                        </p>
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
                                                class="py-3.5 px-12 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <button class="flex items-center gap-x-3 focus:outline-none">
                                                    <span>User</span>
                                                </button>
                                            </th>

                                            <th scope="col"
                                                class="px-5 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Status
                                            </th>

                                            <th scope="col"
                                                class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Date
                                            </th>

                                            <th scope="col"
                                                class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    @php $no = 1; @endphp
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @foreach ($applications as $app)
                                            <tr>
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $app->user->name }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="py-1 text-xs text-center rounded-full {{ $app->status === 'approved'
                                                            ? 'bg-green-100 text-green-800'
                                                            : ($app->status === 'rejected'
                                                                ? 'bg-red-100 text-red-800'
                                                                : 'bg-yellow-100 text-yellow-800') }}">
                                                        {{ ucfirst($app->status) }}

                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div>
                                                        <h4 class="text-gray-700 dark:text-gray-200">
                                                            {{ $app->created_at->format('d M Y') }}
                                                        </h4>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <button @click="editApply({{ $app }})"
                                                            class="px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:relative"
                                                            aria-label="Edit">
                                                            <i data-lucide="pencil" class="w-5 h-5"></i>
                                                        </button>

                                                        <button
                                                            @click="showApply({{ json_encode($app) }}, '{{ $app->getFirstMediaUrl('preview_images') }}')"
                                                            class="px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:relative">
                                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                                        </button>


                                                        <button type="button"
                                                            class="px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:relative"
                                                            aria-label="Delete">
                                                            <i data-lucide="trash" class="w-5 h-5"></i>
                                                        </button>
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

                {{-- Show Modal --}}
                <div x-show="showModal" @keydown.escape.window="closeModal()"
                    x-transition:enter="transition ease-out duration-100" x-cloak
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center z-50 ml-10 ">

                    <section>


                        <article class="rounded-xl border border-gray-700 bg-white p-4">
                            <div class="flex items-center gap-4">
                                <img alt=""
                                    :src="applys.user.profile_picture ??
                                        '{{ \App\Helpers\AvatarHelper::generateAvatar('') }}' +
                                        applys.user.name"
                                    class="size-16 rounded-full object-cover" />

                                <div>
                                    <h3 class="text-lg font-medium text-gray-700" x-text="applys.user.name"></h3>

                                    <div class="flow-root">
                                        <ul class="-m-1 flex flex-wrap">
                                            <li class="p-1 leading-none">
                                                <a :href="applys.portfolio_link" x-text="applys.portfolio_link"
                                                    class="text-xs font-medium text-gray-700"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex overflow-x-auto mt-5 overflow-y-hidden border-b border-gray-200 whitespace-nowrap dark:border-gray-700">
                                <button
                                    class="inline-flex items-center h-10 px-4 -mb-px text-sm text-center text-blue-600 bg-transparent border-b-2 border-blue-500 sm:text-base dark:border-blue-400 dark:text-blue-300 whitespace-nowrap focus:outline-none">
                                    Description
                                </button>

                                <button
                                    class="inline-flex items-center h-10 px-4 -mb-px text-sm text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:text-base dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">
                                    Assets
                                </button>

                                <button
                                    class="inline-flex items-center h-10 px-4 -mb-px text-sm text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:text-base dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">
                                    File
                                </button>
                            </div>

                            <ul class="mt-4 space-y-2">
                                <li>
                                    <a href="#"
                                        class="block h-full rounded-lg border border-gray-700 p-4 hover:border-pink-600">
                                        <strong class="font-medium text-white"></strong>

                                        <img :src="assetImage" alt="Asset" class="w-96">

                                    </a>

                                    <div x-show="applys.status === 'pending'" class="mt-5">
                                        <form
                                            class="flex items-center p-3 text-sm text-gray-600 rounded-lg capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-emerald-300 dark:hover:bg-gray-700 dark:hover:text-white"
                                            :action="`/admin/creator-applications/${applys.id}/approve`"
                                            method="POST"> @csrf
                                            @method('PUT')

                                            <i class="material-icons-outlined">task_alt</i>

                                            <button class="ml-2" type="submit">Active</button>
                                        </form>

                                        <div
                                            class="flex items-center p-3 text-sm text-gray-600 rounded-lg capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-red-300 dark:hover:bg-gray-700 dark:hover:text-white">

                                            <i class="material-icons-outlined">highlight_off</i>

                                            <button type="button" @click="showReject()"
                                                class="ml-2">Reject</button>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </article>
                    </section>
                </div>

                {{-- show modal input reject --}}
                <div x-show="showModalReject" x-transition:enter="transition ease-out duration-100" x-cloak
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="fixed inset-0 flex items-center justify-center z-50 ml-10">

                    <section @click.away="showModalReject = false">
                        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
                            <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Reject Reason
                            </h2>
                            <form :action="`/admin/creator-applications/${applys.id}/reject`" method="POST">
                                @csrf
                                @method('PUT')
                                <div>
                                    <div>
                                        <label for="Description"
                                            class="block text-sm text-gray-500 dark:text-gray-300">Description</label>

                                        <textarea placeholder="lorem..." name="rejection_reason" id="rejection_reason"
                                            class="block  mt-2 w-full  placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-4 h-32 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300"></textarea>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="submit"
                                        class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save<button>

                                </div>
                            </form>
                        </section>
                    </section>
                </div>

            </section>

            <script>
                function applyModal() {
                    return {
                        addModal: false,
                        showModal: false,
                        editModal: false,
                        showModalReject: false,
                        assetImage: '',
                        applys: {},
                        showApply(applys, preview_images) {
                            this.applys = applys;
                            this.showModal = true;
                            this.assetImage = preview_images;
                        },
                        showReject() {
                            this.showModalReject = true;
                        },
                        editPlan(applys) {
                            this.applys = applys;
                            this.editModal = true;
                        },
                        closeModal() {
                            this.addModal = false;
                            this.showModal = false;
                            this.editModal = false;
                            this.applys = {};
                        },
                    };
                }
            </script>

        </main>

    </x-app-layout>

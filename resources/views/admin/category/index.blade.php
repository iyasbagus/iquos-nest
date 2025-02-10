<x-app-layout>
    <!-- Page Content -->
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
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Category</h2>

                            <span
                                class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                                vendors</span>
                        </div>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in
                            the last 12 months.</p>
                    </div>
                </div>

                <div class="mt-6 md:flex md:items-center md:justify-between">
                    <div
                        class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                        <button @click="addModal = true"
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-white sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                            Add Category
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
                                                    <span>Category</span>
                                                </button>
                                            </th>

                                            <th scope="col"
                                                class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Slug Name
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Description
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Images</th>

                                            <th scope="col"
                                                class="px-20 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    @php $no = 1; @endphp
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @foreach ($category as $item)
                                            <tr>
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800 dark:text-white ">
                                                            {{ $item->name }}</h2>
                                                    </div>
                                                </td>
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="inline px-3 py-1 text-sm font-normal text-gray-500 bg-gray-100 rounded-full dark:text-gray-400 gap-x-2 dark:bg-gray-800">
                                                        {{ $item->slug }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div>
                                                        <h4 class="text-gray-700 dark:text-gray-200">
                                                            {{ $item->description }}
                                                        </h4>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                                                            src="{{ asset('admin/images/category/' . $item->images) }}"
                                                            alt="">
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <button @click="editCategory({{ $item }})"
                                                            class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 mr-4 text-xs font-medium text-indigo-600 ring-1 ring-indigo-500/10 ring-inset">Edit</button>
                                                        <button @click="showCategory({{ $item }})"
                                                            class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 mr-4 text-xs font-medium text-yellow-600 ring-1 ring-yellow-500/10 ring-inset">Show</button>
                                                        <form action="{{ route('category.destroy', $item->slug) }}"
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
    </main>

    {{-- Modal Add Data --}}
    <div x-show="addModal" x-transition:enter="transition duration-300 ease-out" x-cloak
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-10 overflow-y-auto bg-black bg-opacity-30" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div @click="closeModal" class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

            <div @click.stop
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle">
                <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    Add Category
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Your new <b>Category</b> has been created. Invite your
                    team to collaborate on this project.
                </p>

                <form class="mt-4" action="{{ route('category.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="name" class="form-label text-sm text-gray-700 dark:text-gray-200">
                        Category Name
                    </label>

                    <label class="form-label block mt-3">
                        <input type="text" name="name" id="name" placeholder="Input Category Name"
                            class="form-control block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                    </label>

                    <label for="description" class="text-sm text-gray-700 dark:text-gray-200">
                        Description
                    </label>

                    <label class="block mt-3">
                        <input type="text" name="description" id="description" placeholder="Input Description"
                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                    </label>

                    <label class="block mt-3">
                        <input type="file" placeholder="Input" name="images" id="images"
                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                    </label>

                    <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                        <button type="button" @click="closeModal"
                            class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                            Cancel
                        </button>

                        <button type="submit"
                            class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            Submit Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Add Data --}}

    {{-- Modal Show Data --}}
    <div x-show="showModal" x-cloak x-transition:enter="transition duration-300 ease-out" x-cloak
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block p-4 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl sm:max-w-sm rounded-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:p-6">
                <div class="flex items-center justify-center mx-auto">
                    <img class="h-full rounded-lg" :src="'/admin/images/category/' + category.images">
                </div>

                <div class="mt-5 text-center">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white"><span x-text="category.name"></span>
                    </h3>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        <span x-text="category.description"></span>
                    </p>
                </div>

                <div class="mt-4 sm:flex sm:items-center sm:justify-between sm:mt-6 sm:-mx-2">
                    <button @click="closeModal"
                        class="px-4 sm:mx-2 w-full py-2.5 text-sm font-medium dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show Data --}}

    {{-- Modal Edit Data --}}
    <div x-show="editModal" x-transition:enter="transition duration-300 ease-out" x-cloak
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

            <div
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle">
                <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    Edit Category
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Your new <b>Category</b> has been created. Invite your
                    team to collaborate on this project.
                </p>

                <form x-bind:action="'/admin' + '/category/' + category.slug" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" x-model="category.id">
                    <label for="name" class="form-label text-sm text-gray-700 dark:text-gray-200">
                        Category Name
                    </label>

                    <label class="form-label block mt-3">
                        <input type="text" name="name" id="name" placeholder="Input Category Name"
                            x-model="category.name"
                            class="form-control block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                    </label>

                    <label for="description" class="text-sm text-gray-700 dark:text-gray-200">
                        Description
                    </label>

                    <label class="block mt-3">
                        <input type="text" name="description" id="description" placeholder="Input Description"
                            x-model="category.description"
                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                    </label>

                    <label class="block mt-3">
                        <input type="file" placeholder="Input" name="images" id="images"
                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                    </label>

                     <img :src="'/admin/images/category/' + category.images" class="mt-3" width="100">

                    <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                        <button type="button" @click="closeModal"
                            class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                            Cancel
                        </button>

                        <button type="submit"
                            class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            Submit Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Data --}}

    <script>
        function categoryModal() {
            return {
                addModal: false,
                showModal: false,
                editModal: false,
                category: {},
                newCategory: {
                    name: '',
                    description: '',
                    images: null,
                },
                showCategory(category) {
                    this.category = category;
                    this.showModal = true;
                },
                editCategory(category) {
                    this.category = {
                        ...category
                    };
                    this.editModal = true;
                },
                closeModal() {
                    this.addModal = false;
                    this.showModal = false;
                    this.editModal = false;
                    this.category = {};
                },
                // async updateCategory() {
                //     try {
                //         // Kirim data dengan Fetch API atau Axios
                //         const response = await fetch(`/categories/${this.category.id}`, {
                //             method: 'PUT',
                //             headers: {
                //                 'Content-Type': 'application/json',
                //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                //             },
                //             body: JSON.stringify(this.category),
                //         });

                //         if (response.ok) {
                //             alert('Category updated successfully!');
                //             location.reload(); // Refresh halaman
                //         } else {
                //             alert('Failed to update category.');
                //         }
                //     } catch (error) {
                //         console.error(error);
                //         alert('An error occurred.');
                //     }
                // },
            };
        }
    </script>
</x-app-layout>

@extends('layouts.user-explore')

@section('content-explore')
    <main x-data="isOpenAsset()">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <!-- Kategori -->
        <section class="flex justify-center items-center">
            <div class="flex space-x-9">
                @foreach ($category as $item)
                    <button
                        class="px-4 py-2 rounded-full bg-gray-200 text-black font-medium dark:text-white dark:bg-gray-800">{{ $item->name }}</button>
                @endforeach
            </div>
        </section>

        <!-- Grid Asset -->
        <section class="px-5 mt-10">
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
            @if($asset->isEmpty())
                <p class="text-center">Asset Belum Ada</p>
                @else

                @foreach ($asset as $item)
                    <div class="mb-4 rounded-xl overflow-hidden group break-inside-avoid">
                        <div class="relative">
                            <!-- Tombol Buka Modal -->
                            <button
                                @click="showAsset({{ json_encode($item) }}, '{{ $item->getFirstMediaUrl('images') }}'); document.body.classList.add('overflow-hidden')">
                                <img src="{{ $item->getFirstMediaUrl('images') }}" alt="Feed Image"
                                    class="w-full h-auto rounded-xl transition duration-300 group-hover:brightness-50">
                            </button>

                            <!-- Tombol Hover -->
                            <button
                                class="absolute top-3 right-3 bg-purple-500 text-white px-3 py-1 text-sm font-semibold rounded-lg shadow opacity-0 group-hover:opacity-100 transition duration-300">
                                Simpan
                            </button>

                            <button
                                class="absolute bottom-3 left-3 px-3 py-1 text-sm font-semibold rounded-lg shadow opacity-0 group-hover:opacity-100 transition duration-300 {{ $item->is_premium_only ? 'text-yello-600 bg-yellow-100' : 'text-gray-700 bg-gray-100' }}">
                                {{ $item->is_premium_only ? 'Premium' : 'Free' }}
                            </button>
                        </div>

                        <!-- Info Asset -->
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">{{ $item->title }}</h3>
                            <div class="flex items-center mt-1">
                                <img src="{{ $item->creator->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($item->creator['name']) }}"
                                    alt="Profile" class="w-6 h-6 rounded-full mr-2">
                                <span
                                    class="text-sm text-gray-700 font-semibold dark:text-white">{{ $item->creator->name ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif




            <!-- Modal -->
            <div x-show="showModal" @keydown.escape.window="closeModal()" x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-[72rem] h-[96vh] overflow-auto dark:bg-gray-800">
                    <!-- Header Modal -->
                    <div class="flex justify-between items-center border-b pb-2 bg-white dark:bg-gray-800">
                        <div class="flex items-center">
                            <a :href="`/creator/${asset.creator.username}`">
                                <img :src="asset.creator.profile_picture"
                                    alt="User" class="rounded-full w-10 h-10">
                            </a>
                            <div class="ml-3">
                                <p class="text-sm font-semibold" x-text="asset.creator.name"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="flex gap-2 border border-gray-800 text-gray-800 px-4 py-1 rounded-md hover:bg-gray-800 hover:text-white transition dark:border-white dark:text-white dark:hover:bg-white dark:hover:text-gray-800">
                                <span>Share</span>
                                <span class="material-icons-outlined text-lg">share</span>
                            </button>
                            <button
                                class="flex gap-2 border border-gray-800 text-gray-800 px-4 py-1 rounded-md hover:bg-gray-800 hover:text-white transition dark:border-white dark:text-white dark:hover:bg-white dark:hover:text-gray-800"><a
                                    :href="'{{ route('download.assets') }}?modelId=' + asset.id + '&collection=assets'">
                                    <span class="flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="size-4 mt-1">
                                            <path d="M12 3v14"></path>
                                            <path d="m6 12 6 6 6-6"></path>
                                            <path d="M5 21h14"></path>
                                        </svg> Download
                                    </span>
                                </a>
                            </button>

                            <x-dropdown>

                                <x-slot name="trigger">

                                    <button type="button" class="px-4 py-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>

                                </x-slot>

                                <x-slot name="content">

                                    <x-dropdown-link
                                        x-bind:href="'{{ route('download.image') }}?modelId=' + asset.id + '&collection=images'">
                                        Original Size
                                    </x-dropdown-link>
                                    <x-dropdown-link
                                        x-bind:href="'{{ route('download.image') }}?modelId=' + asset.id + '&collection=images' +
                                            '&size=small'">
                                        Small 300 x 300
                                    </x-dropdown-link>
                                    <x-dropdown-link
                                        x-bind:href="'{{ route('download.image') }}?modelId=' + asset.id + '&collection=images' +
                                            '&size=medium'">
                                        Medium 600 x 600
                                    </x-dropdown-link>
                                    <x-dropdown-link
                                        x-bind:href="'{{ route('download.image') }}?modelId=' + asset.id + '&collection=images' +
                                            '&size=large'">
                                        Large 1000 x 1000
                                    </x-dropdown-link>

                                </x-slot>

                            </x-dropdown>

                        </div>
                    </div>

                    <!-- Konten Modal -->
                    <div class="mt-4">
                        <img :src="modalImage" alt="Image" class="rounded-lg px-28">

                        <div class="mt-6 text-xl font-bold">
                            <span x-text="asset.title"></span>
                        </div>
                        <div x-data="{ expanded: false, maxLength: 100 }" class="mt-2 text-sm w-1/2 font-normal">
                            <span
                                x-text="expanded ? asset.description : asset.description.substring(0, maxLength) + (asset.description.length > maxLength ? '...' : '')"></span>

                            <button x-show="asset.description.length > maxLength" @click="expanded = !expanded"
                                class="text-blue-500">
                                <span x-text="expanded ? 'Show Less' : 'Show More'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Footer Modal -->
                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <template x-for="item in asset.tags" :key="item.name">
                                <span class="bg-gray-200 px-2 py-1 text-sm rounded dark:bg-gray-700"
                                    x-text="item.name"></span>
                            </template>
                        </div>

                    </div>
                </div>
            </div>

            <button x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
                @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode); darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
                class="fixed bottom-10 right-10 size-16 p-2 bg-gray-200 dark:bg-gray-800 rounded-full">
                <span x-show="!darkMode" class="material-icons-outlined">light_mode</span>
                <span x-show="darkMode" class="material-icons-outlined">dark_mode</span>
            </button>

            <!-- Alpine.js -->
            <script>
                function isOpenAsset() {
                    return {
                        showModal: false,
                        modalImage: '',
                        asset: {
                            tags: []
                        },
                        showAsset(asset, image) {
                            console.log(asset); // Debug asset di console browser
                            console.log(image); // Debug image URL
                            this.modalImage = image;
                            this.asset = asset;
                            this.showModal = true;
                            document.body.classList.add('overflow-hidden');
                        },
                        closeModal() {
                            this.showModal = false;
                            this.modalImage = '';
                            this.asset = {};
                            document.body.classList.remove('overflow-hidden');
                        },
                    };
                }
            </script>
        </section>

        @if($asset->isEmpty())

        @else
        <section class="mt-10">
            <ul class="flex justify-center gap-1 text-gray-900">
                <li>
                    <a href="#"
                        class="grid size-8 place-content-center rounded border border-gray-200 transition-colors hover:bg-gray-50 rtl:rotate-180"
                        aria-label="Previous page">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="block size-8 rounded border border-gray-200 text-center text-sm/8 font-medium transition-colors hover:bg-gray-50">
                        1
                    </a>
                </li>

                <li
                    class="block size-8 rounded border border-indigo-600 bg-indigo-600 text-center text-sm/8 font-medium text-white">
                    2
                </li>

                <li>
                    <a href="#"
                        class="block size-8 rounded border border-gray-200 text-center text-sm/8 font-medium transition-colors hover:bg-gray-50">
                        3
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="block size-8 rounded border border-gray-200 text-center text-sm/8 font-medium transition-colors hover:bg-gray-50">
                        4
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="grid size-8 place-content-center rounded border border-gray-200 transition-colors hover:bg-gray-50 rtl:rotate-180"
                        aria-label="Next page">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ul>
        </section>
         @endif
    </main>
@endsection

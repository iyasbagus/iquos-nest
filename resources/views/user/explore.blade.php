@extends('layouts.user-explore')

@section('content-explore')
    <main x-data="isOpenAsset()">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Kategori -->
        <div class="px-6 py-1 border-b dark:border-gray-700">
            <div class="flex overflow-x-auto scrollbar-hide">

                <a href="#"
                    class="relative py-4 px-6 text-purple-600 font-medium whitespace-nowrap border-b-2 border-purple-600 dark:border-purple-300 dark:text-purple-300">
                    Latest
                    <span class="absolute top-3 -right-1 w-2 h-2 bg-purple-600 rounded-full dark:bg-purple-300"></span>
                </a>
                <a href="#" class="relative py-4 px-6 text-gray-600 font-medium whitespace-nowrap">
                    Popular
                    <span class="absolute top-3 -right-1 w-2 h-2 rounded-full"></span>
                </a>

            </div>
        </div>

        <!-- Grid Asset -->
        <section class="px-5 mt-10">
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
                @if ($asset->isEmpty())
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
                <div class="bg-white rounded-lg shadow-lg p-6 w-[72rem] h-[96vh] overflow-auto dark:bg-gray-800"
                    @click.away="showModal = false">
                    <!-- Header Modal -->
                    <div class="flex
                    justify-between items-center border-b pb-2 bg-white dark:bg-gray-800">
                    <div class="flex items-center">
                        <a :href="`/creator/${asset.creator.username}`">
                            <img :src="asset.creator.profile_picture" alt="User" class="rounded-full w-10 h-10">
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
                        <x-dropdown>

                            <x-slot name="trigger">
                                <button
                                    class="flex gap-2 border border-gray-800 text-gray-800 px-4 py-1 rounded-md hover:bg-gray-800 hover:text-white transition dark:border-white dark:text-white dark:hover:bg-white dark:hover:text-gray-800"><a>
                                        <span class="flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="size-4 mt-1">
                                                <path d="M12 3v14"></path>
                                                <path d="m6 12 6 6 6-6"></path>
                                                <path d="M5 21h14"></path>
                                            </svg> Download <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-4 mt-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </a>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link
                                    x-bind:href="'{{ route('download.assets') }}?modelId=' + asset.id + '&collection=assets'">Download
                                    File
                                </x-dropdown-link>
                                <x-dropdown-link
                                    x-bind:href="'{{ route('download.image') }}?modelId=' + asset.id + '&collection=images'">
                                    Download Image
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
                            <span class="bg-gray-200 px-2 py-1 text-sm rounded dark:bg-gray-700" x-text="item.name"></span>
                        </template>
                    </div>

                </div>
            </div>
            </div>

            <style scoped>
                /* Custom scrollbar for vertical scroll */
                .custom-scrollbar::-webkit-scrollbar {
                    width: 8px;
                }

                .custom-scrollbar::-webkit-scrollbar-track {
                    background: transparent;
                }

                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background-color: rgba(156, 163, 175, 0.5);
                    border-radius: 20px;
                }

                .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background-color: rgba(107, 114, 128, 0.7);
                }

                /* Hide scrollbar for category section */
                .hide-scrollbar::-webkit-scrollbar {
                    height: 0;
                    width: 0;
                    display: none;
                }

                /* For Firefox */
                .hide-scrollbar {
                    scrollbar-width: none;
                }
            </style>

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

            {{-- Script untuk search --}}
        </section>
    </main>
@endsection

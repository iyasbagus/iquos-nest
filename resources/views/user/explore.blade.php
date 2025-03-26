@extends('layouts.user-explore')

@section('content-explore')
    <main x-data="isOpenAsset()">
        <!-- Kategori -->
        <section class="flex justify-center items-center">
            <div class="flex space-x-9">
                @foreach ($category as $item)
                    <button class="px-4 py-2 rounded-full bg-gray-200 text-black font-medium">{{ $item->name }}</button>
                @endforeach
            </div>
        </section>

        <!-- Grid Asset -->
        <section class="px-5 mt-10">
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
                @foreach ($asset as $item)
                    <div data-aos="fade-up" class="mb-4 rounded-xl overflow-hidden group break-inside-avoid">
                        <div class="relative">
                            <!-- Tombol Buka Modal -->
                            <button
                                @click="showAsset({{ json_encode($item) }}); document.body.classList.add('overflow-hidden')">
                                <img src="{{ asset('admin/images/asset/' . $item->thumbnail_url) }}" alt="Feed Image"
                                    class="w-full h-auto rounded-xl transition duration-300 group-hover:brightness-50">
                            </button>

                            <!-- Tombol Hover -->
                            <button
                                class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 text-sm font-semibold rounded-lg shadow opacity-0 group-hover:opacity-100 transition duration-300">
                                Simpan
                            </button>

                            <button
                                class="absolute bottom-3 left-3 px-3 py-1 text-sm font-semibold rounded-lg shadow opacity-0 group-hover:opacity-100 transition duration-300 {{ $item->is_premium_only ? 'text-gray-700 bg-gray-100' : 'text-yellow-600 bg-yellow-100' }}">
                                {{ $item->is_premium_only ? 'Free' : 'Premium' }}
                            </button>
                        </div>

                        <!-- Info Asset -->
                        <div class="p-3">
                            <h3 class="text-sm font-semibold text-gray-800">{{ $item->title }}</h3>
                            <div class="flex items-center mt-1">
                                <img src="https://i.pravatar.cc/40" alt="Profile" class="w-6 h-6 rounded-full mr-2">
                                <span
                                    class="text-sm text-gray-700 font-semibold">{{ $item->creator->name ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



            <!-- Modal -->
            <div x-show="showModal" @keydown.escape.window="closeModal()"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-[72rem] h-[96vh] overflow-auto">
                    <!-- Header Modal -->
                    <div class="flex justify-between items-center border-b pb-2 bg-white">
                        <div class="flex items-center">
                            <img src="https://i.pravatar.cc/40" alt="User" class="rounded-full w-10 h-10">
                            <div class="ml-3">
                                <p class="text-sm font-semibold">{{ $item->creator->name ?? 'Unknown' }}</p>
                                <p class="text-xs text-gray-500" x-text="asset.creator?.name ?? 'Creator'"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="flex gap-2 border border-gray-800 text-gray-800 px-4 py-1 rounded-md hover:bg-gray-800 hover:text-white transition">
                                <span>Share</span>
                                <span class="material-icons-outlined text-lg">share</span>
                            </button>
                            <button
                                class="flex gap-2 border border-gray-800 text-gray-800 px-4 py-1 rounded-md hover:bg-gray-800 hover:text-white transition"><a href="{{ route('user.explore.downloadAsset', $item->id) }}">
                                <span>Download</span>
                                <span class="material-icons-outlined text-lg">download</span>
                                </a>
                            </button>
                        </div>
                    </div>

                    <!-- Konten Modal -->
                    <div class="mt-4">
                        <img :src="'/admin/images/asset/' + asset.thumbnail_url" alt="Image" class="rounded-lg px-28">

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
                                <span class="bg-gray-200 px-2 py-1 text-sm rounded" x-text="item.name"></span>
                            </template>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Alpine.js -->
            <script>
                function isOpenAsset() {
                    return {
                        showModal: false,
                        asset: {
                            tags: []
                        },
                        showAsset(asset) {
                            this.asset = asset;
                            this.showModal = true;
                            document.body.classList.add('overflow-hidden');
                        },
                        closeModal() {
                            this.showModal = false;
                            this.asset = {};
                            document.body.classList.remove('overflow-hidden');
                        },
                    };
                }
            </script>
        </section>
    </main>
@endsection

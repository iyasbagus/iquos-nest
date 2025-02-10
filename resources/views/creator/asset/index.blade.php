<x-app-layout>

    @include('creator.asset.create')

    <div class="my-10 sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Your Assets</h2>

                <span
                    class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                    vendors</span>
            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in
                the last 12 months.</p>
        </div>
    </div>

    <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
    @foreach ($asset as $item)
        <div class="mb-4 rounded-xl overflow-hidden group break-inside-avoid">
            <!-- Container Gambar -->
            <div class="relative">
                <a href="{{route('asset.show', $item->id)}}">
                <img src="{{ asset('admin/images/asset/' . $item->thumbnail_url) }}" alt="Feed Image"
                    class="w-full h-auto rounded-xl transition duration-300 group-hover:brightness-50">
                    </a>

                <!-- Tombol Hover -->
                <button
                    class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 text-sm font-semibold rounded-lg shadow opacity-0 group-hover:opacity-100 transition duration-300">
                    Simpan
                </button>

                <button
                    class="absolute bottom-3 left-3 px-3 py-1 text-sm font-semibold rounded-lg shadow opacity-0 group-hover:opacity-100 transition duration-300 {{$item->is_premium_only ? 'text-gray-700 bg-gray-100' : 'text-yellow-600 bg-yellow-100'}}">
                    {{$item->is_premium_only ? 'Free' : 'Premium' }}
                </button>

                <!-- Ikon lainnya -->
                <div class="absolute bottom-3 right-3 flex space-x-2 opacity-0 group-hover:opacity-100 transition duration-300">
                    <button class="bg-white p-1 rounded-full shadow">
                        <i class="material-icons-outlined">file_download</i>
                    </button>
                    <button class="p-1 text-white">
                        ⋮
                    </button>
                </div>
            </div>

            <!-- Bagian Bawah -->
            <div class="p-3">
                <h3 class="text-sm font-semibold text-gray-800">{{$item->title}}</h3>
                <div class="flex items-center mt-1">
                    <img src="{{ asset('admin/images/profile.png') }}" alt="Profile" class="w-6 h-6 rounded-full mr-2">
                    <span class="text-sm text-gray-700 font-semibold">{{$item->creator->name ?? "Unknow"}}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

</x-app-layout>

<x-app-layout>

    <form action="{{ route('asset.store') }}" method="POST">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Bagian Gambar -->
                <div class="md:w-1/3">
                    <img class="w-full h-full object-cover"
                        src="{{ asset('admin/images/asset/' . $asset->thumbnail_url) }}" alt="Thumbnail">
                </div>

                <!-- Bagian Teks -->
                <div class="md:w-2/3 p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $asset->title }}</h2>
                        <p class="text-gray-600 mt-2">{{ $asset->description }}</p>

                        <div class="mt-3">
                            <p><strong>File URL:</strong> <a href="{{ $asset->file_url }}"
                                    class="text-blue-500">Download</a></p>
                            <p><strong>Pembuat:</strong> {{ $asset->creator->name }}</p>
                            <p><strong>Premium:</strong> {{ $asset->is_premium_only ? 'Free' : 'Premium' }}</p>
                            <p><strong>Jumlah Download:</strong> {{ $asset->downloads }}</p>
                            <p><strong>Rating:</strong> {{ $asset->rating }}</p>
                            <p><strong>Category:</strong>
                                @foreach ($asset->category as $item)
                                    <span class="bg-gray-200 px-2 py-1 rounded">{{ $item->name }}</span>
                                @endforeach
                            </p>
                            <p><strong>Status:</strong>
                                <span
                                    class="px-2 py-1 text-white rounded
                        {{ $asset->status == 'active' ? 'bg-green-500' : ($asset->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                    {{ ucfirst($asset->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Bagian Bawah -->
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-1 text-gray-600">
                            <i class="material-icons-outlined">download</i>
                            <span>{{ $asset->downloads }}</span>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg"
                            @click.prevent="window.location.href = '{{ route('asset.index') }}'">
                            Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

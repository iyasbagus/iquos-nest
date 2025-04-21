@extends('layouts.user-explore')

@section('content-explore')

<div class="mb-6 p-6">
    <h2 class="text-2xl font-semibold mb-4">Browse by category</h2>

    <div id="category-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 cursor-pointer">
        @foreach($category as $index => $categories)
            @php
                $image = $categories->getFirstMediaUrl('category') ?? 'https://via.placeholder.com/300';
            @endphp
            <div class="relative rounded-xl overflow-hidden shadow-sm group {{ $index >= 10 ? 'hidden extra-categories' : '' }}">
                <img src="{{ $image }}" alt="{{ $categories->name }}" class="w-full h-36 object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-25 flex items-center justify-center hover:bg-black hover:bg-opacity-50">
                    <span class="text-white font-semibold text-center px-2">{{ $categories->name }}</span>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($category) > 10)
        <div class="flex justify-center mt-4">
            <button id="toggle-categories" class="px-4 py-2 bg-gray-200 text-sm rounded-full hover:bg-gray-300 transition">
                See more
            </button>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggle-categories');
        const extraCategories = document.querySelectorAll('.extra-category');
        let expanded = false;

        toggleBtn?.addEventListener('click', function () {
            extraCategories.forEach(el => el.classList.toggle('hidden'));
            expanded = !expanded;
            toggleBtn.textContent = expanded ? 'See less' : 'See more';
        });
    });
</script>
@endpush

@endsection

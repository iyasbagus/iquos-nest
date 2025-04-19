@extends('layouts.user')

@section('usercontent')
    <div class="p-6 pt-32 bg-white">

        <!-- Hero Banner -->
        <div class="relative rounded-xl overflow-hidden mb-10 bg-gray-900">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-transparent z-10"></div>
            <div class="relative z-20 p-12 md:p-16 flex flex-col items-center text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Looking to Hire a Creator?</h1>
                <p class="text-lg md:text-xl max-w-2xl">Over 1 million creatives are available for freelance or full-time</p>
                <div class="relative flex-1 mt-4 w-96">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                        class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-full w-full pl-10 p-3"
                        placeholder="Search the creative world at work">
                </div>
            </div>
            <div class="absolute bottom-4 right-4 z-20 flex items-center">
                <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white">
                <div class="ml-2 text-white">
                    <p class="font-semibold text-sm">Cláudia Silva</p>
                    <p class="text-xs">Aveiro, Portugal</p>
                </div>
            </div>
        </div>

        <!-- Creators Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($creators as $creator)
                <div class="rounded-lg border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition">
                    <!-- Creator Gallery -->
                    <div class="grid grid-cols-3 gap-1 h-24">
                        @forelse ($creator->latestAssets as $asset)
                            <div class="bg-gray-100">
                                @if ($asset->getFirstMediaUrl('images'))
                                    <img src="{{ $asset->getFirstMediaUrl('images') }}" alt="Work sample"
                                        class="w-full object-cover">
                                @else
                                    <img src="/api/placeholder/150/125" alt="Work sample"
                                        class=" object-cover">
                                @endif
                            </div>
                        @empty
                            @for ($i = 0; $i < 3; $i++)
                                <div class=" bg-gray-100">
                                    <img src="/api/placeholder/150/125" alt="Work sample"
                                        class="object-cover">
                                </div>
                            @endfor
                        @endforelse
                    </div>

                    <!-- Creator Profile -->
                    <div class="p-4 flex flex-col items-center text-center">
                        <!-- Profile Picture -->
                        <div class="w-16 h-16 rounded-full overflow-hidden mb-2 border-2 border-white shadow-sm">
                            <img src="{{ $creator->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($creator->name) }}"
                                alt="{{ $creator->name }}" class="w-full h-full object-cover">
                        </div>

                        <!-- Creator Info -->
                        <h3 class="font-bold text-gray-900">{{ $creator->name }}</h3>
                        <p class="text-gray-500 text-sm mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $creator->location ?? 'Location not specified' }}
                        </p>

                        <!-- Tags/Badges -->
                        <div class="flex flex-wrap justify-center gap-2 mb-4">
                            @if ($creator->hasRole('creator'))
                                <span
                                    class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">Creator</span>
                            @endif

                            @if ($creator->isPremium())
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">PRO</span>
                            @endif

                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Free</span>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 w-full border-t border-gray-100 pt-3">
                            <div class="text-center">
                                <p class="font-semibold text-gray-900">
                                    {{ number_format($creator->appreciation_count ?? rand(30000, 700000)) }}</p>
                                <p class="text-xs text-gray-500">Appreciations</p>
                            </div>
                            <div class="text-center border-l border-r border-gray-100">
                                <p class="font-semibold text-gray-900">
                                    {{ number_format($creator->followers_count ?? rand(150000, 300000)) }}</p>
                                <p class="text-xs text-gray-500">Followers</p>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-gray-900">
                                    {{ number_format($creator->project_views ?? rand(1000000, 10000000)) }}</p>
                                <p class="text-xs text-gray-500">Project Views</p>
                            </div>
                        </div>

                        <!-- Message Button -->
                        <a href="#"
                            class="mt-4 w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-lg transition">
                            Show Profile {{ explode(' ', $creator->name)[0] }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

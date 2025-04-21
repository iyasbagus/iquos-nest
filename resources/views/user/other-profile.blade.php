@extends('layouts.user')

<title>{{ $creator['name'] }} | IQUOS Nest</title>
<link rel="Icon" type="png" href="../iquosnest-logo-title.png">

@section('usercontent')
    <main x-data="{ open: false }" class="pt-32 pb-32 min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative">
            <div class="relative h-64 w-full overflow-hidden group">
                <!-- Banner Image -->
                <div class="h-full w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-400 overflow-hidden">
                    <!-- Pattern Overlay -->
                    <div class="absolute inset-0 opacity-20"
                        style="background-image: url('data:image/svg+xml,%3Csvg width=\"30\" height=\"30\" viewBox=\"0 0 30 30\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M15 0C6.716 0 0 6.716 0 15c0 8.284 6.716 15 15 15 8.284 0 15-6.716 15-15 0-8.284-6.716-15-15-15zm0 5c5.523 0 10 4.477 10 10s-4.477 10-10 10S5 20.523 5 15 9.477 5 15 5z\" fill=\"%23FFF\" fill-opacity=\"0.4\" fill-rule=\"evenodd\"/%3E%3C/svg%3E')">
                    </div>

                     @if ($creator->getFirstMediaUrl('banner_image'))
                        <img src="{{ $creator->getFirstMediaUrl('banner_image') }}" alt="Banner"
                            class="absolute inset-0 w-full h-full object-cover z-0" />
                    @endif
                </div>
            </div>

            <!-- Profile Info Card -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative -mt-20">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Profile Header -->
                        <div class="flex flex-col md:flex-row items-center md:items-start p-6">
                            <!-- Avatar Section -->
                            <div class="relative flex-shrink-0 mb-4 md:mb-0">
                                <div class="relative">
                                    <div
                                        class="w-36 h-36 rounded-full overflow-hidden border-4 border-white shadow-lg ring-4 ring-purple-100">
                                        <img src="{{ $creator->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($creator->name) }}"
                                            alt="{{ $creator['name'] }}"
                                            class="w-full h-full object-cover transform transition duration-300 hover:scale-110">
                                    </div>

                                    <!-- Status Badge -->
                                    @foreach ($assets as $asset)
                                        @if ($asset->creator->hasRole('admin'))
                                            <div class="absolute -top-2 -right-2 flex">
                                                <span
                                                    class="flex items-center bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M10 2a2 2 0 012 2v2h-4V4a2 2 0 012-2zM4 6a2 2 0 012-2h1v4H4V6zm10-2a2 2 0 012 2v2h-4V4h1zM4 10h12v2H4v-2zm0 4h12v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z" />
                                                    </svg>
                                                    ADMIN
                                                </span>
                                            </div>
                                        @elseif ($asset->creator->hasRole('creator'))
                                            <div class="absolute -top-2 -right-2 flex">
                                                <span
                                                    class="flex items-center bg-purple-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 2a2 2 0 00-2 2v4H6l4 4 4-4h-2V4a2 2 0 00-2-2z" />
                                                        <path d="M4 14h12v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z" />
                                                    </svg>
                                                    CREATOR
                                                </span>
                                            </div>
                                        @else
                                            <div class="absolute -top-2 -right-2 flex">
                                                <span
                                                    class="flex items-center bg-gray-200 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A4 4 0 0112 15h0a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    USER
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Profile Info -->
                            <div class="md:ml-8 text-center md:text-left flex-grow">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <div>
                                        <h1 class="text-3xl font-bold text-gray-800">{{ $creator['name'] }}</h1>
                                        <p class="text-purple-600 text-lg">{{ $creator->username }}</p>
                                        <div class="flex items-center justify-center md:justify-start mt-2">
                                            <span class="text-gray-500 flex items-center text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                Indonesia
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-4 md:mt-0 flex flex-wrap justify-center md:justify-end gap-2">
                                        {{-- <button
                                            class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition shadow-md hover:shadow-lg flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-white-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Follow
                                        </button> --}}
                                        <button
                                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition shadow hover:shadow-md flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                            </svg>
                                            Share
                                        </button>
                                    </div>
                                </div>

                                <!-- Bio Section -->
                                <div class="mt-4 max-w-2xl">
                                    <p class="text-gray-600">{{ $creator->bio ?? 'Welcome to my IQUOS Nest profile!' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="px-6 pb-6">
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <!-- Asset Count -->
                                <div
                                    class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl p-4 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow-md border border-purple-100">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-2xl font-bold text-purple-600">{{ $creator->asset()->where('status', 'active')->count() }}
                                            </p>
                                            <p class="text-sm text-gray-500">Assets</p>
                                        </div>
                                        <div class="p-2 bg-purple-100 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Following Count -->
                                {{-- <div
                                    class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl p-4 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow-md border border-pink-100">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-2xl font-bold text-pink-600">100</p>
                                            <p class="text-sm text-gray-500">Following</p>
                                        </div>
                                        <div class="p-2 bg-pink-100 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Downloads Count -->
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow-md border border-blue-100">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-2xl font-bold text-blue-600">{{$creator->totalDownloads()}}</p>
                                            <p class="text-sm text-gray-500">Downloads</p>
                                        </div>
                                        <div class="p-2 bg-blue-100 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="mt-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="px-6 py-1 border-b">
                            <div class="flex overflow-x-auto scrollbar-hide">
                                <a href="#"
                                    class="relative py-4 px-6 text-purple-600 font-medium whitespace-nowrap border-b-2 border-purple-600">
                                    All Works
                                    <span class="absolute top-3 -right-1 w-2 h-2 bg-purple-600 rounded-full"></span>
                                </a>
                                <a href="#"
                                    class="py-4 px-6 text-gray-500 font-medium whitespace-nowrap hover:text-gray-700 transition">
                                    Collections
                                </a>
                                <a href="#"
                                    class="py-4 px-6 text-gray-500 font-medium whitespace-nowrap hover:text-gray-700 transition">
                                    Liked
                                </a>
                            </div>
                        </div>

                        <!-- Asset Gallery -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                                @forelse ($assets as $asset)
                                    <div
                                        class="group bg-white rounded-xl overflow-hidden shadow transition duration-300 hover:shadow-xl transform hover:-translate-y-1 border border-gray-100">
                                        <!-- Asset Image -->
                                        <div class="relative h-48 overflow-hidden">
                                            <img src="{{ $asset->getFirstMediaUrl('images') ?? 'https://via.placeholder.com/300x220' }}"
                                                alt="{{ $asset->title }}"
                                                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">

                                            <!-- Hover Overlay -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-purple-900/80 via-purple-800/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-4">
                                                <div
                                                    class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                                    <h3 class="font-medium text-white text-lg">{{ $asset->title }}</h3>
                                                    <div class="flex items-center mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4 text-purple-200" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        <span
                                                            class="text-sm text-purple-100 ml-1">{{ $asset->downloads()->count() }}
                                                            Downloads</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Asset Info -->
                                        <div class="p-4 bg-white">
                                            <h3 class="font-medium text-gray-800 truncate">{{ $asset->title }}</h3>
                                            <div class="flex justify-between items-center mt-2">
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    {{ $asset->views ?? 0 }}
                                                </div>
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                    </svg>
                                                    {{ $asset->downloads()->count() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                                        <div
                                            class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-medium text-gray-800 mb-2">No assets yet</h3>
                                        <p class="text-gray-500 max-w-md">Start uploading your amazing assets to showcase
                                            your work to the IQUOS Nest community!</p>
                                        <button
                                            class="mt-6 inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Upload First Asset
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Additional JS functionality can be added here
        document.addEventListener('DOMContentLoaded', function() {
            // Any JS initialization
        });
    </script>
@endsection

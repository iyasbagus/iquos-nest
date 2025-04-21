@extends('layouts.user')

<title>{{ $user['name'] }} | IQUOS Nest</title>
<link rel="Icon" type="png" href="../iquosnest-logo-title.png">

@section('usercontent')
    <main x-data="{ open: false }" class="pt-32 pb-32 min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative">
            <div class="relative h-64 w-full overflow-hidden group cursor-pointer" x-data @click="$refs.bannerInput.click()">
                <!-- Banner Image -->
                <div class="h-full w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-400 overflow-hidden">
                    <!-- Pattern Overlay -->
                    <div class="absolute inset-0 opacity-20" style="background-image: url('...')">
                    </div>

                    {{-- ✅ Tambahkan image banner dari media --}}
                    @if ($user->getFirstMediaUrl('banner_image'))
                        <img src="{{ $user->getFirstMediaUrl('banner_image') }}" alt="Banner"
                            class="absolute inset-0 w-full h-full object-cover z-0" />
                    @endif

                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="text-white text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="font-medium">Upload Banner JPG,PNG,JPEG Or GIF</p>
                        </div>
                    </div>
                </div>

                <!-- Hidden Input -->
                <form x-ref="form" method="POST" action="{{ route('profileUser.update.banner') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" name="banner_image" accept="image/*" class="hidden" x-ref="bannerInput"
                        @change="$refs.form.submit()" />
                </form>
            </div>

            <!-- Profile Info Card -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative -mt-10">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Profile Header -->
                        <div class="flex flex-col md:flex-row items-center md:items-start p-6">
                            <!-- Avatar Section -->
                            <div class="relative flex-shrink-0 mb-4 md:mb-0">
                                <div class="relative">
                                    <div
                                        class="w-36 h-36 rounded-full overflow-hidden border-4 border-white shadow-lg ring-4 ring-purple-100">
                                        <img src="{{ $user->getFirstMediaUrl('profile_picture') ?: \App\Helpers\AvatarHelper::generateAvatar($user->name) }}"
                                            alt="{{ $user['name'] }}"
                                            class="w-full h-full object-cover transform transition duration-300 hover:scale-110 cursor-pointer"
                                            onclick="document.getElementById('changePhotoInput').click()">
                                    </div>

                                    <form action="{{ route('profileUser.update.photo') }}" method="POST"
                                        enctype="multipart/form-data" id="photoForm" class="hidden">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" name="profile_picture" id="changePhotoInput"
                                            onchange="document.getElementById('photoForm').submit()">
                                    </form>

                                    <!-- Status Badge -->
                                    @if (auth()->user()->isPremium())
                                        <div class="absolute -top-2 -right-2 flex">
                                            <span
                                                class="flex items-center bg-gradient-to-r from-amber-400 to-amber-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                PREMIUM
                                            </span>
                                        </div>
                                    @else
                                        <div class="absolute -top-2 -right-2 flex">
                                            <span
                                                class="flex items-center bg-gray-200 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                FREE
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Profile Info -->
                            <div class="md:ml-8 text-center md:text-left flex-grow">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <div>
                                        <h1 class="text-3xl font-bold text-gray-800">{{ $user['name'] }}</h1>
                                        <p class="text-purple-600 text-lg mt-3">{{ $user->email }}</p>
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
                                        <button @click="open = true"
                                            class="bg-gray-800 hover:bg-gray-950 text-white font-medium py-2 px-4 rounded-lg transition shadow-md hover:shadow-lg flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit Profile
                                        </button>
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
                                    <p class="text-gray-600">{{ $user->bio ?? 'Welcome to my IQUOS Nest profile!' }}</p>
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
                                            <p class="text-2xl font-bold text-purple-600">{{ $user->asset()->where('status', 'active')->count() }}</p>
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

                                <!-- Downloads Count -->
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow-md border border-blue-100">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-2xl font-bold text-blue-600">{{$user->totalDownloads()}}</p>
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

        <!-- Edit Profile Modal -->
        <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" x-cloak>
            <div @click.away="open = false"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <div class="flex items-center justify-between border-b p-5">
                    <h3 class="text-xl font-bold text-gray-800">Edit Profile</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('profileUser.update') }}" method="POST" class="p-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <div class="relative rounded-md">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ $user->name }}"
                                    class="pl-10 focus:ring-purple-500 focus:border-purple-500 block w-full rounded-md border-gray-300 shadow-sm"
                                    required>
                            </div>
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <div class="relative rounded-md">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400">@</span>
                                </div>
                                <input type="text" name="username" id="username"
                                    value="{{$user->username}}"
                                    class="pl-10 focus:ring-purple-500 focus:border-purple-500 block w-full rounded-md border-gray-300 shadow-sm"
                                    required>
                            </div>
                        </div>

                        <!-- Bio -->
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <div class="relative rounded-md">
                                <textarea name="bio" id="bio" rows="4"
                                    class="focus:ring-purple-500 focus:border-purple-500 block w-full rounded-md border-gray-300 shadow-sm"
                                    placeholder="Tell the community about yourself...">{{ $user->bio }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
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

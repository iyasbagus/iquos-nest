@extends('layouts.user')

<title>Profile - {{ $user['name'] }}</title>
<link rel="Icon" type="png" href="../iquosnest-logo-title.png">

@section('usercontent')
    <main class="mt-4 flex justify-center">
        <div class="w-full max-w-6xl bg-white p-8 rounded-lg text-center">
            <!-- Tombol Kembali -->
            <div class="text-left">
                <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-900 text-3xl">&#8592;</a>
            </div>

            <!-- Avatar -->
            <div class="flex justify-center">
                <img src="{{ $user['profile_picture'] ?? \App\Helpers\AvatarHelper::generateAvatar($user['name']) }}"
                    alt="Avatar" class="w-24 h-24 rounded-full">
            </div>

            <!-- Nama User -->
            <h1 class="text-2xl font-semibold mt-4">{{ $user['name'] }}</h1>

            <!-- Bio -->
            <p class="text-gray-600 mt-4 px-48">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro quidem in non reprehenderit molestiae exercitationem at saepe alias modi minima.</p>

            <!-- Username -->
            <div class="flex justify-center items-center text-gray-500 mt-2">
                <span class="ml-2">Role: {{ $user->getRoleNames()->first() }}</span>
            </div>

            <!-- Jumlah Followers -->
            <p class="text-gray-600 mt-2">100 mengikuti</p>

            <!-- Tombol Aksi -->
            <div class="flex justify-center mt-4 space-x-4">
                <button class="bg-gray-200 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-300">Bagikan</button>
                <button class="bg-gray-300 px-4 py-2 rounded-lg text-gray-800 font-medium hover:bg-gray-400">Edit
                    Profil</button>
            </div>
        </div>
    </main>
@endsection

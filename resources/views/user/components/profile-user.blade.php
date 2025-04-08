<div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md text-center">
        <!-- Tombol Kembali -->
        <div class="text-left">
            <a href="/" class="text-gray-600 hover:text-gray-900 text-xl">&#8592;</a>
        </div>

        <!-- Avatar -->
        <div class="flex justify-center">
            <img src="{{ $user['avatar'] }}" alt="Avatar" class="w-24 h-24 rounded-full">
        </div>

        <!-- Nama User -->
        <h1 class="text-2xl font-semibold mt-4">{{ $user['name'] }}</h1>

        <!-- Bio -->
        <p class="text-gray-600 mt-2">{{ $user['bio'] }}</p>

        <!-- Username -->
        <div class="flex justify-center items-center text-gray-500 mt-2">
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm0 3c4.963 0 9 4.037 9 9s-4.037 9-9 9-9-4.037-9-9 4.037-9 9-9zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 10c-2.209 0-4-1.791-4-4h8c0 2.209-1.791 4-4 4z"/>
            </svg>
            <span class="ml-2">@{{ $user['username'] }}</span>
        </div>

        <!-- Jumlah Followers -->
        <p class="text-gray-600 mt-2">{{ $user['followers'] }} mengikuti</p>

        <!-- Tombol Aksi -->
        <div class="flex justify-center mt-4 space-x-4">
            <button class="bg-gray-200 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-300">Bagikan</button>
            <button class="bg-gray-300 px-4 py-2 rounded-lg text-gray-800 font-medium hover:bg-gray-400">Edit Profil</button>
        </div>
    </div>

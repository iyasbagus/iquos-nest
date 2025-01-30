<x-app-layout>

    <div class="max-w-5xl bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row gap-6">
        <!-- Kartu Gambar Promo -->
        <div class="relative w-full md:w-1/3">
            <div>
                <label for="file" class="block text-sm text-gray-500 dark:text-gray-300">File</label>

                <label for="dropzone-file"
                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>

                    <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Payment File</h2>

                    <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">Upload or darg & drop your
                        file SVG, PNG, JPG or GIF. </p>

                    <input id="dropzone-file" type="file" class="hidden" />
                </label>
            </div>
        </div>

        <!-- Form Input -->
        <div class="w-full md:w-2/3 space-y-4">
            <div>
                <label class="block text-gray-700 font-semibold">Judul</label>
                <input type="text" placeholder="Tambahkan judul" class="w-full mt-1 p-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Deskripsi</label>
                <textarea placeholder="Tambahkan deskripsi terperinci" class="w-full mt-1 p-2 border rounded-lg h-24"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Tautan</label>
                <input type="text" placeholder="Tambahkan tautan" class="w-full mt-1 p-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Papan</label>
                <select class="w-full mt-1 p-2 border rounded-lg">
                    <option>Pilih papan</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Topik yang diberi tag (0)</label>
                <input type="text" placeholder="Cari tag" class="w-full mt-1 p-2 border rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Jangan khawatir, orang tidak akan melihat tag Anda</p>
            </div>

            <div>
                <button class="text-blue-500 font-semibold">Opsi lainnya ▼</button>
            </div>
        </div>
    </div>

</x-app-layout>

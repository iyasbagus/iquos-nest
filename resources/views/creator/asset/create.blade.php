    <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="max-w-5xl bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row gap-6">
            <!-- Kartu Gambar Promo -->
            <div class="relative w-full md:w-1/3">
                <div>
                    <label for="thumbnail_url" class="block text-sm text-gray-500 dark:text-gray-300">File</label>

                    <label for="thumbnail_url"
                        class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>

                        <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Image Thumbnail</h2>

                        <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">Upload or darg & drop
                            your
                            file PNG, JPG or GIF. </p>

                        <input name="thumbnail_url" id="thumbnail_url" type="file" class="hidden" />
                    </label>
                </div>
            </div>

            <!-- Form Input -->
            <div class="w-full md:w-2/3 space-y-4">
                <div>
                    <label for="title" class="block text-gray-700 font-semibold">Title</label>
                    <input name="title" id="title" type="text" placeholder="Title..."
                        class="w-full mt-1 p-2 border rounded-lg">
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-semibold">Description</label>
                    <textarea name="description" id="description" placeholder="Description..."
                        class="w-full mt-1 p-2 border rounded-lg h-24"></textarea>
                </div>

                <div>
                    <label for="file_url" class="block text-gray-700 font-semibold">File Url</label>
                    <input name="file_url" id="file_url" type="file" placeholder="File Url"
                        class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Categories</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($category as $item)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="category_ids[]" value="{{ $item->id }}"
                                    class="form-checkbox">
                                <span class="ml-2">{{ $item->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label for="is_premium_only" class="block text-gray-700 font-semibold">Premium</label>
                    <select name="is_premium_only" id="is_premium_only" class="w-full mt-1 p-2 border rounded-lg">
                        <option value="1">Free</option>
                        <option value="0">Premium</option>
                    </select>
                </div>

                <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                    <button type="submit"
                        class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                        Submit Data
                    </button>
                    <button type="reset"
                        class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                        Cancel
                    </button>
                </div>

            </div>

        </div>
    </form>

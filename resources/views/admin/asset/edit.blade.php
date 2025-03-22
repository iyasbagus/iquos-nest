<x-app-layout>

    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Edit Asset</h2>
            </div>

            <p class="my-3 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in
                the last 12 months.</p>
        </div>
    </div>

    <form action="{{ route('adminAsset.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="max-w-5xl bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row gap-6">
            <!-- Kartu Gambar Promo -->
            <div class="relative w-full md:w-1/3">
                <div>
                    <label class="block text-sm text-gray-500 dark:text-gray-300">File</label>

                    <!-- Input File (Tersembunyi) -->
                    <input type="file" id="fileInput" name="thumbnail_url" class="hidden" accept="image/*">

                    @if (!empty($asset->thumbnail_url))
                        <!-- Preview Gambar -->
                        <div id="previewContainer" class="relative mt-2">
                            <img id="previewImage" src="{{ asset('admin/images/asset/' . $asset->thumbnail_url) }}"
                                alt="Image Preview"
                                class="w-full h-auto rounded-xl border border-gray-300 cursor-pointer">
                        </div>
                    @else
                        <!-- Kotak Upload -->
                        <div id="uploadBox"
                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>

                            <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Image Thumbnail
                            </h2>

                            <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                Upload or drag & drop your file PNG, JPG, or GIF.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Input -->
            <div class="w-full md:w-2/3 space-y-4">
                {{-- ini input title --}}
                <div>
                    <label for="title" class="block text-gray-700 font-semibold">Title</label>
                    <input name="title" id="title" type="text" placeholder="Title..."
                        value="{{ $asset->title }}" class="w-full mt-1 p-2 border rounded-lg">
                </div>

                {{-- ini input desc --}}
                <div>
                    <label for="description" class="block text-gray-700 font-semibold">Description</label>
                    <textarea name="description" id="description" placeholder="Description..."
                        class="w-full mt-1 p-2 border rounded-lg h-24">{{ old('description', $asset->description) }}</textarea>
                </div>

                <!-- Input File URL -->
                <div>
                    <label for="file_url" class="block text-gray-700 font-semibold">File Url</label>
                    @if ($asset->file_url)
                        <p class="mt-1 text-sm text-gray-500">File:
                            <a href="{{ Storage::url($asset->file_url) }}" target="_blank" class="text-blue-500">
                                Lihat File
                            </a>
                        </p>
                    @endif
                    <input name="file_url" id="file_url" type="file"
                        class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Categories</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($categories as $item)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="category_ids[]" value="{{ $item->id }}"
                                    class="form-checkbox"
                                    {{ in_array($item->id, $selectedCategories ?? []) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $item->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- <div>
                    <label class="block text-gray-700 font-semibold">Categories</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($category as $item)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="category_ids[]" multiple value="{{ $item->id }}"
                                    class="form-checkbox">
                                <span class="ml-2">{{ $item->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div> --}}

                <div>
                    <label for="is_premium_only" class="block text-gray-700 font-semibold">Premium</label>
                    <select name="is_premium_only" id="is_premium_only" class="w-full mt-1 p-2 border rounded-lg">
                        <option value="1">Free</option>
                        <option value="0">Premium</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Tags</label>
                    <input type="text" id="tag-input" class="w-full border px-3 py-2 rounded-md">
                    <div id="hidden-tag-inputs"></div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("fileInput");
            const uploadBox = document.getElementById("uploadBox");
            const previewContainer = document.getElementById("previewContainer");
            const previewImage = document.getElementById("previewImage");

            // Cek apakah ada gambar lama (dari Blade)
            if (previewImage && previewImage.src.trim() !== "") {
                previewContainer.classList.remove("hidden");
                if (uploadBox) uploadBox.classList.add("hidden");
            }

            // Klik area upload untuk memilih file
            if (uploadBox) {
                uploadBox.addEventListener("click", function() {
                    fileInput.click();
                });
            }

            if (previewImage) {
                previewImage.addEventListener("click", function() {
                    fileInput.click();
                });
            }

            // Ketika file dipilih, tampilkan preview
            fileInput.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove("hidden");
                        if (uploadBox) uploadBox.classList.add("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            });

            let input = document.querySelector("#tag-input");
            let form = document.querySelector("form");
            let hiddenTagContainer = document.querySelector("#hidden-tag-inputs");

            // Data Tag dari Database
            let selectedTags = @json($selectedTags->map(fn($t) => ['value' => $t->name, 'id' => $t->id]));
            let allTags = @json($tags->map(fn($t) => ['value' => $t->name, 'id' => $t->id]));

            let tagify = new Tagify(input, {
                whitelist: allTags,
                enforceWhitelist: false,
                dropdown: {
                    maxItems: 5,
                    enabled: 0,
                    closeOnSelect: false
                }
            });

            // Load tag yang sudah dipilih sebelumnya
            tagify.addTags(selectedTags);

            // Event saat tag diubah
            tagify.on("change", function() {
                hiddenTagContainer.innerHTML = ""; // Bersihkan input hidden

                let selectedTagIds = tagify.value.map(tag => {
                    let tagData = allTags.find(t => t.value === tag.value);
                    return tagData ? tagData.id : null;
                }).filter(id => id !== null);

                selectedTagIds.forEach(tagId => {
                    let hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "tag_ids[]";
                    hiddenInput.value = tagId;
                    hiddenTagContainer.appendChild(hiddenInput);
                });

                console.log("Tag yang dipilih:", selectedTagIds);
            });

            form.addEventListener("submit", function() {
                console.log("Cek input sebelum submit:");
                document.querySelectorAll("input[name='tag_ids[]']").forEach(el => {
                    console.log(el.name, el.value);
                });
            });
        });
    </script>

</x-app-layout>

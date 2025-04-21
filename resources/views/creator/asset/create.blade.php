<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto ">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Create New Asset</h1>
            <p class="mt-2 text-sm text-gray-500">Add a new asset to your collection</p>
        </div>

        <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
                <!-- Form Content -->
                <div class="p-10 lg:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left column - Image upload -->
                    <div class="lg:col-span-1">
                        <h2 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-4">Thumbnail</h2>

                        <!-- Hidden file input -->
                        <input type="file" id="fileInput" name="image" class="hidden" accept="image/*">

                        <!-- Upload box -->
                        <div id="uploadBox" class="cursor-pointer">
                            <div class="border border-gray-200 rounded-lg p-4 flex flex-col items-center justify-center min-h-[200px] hover:border-gray-300 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400 mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                <p class="text-sm text-gray-500">Upload image</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG or GIF</p>
                            </div>
                        </div>

                        <!-- Image preview -->
                        <div id="previewContainer" class="hidden">
                            <div class="relative">
                                <img id="previewImage" src="" alt="Preview" class="w-full rounded-lg border border-gray-200">
                                <div class="absolute bottom-2 right-2">
                                    <button type="button" class="bg-white rounded-full p-1 shadow-sm border border-gray-200 hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right column - Form inputs -->
                    <div class="lg:col-span-2 space-y-5">
                        <h2 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-4">Asset Information</h2>

                        <!-- Title input -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input name="title" id="title" type="text" placeholder="Enter title"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        </div>

                        <!-- Description input -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" placeholder="Enter description" rows="3"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"></textarea>
                        </div>

                        <!-- File input -->
                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File</label>
                            <input name="file" id="file" type="file"
                                class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Categories select -->
                            <div>
                                <label for="category_select" class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
                                <select name="category_ids[]" id="category_select" multiple
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
                            </div>

                            <!-- Premium toggle -->
                            <div>
                                <label for="is_premium_only" class="block text-sm font-medium text-gray-700 mb-1">Access Level</label>
                                <select name="is_premium_only" id="is_premium_only"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                                    <option value="0">Free</option>
                                    <option value="1">Premium</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tags input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                            <input type="text" id="tag-input" placeholder="Add tags..."
                                class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                            <div id="hidden-tag-inputs"></div>
                        </div>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="p-6 bg-gray-50 border-t border-gray-100 flex flex-row-reverse gap-3">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Create Asset
                    </button>
                    <button type="reset"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.getElementById("fileInput");
        const uploadBox = document.getElementById("uploadBox");
        const previewContainer = document.getElementById("previewContainer");
        const previewImage = document.getElementById("previewImage");

        // When upload area is clicked, open file input
        uploadBox.addEventListener("click", function() {
            fileInput.click();
        });

        // When preview image is clicked, open file input again
        previewContainer.addEventListener("click", function() {
            fileInput.click();
        });

        // When file is selected, show preview
        fileInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove("hidden");
                    uploadBox.classList.add("hidden");
                };
                reader.readAsDataURL(file);
            }
        });

        let input = document.querySelector("#tag-input");
        let form = document.querySelector("form");

        let tagify = new Tagify(input, {
            whitelist: @json($tag->map(fn($tag) => ['value' => $tag->name, 'id' => $tag->id])),
            dropdown: {
                maxItems: 5,
                enabled: 0,
                closeOnSelect: false
            }
        });

        // Event when adding or removing tags
        tagify.on('change', function() {
            // Remove all previous hidden inputs
            document.querySelectorAll("input[name='tag_ids[]']").forEach(el => el.remove());

            let selectedTagIds = tagify.value.map(tag => {
                let tagData = tagify.whitelist.find(t => t.value === tag.value);
                return tagData ? tagData.id : null;
            }).filter(id => id !== null);

            selectedTagIds.forEach(tagId => {
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "tag_ids[]";
                hiddenInput.value = tagId;
                document.querySelector("#hidden-tag-inputs").appendChild(hiddenInput);
            });

            console.log("All hidden inputs:", document.querySelector("#hidden-tag-inputs").innerHTML);
        });

        document.querySelector("form").addEventListener("submit", function() {
            console.log("Check inputs before submit:");
            document.querySelectorAll("input[name='tag_ids[]']").forEach(el => {
                console.log(el.name, el.value);
            });
        });
    });
</script>

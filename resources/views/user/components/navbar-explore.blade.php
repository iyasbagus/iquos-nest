<nav class="flex justify-between mt-3 items-center px-10 py-4">

    <div class="w-full">
        <form action="{{ route('user.explore.listAssetView') }}" method="GET">
            <input type="text" placeholder="Search Here..." id="openSearchModal" readonly
                class="block mt-2 w-full placeholder-gray-400/70 cursor-pointer dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
        </form>
    </div>
</nav>

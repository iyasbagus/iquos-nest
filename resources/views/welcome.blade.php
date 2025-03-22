  @extends('layouts.user')

  @section('usercontent')
  <section class="flex justify-between items-start mt-10 px-14">
        <div class="max-w-lg">
            <h2 class="text-5xl font-bold text-gray-900 leading-tight">
                Discover the world’s top <span class="bg-purple-400 text-white pl-6 pr-6">designers</span>
            </h2>
        </div>
        <div class="max-w-md text-left">
            <p class="text-gray-600 text-lg">Explore work from the most talented and accomplished designers ready to
                take on your next project</p>
            <button class="mt-4 px-6 py-2 bg-lime-300 text-gray-900 rounded-xl border border-gray-600 shadow-md">Start
                Explore →</button>
        </div>
    </section>

    <section class="relative mt-32 px-8">
        <div class="max-w-2xl mx-auto bg-purple-300 pt-32 pb-9 px-10 rounded-lg relative">
            <div class="flex items-center bg-white rounded-full px-4 py-2 shadow-md">
                <input type="text" placeholder="Search More Inspirations..."
                    class="border-none w-full outline-none px-2 text-lg">
                <select class="bg-transparent border-none text-gray-700 text-lg">
                    <option>UI/UX</option>
                    <option>Graphic Design</option>
                </select>
                <button class="material-icons-outlined bg-purple-400 text-white p-3 rounded-full">search</button>
            </div>
        </div>

        <div class="absolute top-[-20px] left-72 transform rotate-[-15deg] bg-lime-300 px-3 py-1 rounded-xl shadow-md">
            <span class="text-lg">Aa</span>
            <span class="bg-black text-white px-2 py-1 rounded">Aa</span>
        </div>

        <div class="absolute top-[-60px] right-60 transform rotate-[10deg] bg-white w-40 h-40 rounded-xl shadow-lg">
        </div>
    </section>

    <div class="absolute left-0 right-0 bottom-[5px] h-12 opacity-50 bg-gradient-to-t from-purple-300 to-transparent"></div>

@endsection

  @extends('layouts.user')

  @section('usercontent')
      <div class="pt-9">
          <!-- Hero Section -->
          <div class="container mx-auto px-4 md:px-6 py-12 flex flex-col md:flex-row items-center justify-between">
              <!-- Left Content -->
              <div class="md:w-1/2 mb-10 md:mb-0">
                  <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight dark:text-white">
                      Discover <span class="gradient-text">
                          Premium<br>
                          Assets
                      </span>
                      For You Next<br>
                      Project
                  </h1>

                  <p class="mt-6 text-gray-600 dark:text-white">
                      IQUOS Nest is your go-to platform for high-quality digital assets <br>
                      and a creative community to fuel your <span class="font-semibold"> projects.</span>
                  </p>

                  <div class="mt-8">
                      <button
                          class="bg-black text-white px-8 py-3 rounded-full font-medium hover:bg-gray-800 transition duration-300 dark:bg-gray-800 dark:hover:bg-gray-700">
                          EXPLORE NOW
                      </button>
                  </div>

                  <div class="mt-8">
                      <p class="text-sm text-gray-500 mb-2">Join our community</p>
                      <div class="flex -space-x-2">
                          @foreach ($creator as $item)
                              <img class="object-cover inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                  src="{{ $item->profile_picture ?? \App\Helpers\AvatarHelper::generateAvatar($item->name) }}"
                                  alt="User avatar">
                          @endforeach
                      </div>
                      <p class="text-xs text-gray-500 mt-2">We're waiting for you</p>
                  </div>
              </div>

              <!-- Right Content - Card Image -->
              <div class="md:w-1/2 relative">
                  <div class="relative">
                      {{-- <img src="{{ asset('images/iquos_nest_animation.gif') }}" alt="Custom Card Skin"
                          class="rounded-2xl mx-auto w-full h-ful"> --}}
                      <div class="mx-auto w-full h-full" id="lottie-1"></div>
                  </div>
              </div>
          </div>

          <!-- Two Packs Section -->
          <div class="container mx-auto px-4 md:px-6 py-16">
              <h2 class="text-2xl md:text-3xl font-bold mb-10">
                  GET YOUR BEST ASSET<br>
                  ON OUR WEBSITE.
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <!-- Pack 1 -->
                  <div class="bg-gray-100 p-6 rounded-xl dark:bg-gray-800">
                      <div
                          class="bg-black text-white p-2 rounded-lg w-10 h-10 flex items-center justify-center mb-4 dark:bg-gray-700">
                          <span>1</span>
                      </div>
                      <h3 class="font-bold text-xl mb-2">Premium Assets</h3>
                      <p class="text-gray-600 dark:text-gray-500">The best asset you will ever find.</p>
                  </div>

                  <!-- Pack 2 -->
                  <div class="bg-gray-100 p-6 rounded-xl dark:bg-gray-800">
                      <div
                          class="bg-black text-white p-2 rounded-lg w-10 h-10 flex items-center justify-center mb-4 dark:bg-gray-700">
                          <span>2</span>
                      </div>
                      <h3 class="font-bold text-xl mb-2">Best Creator</h3>
                      <p class="text-gray-600 dark:text-gray-500">The big advantage of being a creator.</p>
                  </div>
              </div>
          </div>

          <!-- Popular Pro Stocks Section -->
          <div class="bg-gray-900 py-16 px-4 md:px-6 dark:bg-gray-800">
              <div class="container mx-auto">
                  <h2 class="text-2xl md:text-3xl font-bold text-white mb-8 text-center">POPULER ASSETS DESIGN</h2>
                  <p class="text-gray-400 text-center mb-8 max-w-xl mx-auto">
                      Choose a design according to your preferred category then order as soon as possible.
                  </p>

                  <!-- Search Bar -->
                  <div class="max-w-xl mx-auto mb-8 flex items-center">
                      <div class="flex bg-gray-800 rounded-full overflow-hidden w-full dark:bg-gray-700">
                          <button class="bg-gray-800 text-white px-4 py-2 rounded-l-full dark:bg-gray-700">All</button>
                          <input type="text" placeholder="Search design"
                              class="bg-gray-800 text-white px-4 py-2 flex-grow focus:outline-none dark:bg-gray-700">
                          <button class="bg-gray-800 text-white px-4 py-2 rounded-r-full dark:bg-gray-700">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                  stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                              </svg>
                          </button>
                      </div>
                  </div>

                  <!-- Tabs -->
                  <div class="flex justify-center mb-8">
                      <button
                          class="text-gray-400 px-4 py-2 border-b-2 border-transparent hover:text-white transition duration-300">Latest</button>
                      <button
                          class="text-gray-400 px-4 py-2 border-b-2 border-transparent hover:text-white transition duration-300">Popular</button>
                      <button class="text-purple-500 px-4 py-2 border-b-2 border-purple-500">Categories</button>
                  </div>

                  <!-- Cards Grid -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                      <!-- Card 1 -->
                      @foreach ($category as $item)
                          <div class="bg-gray-800 rounded-xl overflow-hidden dark:bg-gray-700">
                              @foreach ($item->getMedia('category') as $image)
                                  <img src="{{ $image->getUrl() }}" alt="Hypercritical Face"
                                      class="w-full h-48 object-cover">
                              @endforeach
                              <div class="p-4">
                                  <h3 class="text-white font-medium text-lg mb-4">{{ $item->name }}</h3>
                                  <button
                                      class="bg-transparent border border-white text-white px-4 py-2 rounded-full text-sm hover:bg-white hover:text-gray-900 transition duration-300">Search
                                      Now</button>
                              </div>
                          </div>
                      @endforeach
                  </div>

                  <!-- See More Button -->
                  <div class="text-center mt-8">
                      <button
                          class="bg-transparent border border-white text-white px-6 py-2 rounded-full text-sm hover:bg-white hover:text-gray-900 transition duration-300">
                          See More
                      </button>
                  </div>
              </div>
          </div>

          <!-- Vinyl Material Section -->
          <div class="container mx-auto px-4 md:px-6 py-16 flex flex-col md:flex-row items-center">
              <!-- Left - Images -->
              <div class="md:w-1/2 mb-10 md:mb-0 relative">
                  {{-- <img src="{{ asset('images/premium_animation.gif') }}" alt="Card Skin Layers" class="mx-auto"> --}}
                  <div class="mx-auto" id="lottie-2"></div>
              </div>

              <!-- Right - Content -->
              <div class="md:w-1/2">
                  <h2 class="text-2xl md:text-3xl font-bold mb-6">
                      AFFORDABLE SUBSCRIPTION PRICES<br>
                      ONLY AT IQUOS NEST.
                  </h2>
                  <p class="text-gray-600 mb-6 dark:text-gray-400">
                      not only cheap, but can provide the best experience <br> in downloading assets
                  </p>

                  <ul class="space-y-4">
                      <li class="flex items-center">
                          <span class="bg-black text-white p-1 rounded-full mr-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                              </svg>
                          </span>
                          <span>Free Download Access</span>
                      </li>
                      <li class="flex items-center">
                          <span class="bg-black text-white p-1 rounded-full mr-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                              </svg>
                          </span>
                          <span>No Download Limit</span>
                      </li>
                      <li class="flex items-center">
                          <span class="bg-black text-white p-1 rounded-full mr-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd" />
                              </svg>
                          </span>
                          <span>Best Experience</span>
                      </li>
                  </ul>

                  <div class="mt-8">
                      <button
                          class="bg-black text-white px-8 py-3 rounded-full font-medium hover:bg-gray-800 transition duration-300">
                          <a href="{{ route('subscription.premium') }}">
                              GET STARTED
                          </a>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Testimonials Section -->
          <div class="bg-gray-900 py-16 px-4 md:px-6 dark:bg-gray-800">
              <div class="container mx-auto">
                  <h2 class="text-2xl md:text-3xl font-bold text-white mb-12 text-center">
                      SEE WHAT OUR USER<br>
                      ARE SAYING
                  </h2>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Testimonial 1 -->
                      <div class="bg-gray-800 p-6 rounded-xl dark:bg-gray-700">
                          <div class="flex text-yellow-400 mb-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                          </div>
                          <p class="text-gray-300 mb-6">
                              "Very Material, Cool Design! The Quality is very satisfactory. I will buy SKINNY Cards for the
                              Credit Card That I have"
                          </p>
                          <div class="flex items-center">
                              <div class="mr-3">
                                  <h4 class="text-white font-medium">Sam Carlos</h4>
                                  <p class="text-gray-400 text-sm">4 hours ago</p>
                              </div>
                          </div>
                      </div>

                      <!-- Testimonial 2 -->
                      <div class="bg-gray-800 p-6 rounded-xl dark:bg-gray-700">
                          <div class="flex text-yellow-400 mb-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                  fill="currentColor">
                                  <path
                                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                          </div>
                          <p class="text-gray-300 mb-6">
                              "Very Satisfied, Cool Design. The material is very durable for my debit card. Will recommend
                              to my friends"
                          </p>
                          <div class="flex items-center">
                              <div class="mr-3">
                                  <h4 class="text-white font-medium">Sam Carlos</h4>
                                  <p class="text-gray-400 text-sm">4 hours ago</p>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- More Testimonial -->
                  <div class="text-gray-400 text-center mt-8">
                      <p>"Nice Material, Cool Design! The Quality is Very Satisfactory. My Cards are UNIQUE to represent My
                          Style!"</p>
                      <p class="mt-3 font-medium">- Nick Material</p>
                  </div>

                  <!-- See All Reviews -->
                  <div class="text-center mt-8">
                      <button
                          class="bg-transparent border border-white text-white px-6 py-2 rounded-full text-sm hover:bg-white hover:text-gray-900 transition duration-300">
                          See All Reviews
                      </button>
                  </div>
              </div>
          </div>

          <!-- Reseller Section -->
          <div class="container mx-auto px-4 md:px-6 py-16 flex flex-col md:flex-row items-center">
              <!-- Left Content -->
              <div class="md:w-1/2 mb-10 md:mb-0">
                  <h2 class="text-2xl md:text-3xl font-bold mb-6">
                      BE OUR RESELLER AND<br>
                      GET MANY BENEFITS
                  </h2>
                  <p class="text-gray-600 mb-8 dark:text-gray-400">
                      By being high quality vinyl, we have several reseller advantages<br>
                      that other competitors do not have.
                  </p>

                  <button
                      class="bg-black text-white px-8 py-3 rounded-full font-medium hover:bg-gray-800 transition duration-300 dark:bg-gray-700">
                      JOIN CREATOR
                  </button>
              </div>

              <!-- Right Image -->
              <div class="md:w-1/2">
                  {{-- <img src="{{ asset('images/creator.gif') }}" alt="Card Skin with Yellow Elements"
                      class="rounded-xl mx-auto"> --}}
                  <div class="mx-auto" id="lottie-3"></div>
              </div>
          </div>

          {{-- <button x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
              @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode); darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
              class="fixed bottom-10 right-10 size-16 p-2 bg-gray-200 dark:bg-gray-800 rounded-full">
              <span x-show="!darkMode" class="material-icons-outlined">light_mode</span>
              <span x-show="darkMode" class="material-icons-outlined">dark_mode</span>
          </button> --}}

          <!-- Add this at the end of your content, just before the closing </div> tag -->
          {{-- @if ($user->isPremium())

          @else --}}
          @if (!optional(Auth::user())->isPremium())
              <div id="subscription-modal"
                  class="fixed inset-x-0 bottom-0 transform translate-y-full transition-transform duration-300 ease-in-out z-50">
                  <div class="bg-white dark:bg-gray-800 rounded-t-2xl shadow-lg p-6 max-w-7xl mx-auto">
                      <!-- Modal Header with Close Button -->
                      <div class="flex justify-between items-center mb-6">
                          <h3 class="text-xl font-bold text-gray-900 dark:text-white">Exclusive Subscription Packages</h3>
                          <button id="close-modal"
                              class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                  stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                              </svg>
                          </button>
                      </div>


                      <!-- Subscription Packages Grid -->
                      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                          <!-- Basic Package -->
                          @guest
                              <div
                                  class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-lg transition duration-300">
                                  <div class="flex justify-between items-start mb-4">
                                      <div>
                                          <h4 class="text-lg font-bold text-gray-900 dark:text-white">Free</h4>
                                          <p class="text-sm text-gray-500 dark:text-gray-400">Features are limited</p>
                                      </div>
                                      <span
                                          class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Popular</span>
                                  </div>
                                  <div class="mb-4">
                                      <span class="text-3xl font-bold text-gray-900 dark:text-white">Rp.0,00</span>
                                      <span class="text-gray-500 dark:text-gray-400">/month</span>
                                  </div>
                                  <ul class="space-y-3 mb-6">
                                      <li class="flex items-center">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                              viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd" />
                                          </svg>
                                          <span class="ml-2 text-gray-600 dark:text-gray-300">10 Downloads/day</span>
                                      </li>
                                      <li class="flex items-center">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                              viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd" />
                                          </svg>
                                          <span class="ml-2 text-gray-600 dark:text-gray-300">Basic asset access</span>
                                      </li>
                                      <li class="flex items-center">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                              viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd" />
                                          </svg>
                                          <span class="ml-2 text-gray-600 dark:text-gray-300">Email support</span>
                                      </li>
                                  </ul>
                                  <a href="{{ route('register') }}">
                                      <button
                                          class="w-full py-2 px-4 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition duration-300">
                                          Get Started
                                      </button>
                                  </a>
                              </div>
                          @endguest


                          @foreach ($plans as $subscription)
                              <div
                                  class="{{ $subscription->id === 1 ? 'border-2 border-purple-500' : 'border border-gray-200 dark:border-gray-700' }} rounded-xl p-6 relative hover:shadow-lg transition duration-300">

                                  {{-- BEST VALUE Badge --}}
                                  @if ($subscription->id === 1)
                                      <div
                                          class="absolute -top-3 right-5 bg-purple-500 text-white text-xs px-3 py-1 rounded-full">
                                          BEST VALUE
                                      </div>
                                  @endif

                                  <div class="flex justify-between items-start mb-4">
                                      <div>
                                          <h4 class="text-lg font-bold text-gray-900 dark:text-white">
                                              {{ $subscription->name }}</h4>
                                          <p class="text-sm text-gray-500 dark:text-gray-400">
                                              {{ $subscription->description }}</p>
                                      </div>
                                  </div>
                                  <div class="mb-4">
                                      <span
                                          class="text-3xl font-bold text-gray-900 dark:text-white">Rp{{ number_format($subscription->price) }}</span>
                                      <span class="text-gray-500 dark:text-gray-400">/month</span>
                                  </div>

                                  {{-- features list --}}
                                  <ul class="space-y-3 mb-6">
                                      @foreach ($subscription->features as $feature)
                                          <li class="flex items-center">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                                  viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd" />
                                              </svg>
                                              <span
                                                  class="ml-2 text-gray-600 dark:text-gray-300">{{ $feature->feature }}</span>
                                          </li>
                                      @endforeach
                                  </ul>

                                  <button
                                      class="w-full py-2 px-4 {{ $subscription->id === 1 ? 'bg-purple-600 hover:bg-purple-700' : 'bg-gray-800 hover:bg-gray-900' }} text-white font-medium rounded-lg transition duration-300">
                                      {{ $subscription->id === 1 ? 'Subscribe Now' : 'Go Pro' }}
                                  </button>
                              </div>
                          @endforeach

                      </div>

                      <div class="text-center text-gray-500 dark:text-gray-400">
                          <p class="text-sm">Limited time offer: Get 20% off any annual subscription with code <span
                                  class="font-semibold">IQUOS2025</span></p>
                      </div>
                  </div>
              </div>
          @endif
          {{-- @endif --}}

          <!-- Add this JavaScript at the end of your content, just before the closing </body> tag -->
          <script>
              document.addEventListener('DOMContentLoaded', function() {
                  // Show modal after a short delay when page loads
                  setTimeout(function() {
                      const modal = document.getElementById('subscription-modal');
                      if (modal) {
                          modal.classList.remove('translate-y-full');
                      }
                  }, 1500); // 1.5 seconds delay

                  // Close modal when clicking close button
                  const closeButton = document.getElementById('close-modal');
                  if (closeButton) {
                      closeButton.addEventListener('click', function() {
                          const modal = document.getElementById('subscription-modal');
                          if (modal) {
                              modal.classList.add('translate-y-full');

                              // Optional: Store in localStorage to prevent showing again in this session
                              localStorage.setItem('subscriptionModalClosed', 'true');
                          }
                      });
                  }

                  // Optional: Check if we should show the modal (if it hasn't been closed previously)
                  // Uncomment this to enable the check
                  /*
                  const hasModalBeenClosed = localStorage.getItem('subscriptionModalClosed') === 'true';
                  if (hasModalBeenClosed) {
                    const modal = document.getElementById('subscription-modal');
                    if (modal) {
                      modal.style.display = 'none';
                    }
                  }
                  */
              });
          </script>

          <script src="https://unpkg.com/lottie-web@5.12.0/build/player/lottie.min.js"></script>

          <script>
              document.addEventListener("DOMContentLoaded", function() {
                  const animations = [{
                          id: 'lottie-1',
                          path: '/lottie/design-animation.json'
                      },
                      {
                          id: 'lottie-2',
                          path: '/lottie/crown-animation.json'
                      },
                      {
                          id: 'lottie-3',
                          path: '/lottie/creator-animation.json'
                      },
                  ];

                  animations.forEach(anim => {
                      lottie.loadAnimation({
                          container: document.getElementById(anim.id),
                          renderer: 'svg',
                          loop: true,
                          autoplay: true,
                          path: anim.path
                      });
                  });
              });
          </script>
      </div>
  @endsection

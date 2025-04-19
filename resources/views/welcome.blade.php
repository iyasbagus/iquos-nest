  @extends('layouts.user')

  @section('usercontent')
      <div class="">
          <!-- Hero Section -->
          <div class="container mx-auto px-4 md:px-6 py-12 flex flex-col md:flex-row items-center justify-between">
              <!-- Left Content -->
              <div class="md:w-1/2 mb-10 md:mb-0">
                  <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                      Discover <span class="gradient-text">
                          Premium<br>
                          Assets
                      </span>
                      For You Next<br>
                      Project
                  </h1>

                  <p class="mt-6 text-gray-600">
                      IQUOS Nest is your go-to platform for high-quality digital assets <br>
                      and a creative community to fuel your <span class="font-semibold"> projects.</span>
                  </p>

                  <div class="mt-8">
                      <button
                          class="bg-black text-white px-8 py-3 rounded-full font-medium hover:bg-gray-800 transition duration-300">
                          EXPLORE NOW
                      </button>
                  </div>

                  <div class="mt-8">
                      <p class="text-sm text-gray-500 mb-2">Join our community</p>
                      <div class="flex -space-x-2">
                          @foreach ($allUser as $item)
                          <img class="object-cover inline-block h-10 w-10 rounded-full ring-2 ring-white"
                          src="{{ $item->profile_picture ?? \App\Helpers\AvatarHelper::generateAvatar($item->name) }}" alt="User avatar">
                          @endforeach
                        </div>
                      <p class="text-xs text-gray-500 mt-2">We're waiting for you</p>
                  </div>
              </div>

              <!-- Right Content - Card Image -->
              <div id="lottie-animation" class="md:w-1/2 relative">
                  <div class="relative">
                      <img src="{{ asset('images/Animation - 1744986729937.gif') }}" alt="Custom Card Skin"
                          class="rounded-2xl mx-auto w-full h-ful">
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
                  <div class="bg-gray-100 p-6 rounded-xl">
                      <div class="bg-black text-white p-2 rounded-lg w-10 h-10 flex items-center justify-center mb-4">
                          <span>1</span>
                      </div>
                      <h3 class="font-bold text-xl mb-2">Premium Assets</h3>
                      <p class="text-gray-600">The best asset you will ever find.</p>
                  </div>

                  <!-- Pack 2 -->
                  <div class="bg-gray-100 p-6 rounded-xl">
                      <div class="bg-black text-white p-2 rounded-lg w-10 h-10 flex items-center justify-center mb-4">
                          <span>2</span>
                      </div>
                      <h3 class="font-bold text-xl mb-2">Best Creator</h3>
                      <p class="text-gray-600">The big advantage of being a creator.</p>
                  </div>
              </div>
          </div>

          <!-- Popular Pro Stocks Section -->
          <div class="bg-gray-900 py-16 px-4 md:px-6">
              <div class="container mx-auto">
                  <h2 class="text-2xl md:text-3xl font-bold text-white mb-8 text-center">POPULER ASSETS DESIGN</h2>
                  <p class="text-gray-400 text-center mb-8 max-w-xl mx-auto">
                      Choose a design according to your preferred category then order as soon as possible.
                  </p>

                  <!-- Search Bar -->
                  <div class="max-w-xl mx-auto mb-8 flex items-center">
                      <div class="flex bg-gray-800 rounded-full overflow-hidden w-full">
                          <button class="bg-gray-800 text-white px-4 py-2 rounded-l-full">All</button>
                          <input type="text" placeholder="Search design"
                              class="bg-gray-800 text-white px-4 py-2 flex-grow focus:outline-none">
                          <button class="bg-gray-800 text-white px-4 py-2 rounded-r-full">
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

                      <div class="bg-gray-800 rounded-xl overflow-hidden">
                        @foreach ($item->getMedia('category') as $image)
                        <img src="{{ $image->getUrl() }}" alt="Hypercritical Face"
                        class="w-full h-48 object-cover">
                        @endforeach
                          <div class="p-4">
                              <h3 class="text-white font-medium text-lg mb-4">{{$item->name}}</h3>
                              <button
                              class="bg-transparent border border-white text-white px-4 py-2 rounded-full text-sm hover:bg-white hover:text-gray-900 transition duration-300">Search Now</button>
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
                  <img src="https://via.placeholder.com/500x300" alt="Card Skin Layers" class="mx-auto">
              </div>

              <!-- Right - Content -->
              <div class="md:w-1/2">
                  <h2 class="text-2xl md:text-3xl font-bold mb-6">
                      AFFORDABLE SUBSCRIPTION PRICES<br>
                      ONLY AT IQUOS NEST.
                  </h2>
                  <p class="text-gray-600 mb-6">
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
                          <a href="{{route('subscription.premium')}}">
                              GET STARTED
                          </a>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Testimonials Section -->
          <div class="bg-gray-900 py-16 px-4 md:px-6">
              <div class="container mx-auto">
                  <h2 class="text-2xl md:text-3xl font-bold text-white mb-12 text-center">
                      SEE WHAT OUR USER<br>
                      ARE SAYING
                  </h2>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Testimonial 1 -->
                      <div class="bg-gray-800 p-6 rounded-xl">
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
                      <div class="bg-gray-800 p-6 rounded-xl">
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
                  <p class="text-gray-600 mb-8">
                      By being high quality vinyl, we have several reseller advantages<br>
                      that other competitors do not have.
                  </p>

                  <button
                      class="bg-black text-white px-8 py-3 rounded-full font-medium hover:bg-gray-800 transition duration-300">
                      ORDER SKIN
                  </button>
              </div>

              <!-- Right Image -->
              <div class="md:w-1/2">
                  <img src="https://via.placeholder.com/500x300" alt="Card Skin with Yellow Elements"
                      class="rounded-xl shadow-lg mx-auto">
              </div>
          </div>

          <!-- Footer -->
          <footer class="bg-gray-900 text-white py-8 px-4 md:px-6">
              <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                  <div class="mb-4 md:mb-0">
                      <h3 class="font-bold text-xl">SKINNY.</h3>
                      <p class="text-sm text-gray-400">Best Card Skin Ever</p>
                  </div>

                  <div class="flex space-x-4">
                      <a href="#" class="text-white hover:text-gray-300">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                              viewBox="0 0 24 24">
                              <path
                                  d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                          </svg>
                      </a>
                      <a href="#" class="text-white hover:text-gray-300">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                              viewBox="0 0 24 24">
                              <path
                                  d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                          </svg>
                      </a>
                      <a href="#" class="text-white hover:text-gray-300">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                              viewBox="0 0 24 24">
                              <path
                                  d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                          </svg>
                      </a>
                  </div>
              </div>
          </footer>

          <button x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
              @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode); darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
              class="fixed bottom-10 right-10 size-16 p-2 bg-gray-200 dark:bg-gray-800 rounded-full">
              <span x-show="!darkMode" class="material-icons-outlined">light_mode</span>
              <span x-show="darkMode" class="material-icons-outlined">dark_mode</span>
          </button>
      </div>
  @endsection

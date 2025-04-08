  @extends('layouts.user')

  @section('usercontent')
      <section class="flex justify-between items-start mt-10 px-14">
          <div class="max-w-lg">
              <h2 class="text-5xl font-bold text-gray-900 leading-tight dark:text-white">
                  Discover the world’s top <span class="bg-purple-400 text-white pl-6 pr-6">designers</span>
              </h2>
          </div>
          <div class="max-w-md text-left">
              <p class="text-gray-600 text-lg dark:text-white">Explore work from the most talented and accomplished designers
                  ready to
                  take on your next project</p>
              <button class="mt-4 px-6 py-2 bg-lime-300 text-gray-900 rounded-xl border border-gray-600 shadow-md">Start
                  Explore →</button>
          </div>
      </section>

      <section class="relative mt-32 px-8">
          <div class="max-w-2xl mx-auto bg-purple-300 pt-32 pb-9 px-10 relative">
              <div class="flex items-center bg-white rounded-full px-4 py-2 shadow-md">
                  <input type="text" placeholder="Search More Inspirations..."
                      class="w-full rounded-full border-gray-200 bg-gray-100 p-4 pe-32 text-sm font-medium dark:text-white">
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

      <section class="bg-white mt-10 py-12 overflow-hidden dark:bg-gray-900" x-data="marqueeSlider()">
          <div class="max-w-6xl mx-auto text-center">
              <h2 class="text-2xl dark:text-white md:text-4xl font-semibold text-gray-800">
                  Trusted By More Than <span class="text-purple-600 font-bold">+10,000</span> Users
              </h2>

              <div class="relative mt-10 overflow-hidden" x-on:mouseenter="pause()" x-on:mouseleave="play()">

                  <div class="flex w-max space-x-6" x-ref="slider" :style="`transform: translateX(${offset}px)`">
                      <!-- Duplikat logo supaya loop-nya mulus -->
                      <template x-for="i in 2" :key="i">
                          <div class="flex space-x-6">
                              <template x-for="logo in logos" :key="logo.alt">
                                  <div class="bg-gray-50 px-6 py-3 rounded-full shadow-sm flex items-center dark:bg-gray-800">
                                      <img :src="logo.src" :alt="logo.alt" class="h-6" />
                                  </div>
                              </template>
                          </div>
                      </template>
                  </div>
              </div>
          </div>
      </section>

      <button x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
          @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode); darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
          class="fixed bottom-10 right-10 size-16 p-2 bg-gray-200 dark:bg-gray-800 rounded-full">
          <span x-show="!darkMode" class="material-icons-outlined">light_mode</span>
          <span x-show="darkMode" class="material-icons-outlined">dark_mode</span>
      </button>

      <script>
          function marqueeSlider() {
              return {
                  offset: 0,
                  speed: 1, // pixel per frame
                  interval: null,
                  logos: [{
                          src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png',
                          alt: 'Paypal'
                      },
                      {
                          src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/2560px-Logo_dana_blue.svg.png',
                          alt: 'Dana'
                      },
                      {
                          src: 'https://static.tildacdn.com/tild3738-6566-4035-a638-383534643665/Logo_ovo_purplesvg.png',
                          alt: 'Ovo'
                      },
                      {
                          src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1280px-Bank_Central_Asia.svg.png',
                          alt: 'BCA'
                      },
                      {
                          src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png',
                          alt: 'Mandiri'
                      },
                      {
                          src: 'https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_BRI.png',
                          alt: 'bri'
                      },
                      {
                          src: 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png',
                          alt: 'Bni'
                      }
                  ],
                  play() {
                      if (this.interval) return
                      this.interval = setInterval(() => {
                          this.offset -= this.speed
                          const slider = this.$refs.slider
                          const totalWidth = slider.scrollWidth / 2
                          if (Math.abs(this.offset) >= totalWidth) {
                              this.offset = 0
                          }
                      }, 16) // ~60 FPS
                  },
                  pause() {
                      clearInterval(this.interval)
                      this.interval = null
                  },
                  init() {
                      this.play()
                  }
              }
          }
      </script>
  @endsection

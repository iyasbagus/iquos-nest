@extends('layouts.user')

@section('usercontent')
    <div class="pt-32 bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Premium Subscriptions
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Unlock premium assets and enhance your creative projects with our subscription plans
            </p>
        </div>

        <!-- Plans Section -->
        <div class="flex flex-wrap justify-center gap-8 mt-10">
            @foreach ($plans as $item)
                <div class="w-96 max-w-md transform transition-all duration-300 hover:scale-105">
                    <div class="h-full rounded-2xl bg-white shadow-xl overflow-hidden border-t-4 border-indigo-600">
                        <!-- Plan Header -->
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                            <h3 class="text-2xl font-bold text-white">{{ $item->name }}</h3>
                            <div class="mt-4 flex justify-center">
                                <span class="text-5xl font-bold text-white">Rp{{ number_format($item->price) }}</span>
                            </div>
                            <p class="mt-1 text-indigo-100">/month</p>
                        </div>

                        <!-- Plan Features -->
                        <div class="px-6 py-8">
                            <ul class="space-y-4">
                                @foreach ($item->features as $feature)
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-base text-gray-700">{{ $feature->feature }}</p>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- CTA Button -->
                            <div class="mt-8">
                                <a href="{{route('subscription.checkout', ['plan' => $item->id])}}"
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out transform hover:scale-105">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Creator') }}
        </h2>
    </x-slot>

    <!-- Card untuk jumlah download -->
    <div class="flex gap-4">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Downloads</h3>
                <span class="bg-blue-100 ml-4 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">All
                    Times</span>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $user->totalDownloads() }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 flex items-center text-sm font-medium">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            12.5% dari bulan lalu
                        </span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Assets</h3>
                <span class="bg-blue-100 ml-4 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">This
                    Month</span>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $assetsMonth }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-indigo-500 flex items-center text-sm font-medium">
                            Today Assets : {{ $assetsToday }}
                        </span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-500 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01" />
                    </svg>

                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Income</h3>
                <span class="bg-blue-100 ml-4 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">This
                    Month</span>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold text-gray-900">Rp{{ number_format($totalEarning, 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-indigo-500 flex items-center text-sm font-medium">
                            Today Assets : {{ $assetsToday }}
                        </span>
                    </div>
                </div>
                <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-indigo-400 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M2 7c0-1.10457.89543-2 2-2h16c1.1046 0 2 .89543 2 2v4c0 .5523-.4477 1-1 1s-1-.4477-1-1v-1H4v7h10c.5523 0 1 .4477 1 1s-.4477 1-1 1H4c-1.10457 0-2-.8954-2-2V7Z" />
                        <path fill="currentColor"
                            d="M5 14c0-.5523.44772-1 1-1h2c.55228 0 1 .4477 1 1s-.44772 1-1 1H6c-.55228 0-1-.4477-1-1Zm5 0c0-.5523.4477-1 1-1h4c.5523 0 1 .4477 1 1s-.4477 1-1 1h-4c-.5523 0-1-.4477-1-1Zm9-1c.5523 0 1 .4477 1 1v1h1c.5523 0 1 .4477 1 1s-.4477 1-1 1h-1v1c0 .5523-.4477 1-1 1s-1-.4477-1-1v-1h-1c-.5523 0-1-.4477-1-1s.4477-1 1-1h1v-1c0-.5523.4477-1 1-1Z" />
                    </svg>


                </div>
            </div>
        </div>
    </div>


    <!-- Card untuk statistik user premium (dengan ChartJS) -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Premium Subscribers</h3>
            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Monthly
                Trend</span>
        </div>

        <div>
            <p class="text-3xl font-bold text-gray-900">487</p>
            <div class="flex items-center mt-1 mb-4">
                <span class="text-green-500 flex items-center text-sm font-medium">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    8.2% peningkatan
                </span>
            </div>

            <div class="h-64">
                <canvas id="premiumSubscribersChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Card untuk statistik lainnya - dengan Donut Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Subscription Plans Distribution</h3>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Current</span>
        </div>

        <div class="flex flex-col md:flex-row items-center md:space-x-10">
            <div class="w-48 h-48">
                <canvas id="subscriptionDonutChart"></canvas>
            </div>

            <div class="flex flex-col space-y-4 mt-4 md:mt-0">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Basic - 45%</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-purple-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Standard - 32%</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Premium - 18%</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Enterprise - 5%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 mx-auto">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Asset Downloads by Category</h2>
        <div class="relative h-64 w-full">
            <canvas id="downloadStatsChart"></canvas>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Premium Subscribers Line Chart
            const premiumData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'New Premium Users',
                    data: [125, 253, 189, 287, 321, 343, 298, 342, 389, 425, 459, 487],
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            };

            const premiumConfig = {
                type: 'line',
                data: premiumData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                            },
                        },
                        x: {
                            grid: {
                                display: false,
                            }
                        }
                    }
                }
            };

            // Revenue Area Chart
            const revenueData = {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Revenue (in millions Rp)',
                    data: [25.4, 29.7, 32.1, 28.9, 35.6, 18.2, 17.6],
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            };

            const revenueConfig = {
                type: 'line',
                data: revenueData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' jt';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            };

            // Subscription Donut Chart
            const subscriptionData = {
                labels: ['Basic', 'Standard', 'Premium', 'Enterprise'],
                datasets: [{
                    data: [45, 32, 18, 5],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(16, 185, 129, 0.8)'
                    ],
                    borderWidth: 0,
                    hoverOffset: 5
                }]
            };

            const donutConfig = {
                type: 'doughnut',
                data: subscriptionData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            };

            // Render all charts
            new Chart(
                document.getElementById('premiumSubscribersChart'),
                premiumConfig
            );

            new Chart(
                document.getElementById('revenueChart'),
                revenueConfig
            );

            new Chart(
                document.getElementById('subscriptionDonutChart'),
                donutConfig
            );
        });
    </script>
</x-app-layout>

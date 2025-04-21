<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="stats shadow bg-white">
        <div class="stat">
            <div class="stat-figure text-primary">
                <span class="material-icons-outlined">category</span>
            </div>
            <div class="stat-title text-gray-700">Creator Application</div>
            <div class="stat-value text-gray-700">{{ $applicationTotal }}</div>
            <div class="stat-desc text-gray-700">↗︎ {{ $applicationTotalToday }} Application Today</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-primary">
                <span class="material-icons-outlined">web_asset</span>
            </div>
            <div class="stat-title text-gray-700">Asset Total</div>
            <div class="stat-value text-gray-700">{{ $assetTotalActive }}</div>
            <div class="stat-desc text-gray-700">↗︎ {{ $assetToday }} Assets Today</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-primary">
                <span class="material-icons-outlined">account_circle</span>
            </div>
            <div class="stat-title text-gray-700">User Total</div>
            <div class="stat-value text-gray-700">{{ $userTotal }}</div>
            <div class="stat-desc text-gray-700">↗︎ {{ $userTodayRegister }} Register Today</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-primary">
                <span class="material-icons-outlined">creadit</span>
            </div>
            <div class="stat-title text-gray-700">Total Revenue</div>
            <div class="stat-value text-gray-700">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Card untuk Revenue / Pendapatan -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 mt-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Revenue</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-md">Weekly</button>
                <button class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-md">Monthly</button>
                <button class="px-3 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-md">Yearly</button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div>
                <p class="text-3xl font-bold text-gray-900">Rp 187,542,000</p>
                <div class="flex items-center mt-2">
                    <span class="text-indigo-500 flex items-center text-sm font-medium">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        18.7% peningkatan
                    </span>
                </div>
            </div>
            <div class="w-16 h-16 bg-indigo-50 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="mt-6">
            <canvas id="revenueChart" height="200"></canvas>
        </div>
    </div>

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

            // User Activity Bar Chart
            const activityData = {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                        label: 'Mobile',
                        data: [1243, 1420, 1358, 1297, 1562, 1945, 1730],
                        backgroundColor: 'rgba(139, 92, 246, 0.8)',
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    },
                    {
                        label: 'Desktop',
                        data: [743, 820, 758, 697, 662, 545, 430],
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    },
                    {
                        label: 'Tablet',
                        data: [143, 120, 158, 197, 162, 245, 230],
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    }
                ]
            };

            const activityConfig = {
                type: 'bar',
                data: activityData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
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
                document.getElementById('userActivityChart'),
                activityConfig
            );

            new Chart(
                document.getElementById('subscriptionDonutChart'),
                donutConfig
            );
        });
    </script>
</x-app-layout>

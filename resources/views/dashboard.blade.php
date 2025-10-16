@extends('layouts.app')

@section('content')
    <div
        class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-xl shadow-lg p-8 mb-8 relative overflow-hidden m-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h2 class="font-extrabold text-4xl text-white drop-shadow-lg leading-tight flex items-center gap-2">
                    <svg class="w-9 h-9 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3zm0 2c-2.67 0-8 1.337-8 4v2a1 1 0 001 1h14a1 1 0 001-1v-2c0-2.663-5.33-4-8-4z" />
                    </svg>
                    Dashboard
                </h2>
                <p class="text-white text-opacity-90 text-base mt-2 font-medium">
                    Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>
                </p>
            </div>
            <div class="mt-6 md:mt-0 text-right">
                <div class="inline-block bg-white bg-opacity-20 rounded-lg px-6 py-3 shadow-md">
                    <p class="text-white text-lg font-semibold tracking-wide">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                    <p id="current-time" class="text-white text-opacity-80 text-sm mt-1 font-mono">
                        {{ now()->format('H:i:s') }} WIB
                    </p>
                </div>
            </div>
        </div>
        <div class="absolute right-0 bottom-0 opacity-20 pointer-events-none">
            <svg width="180" height="100" fill="none" viewBox="0 0 180 100">
                <ellipse cx="140" cy="80" rx="80" ry="30" fill="#fff" />
            </svg>
        </div>
    </div>


    {{-- <div class="py-12 min-h-screen bg-gray-50 mt-8"></div> --}}
    <div>
        <div class="w-full">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Stats Cards Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Hari Ini -->
                        <div
                            class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-blue-500 hover:border-blue-600 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Tamu Hari Ini</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayCount }}</p>
                                    <p class="text-gray-400 text-xs mt-2">Hingga saat ini</p>
                                </div>
                                <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-full p-4">
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Bulan Ini -->
                        <div
                            class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-green-500 hover:border-green-600 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Tamu Bulan Ini</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $thisMonthCount }}</p>
                                    <p class="text-green-600 text-xs mt-2">
                                        @if ($growthRate > 0)
                                            <span class="inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414-1.414L13.586 7H12z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $growthRate }}%
                                            </span>
                                        @elseif($growthRate < 0)
                                            <span class="inline-flex items-center text-red-600">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12 13a1 1 0 110 2H7a1 1 0 01-1-1V9a1 1 0 112 0v3.586l4.293-4.293a1 1 0 011.414 1.414L9.414 13H12z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ abs($growthRate) }}%
                                            </span>
                                        @else
                                            Stabil
                                        @endif
                                    </p>
                                </div>
                                <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-full p-4">
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Tamu -->
                        <div
                            class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-purple-500 hover:border-purple-600 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Tamu</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalGuests }}</p>
                                    <p class="text-gray-400 text-xs mt-2">Semua periode</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-100 to-purple-200 rounded-full p-4">
                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zM5 20h14a2 2 0 002-2v-2a3 3 0 00-5.356-1.857M9 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Rata-rata Harian -->
                        <div
                            class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-orange-500 hover:border-orange-600 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Rata-rata Harian</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">
                                        @php
                                            $avgDaily =
                                                $thisMonthCount > 0 ? round($thisMonthCount / now()->day, 1) : 0;
                                        @endphp
                                        {{ $avgDaily }}
                                    </p>
                                    <p class="text-gray-400 text-xs mt-2">Bulan ini</p>
                                </div>
                                <div class="bg-gradient-to-br from-orange-100 to-orange-200 rounded-full p-4">
                                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Row -->


                    <!-- Charts Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Grafik 7 Hari -->
                        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Kunjungan 7 Hari Terakhir</h3>
                            <div class="relative h-72">
                                <canvas id="sevenDaysChart"></canvas>
                            </div>
                        </div>

                        <!-- Keperluan Terbanyak -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Keperluan Terbanyak</h3>
                            <div class="space-y-3">
                                @forelse($topReasons as $reason)
                                    <div class="flex items-center">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700 truncate">
                                                {{ $reason->keperluan }}
                                            </p>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                                <div class="bg-blue-500 h-2 rounded-full"
                                                    style="width: {{ ($reason->total / $topReasons->first()->total) * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900 ml-2">{{ $reason->total }}</span>
                                    </div>
                                @empty
                                    <p class="text-gray-400 text-sm">Tidak ada data</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Instansi & Recent Guests Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Top Instansi -->
                        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Instansi Terbanyak Berkunjung</h3>
                            <div class="relative h-64">
                                <canvas id="institutionsChart"></canvas>
                            </div>
                        </div>

                        <!-- Tamu Terbaru -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Kunjungan Terbaru</h3>
                            <div class="space-y-3 max-h-80 overflow-y-auto">
                                @forelse($todayGuests as $guest)
                                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                        <p class="text-sm font-semibold text-gray-900">{{ $guest->nama }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $guest->instansi ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $guest->created_at->format('H:i') }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-400 text-sm">Tidak ada kunjungan hari ini</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Chart.js Library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            // Data dari Laravel
            const sevenDaysData = {!! json_encode($sevenDaysData) !!};
            const topReasonsData = {!! json_encode($topReasons) !!};
            const topInstitutionsData = {!! json_encode($topInstitutions) !!};

            // Chart Colors
            const colors = {
                primary: 'rgb(59, 130, 246)',
                success: 'rgb(34, 197, 94)',
                warning: 'rgb(251, 146, 60)',
                danger: 'rgb(239, 68, 68)',
                info: 'rgb(168, 85, 247)',
            };

            // ===== 7 Days Chart =====
            const sevenDaysCtx = document.getElementById('sevenDaysChart').getContext('2d');
            new Chart(sevenDaysCtx, {
                type: 'line',
                data: {
                    labels: sevenDaysData.map(d => d.date),
                    datasets: [{
                        label: 'Kunjungan',
                        data: sevenDaysData.map(d => d.count),
                        borderColor: colors.primary,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: colors.primary,
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                            }
                        }
                    }
                }
            });

            // ===== Institutions Chart =====
            const institutionsCtx = document.getElementById('institutionsChart').getContext('2d');
            new Chart(institutionsCtx, {
                type: 'bar',
                data: {
                    labels: topInstitutionsData.map(i => i.instansi || 'N/A'),
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: topInstitutionsData.map(i => i.total),
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(251, 146, 60, 0.8)',
                            'rgba(168, 85, 247, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(14, 165, 233, 0.8)',
                        ],
                        borderColor: [
                            colors.primary,
                            colors.success,
                            colors.warning,
                            colors.info,
                            'rgb(236, 72, 153)',
                            'rgb(14, 165, 233)',
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                            }
                        }
                    }
                }
            });
        </script>

        <script>
            // Update waktu realtime setiap detik
            function updateTime() {
                const now = new Date();
                const jakartaTime = new Date(now.toLocaleString("en-US", {
                    timeZone: "Asia/Jakarta"
                }));
                const hours = jakartaTime.getHours().toString().padStart(2, '0');
                const minutes = jakartaTime.getMinutes().toString().padStart(2, '0');
                const seconds = jakartaTime.getSeconds().toString().padStart(2, '0');
                const timeString = `${hours}:${minutes}:${seconds} WIB`;
                document.getElementById('current-time').textContent = timeString;
            }

            // Update setiap detik
            setInterval(updateTime, 1000);

            // Update pertama kali
            updateTime();
        </script>
    @endsection

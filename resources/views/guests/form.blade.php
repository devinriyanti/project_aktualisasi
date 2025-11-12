@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="text-align: center;">
                    <h2 class="text-2xl font-bold text-gray-900">Portal Buku Tamu</h2>
                    <p class="mt-2 text-gray-600">Jumlah tamu hari ini: <span class="font-semibold">{{ $todayCount }}</span>
                    </p>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('guests.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="nama" name="nama" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" id="no_telepon" name="no_telepon" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="mt-1 text-sm text-green-600 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.053.514 4.006 1.471 5.744L0 24l6.403-1.455A11.95 11.95 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm6.207 17.006c-.259.731-1.487 1.38-2.061 1.472-.545.086-1.24.123-2.011-.126-.463-.147-1.059-.345-1.826-.676-3.203-1.392-5.295-4.635-5.459-4.86-.163-.226-1.304-1.735-1.304-3.311 0-1.576.826-2.35 1.12-2.67.294-.321.642-.401.857-.401h.61c.197.008.46-.074.72.55.259.624.877 2.157.955 2.314.078.156.13.34.024.545-.104.205-.156.34-.31.525-.155.186-.326.416-.464.558-.155.155-.316.325-.136.636.18.311.796 1.31 1.707 2.123 1.174 1.046 2.167 1.377 2.478 1.532.31.155.495.13.68-.078.186-.208.78-.911.99-1.223.21-.311.42-.259.72-.155.3.104 1.91.9 2.235 1.062.326.163.544.241.624.377.078.137.078.787-.18 1.519z"/>
                                    </svg>
                                    Diharapkan Terhubung oleh WhatsApp
                            </p>
                        </div>

                        <div class="mb-4">
                            <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                            <input type="text" id="instansi" name="instansi"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                            <select id="keperluan" name="keperluan" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Pilih --</option>
                                <option>Layanan Administrasi Hukum Umum</option>
                                <option>Layanan Kekayaan Intelektual</option>
                                <option>Layanan Pengaduan</option>

                                <option>Layanan Harmonisasi Ranperda/Ranperkada</option>
                                <option>Layanan Konsultasi Hukum</option>
                                <option>JDIH</option>
                                <option>Lain-lain</option>



                                
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="4"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>

                        @if(request()->is_with_date == "true")
                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-700">Custom Tanggal Waktu</label>
                                <input type="datetime-local" id="date" name="date"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        @endif
                        

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-biru-tua border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kirim
                            </button>
                        </div>
                    </form>

                    {{-- Img --}}
                    <br>
                    <div class="py-5 mt-5">
                        <img src="{{ asset('brand/barcode.png') }}" class=" img-fluid rounded" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

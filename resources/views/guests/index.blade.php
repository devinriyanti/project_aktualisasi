@extends('layouts.app')

@section('content')
    <style>
        /* Custom DataTable Styling - Modern & Clean */
        .dataTables_wrapper {
            padding: 0 !important;
        }

        .dataTables_length,
        .dataTables_filter,
        .dataTables_info,
        .dataTables_paginate {
            padding: 12px 16px;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .dataTables_filter label,
        .dataTables_length label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        /* Layout DataTable controls */
        .dataTables_wrapper .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .dataTables_wrapper .bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            padding: 12px 16px;
            border-top: 1px solid #e5e7eb;
        }

        .dataTables_filter input,
        .dataTables_length select {
            padding: 6px 8px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            outline: none;
            border-color: #9ca3af;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }

        /* Table Styling */
        #guests-table {
            border-collapse: collapse;
            width: 100%;
        }

        #guests-table thead th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            vertical-align: middle;
            user-select: none;
            cursor: pointer;
        }

        #guests-table thead th:hover {
            background-color: #f3f4f6;
        }

        /* Sorting icons */
        .sorting:before,
        .sorting:after,
        .sorting_asc:before,
        .sorting_asc:after,
        .sorting_desc:before,
        .sorting_desc:after {
            content: '';
            display: none;
        }

        .sorting::after,
        .sorting_asc::after,
        .sorting_desc::after {
            content: '';
            display: inline-block;
            margin-left: 6px;
            opacity: 0.5;
        }

        .sorting::after {
            content: '⇅';
        }

        .sorting_asc::after {
            content: '↑';
            opacity: 1;
        }

        .sorting_desc::after {
            content: '↓';
            opacity: 1;
        }

        #guests-table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #111827;
            font-size: 0.875rem;
        }

        #guests-table tbody tr {
            transition: background-color 0.15s;
        }

        #guests-table tbody tr:hover {
            background-color: #f9fafb;
        }

        #guests-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Pagination */
        .dataTables_paginate {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .paginate_button {
            padding: 6px 10px;
            margin: 0 2px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            background: white;
            color: #374151;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .paginate_button:hover:not(.disabled) {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .paginate_button.current {
            background-color: #374151;
            color: white;
            border-color: #374151;
            font-weight: 600;
        }

        .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Info text */
        .dataTables_info {
            text-align: left;
            border-top: 1px solid #e5e7eb;
        }

        /* Processing message */
        .dataTables_processing {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .dataTables_wrapper .top,
            .dataTables_wrapper .bottom {
                flex-direction: column;
                align-items: stretch;
            }

            .dataTables_length,
            .dataTables_filter {
                display: block;
                padding: 8px 12px;
            }

            .dataTables_filter label,
            .dataTables_length label {
                flex-direction: column;
                align-items: flex-start;
            }

            .dataTables_filter input,
            .dataTables_length select {
                width: 100%;
            }

            #guests-table tbody td {
                padding: 10px 12px;
            }

            #guests-table thead th {
                padding: 10px 12px;
                font-size: 0.8125rem;
            }

            .dataTables_paginate {
                justify-content: center;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Data Buku Tamu</h2>
                </div>

                <div class="p-6">
                    <!-- Filter Form -->
                    <form class="flex flex-wrap gap-4 mb-6" method="GET">
                        <div class="flex-1 min-w-0">
                            <label for="from" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                            <input type="date" id="from" name="from" value="{{ request('from') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <label for="to" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                            <input type="date" id="to" name="to" value="{{ request('to') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                            <select id="keperluan" name="keperluan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Semua Keperluan</option>
                                <option>Layanan Administrasi Hukum Umum</option>
                                <option>Layanan Kekayaan Intelektual</option>
                                <option>Layanan Pengaduan</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Filter
                            </button>
                            <a href="{{ route('guests.export.pdf', request()->query()) }}"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Export PDF
                            </a>
                            <a href="{{ route('guests.export.excel', request()->query()) }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Export Excel
                            </a>
                        </div>
                    </form>

                    <!-- Table -->
                    <div style="overflow: auto;">
                        <table id="guests-table" class="w-full">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>No. Telepon</th>
                                    <th>Instansi</th>
                                    <th>Keperluan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $guest)
                                    <tr>
                                        <td>{{ $guest->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $guest->nama }}</td>
                                        <td>{{ $guest->no_telepon }}</td>
                                        <td>{{ $guest->instansi }}</td>
                                        <td>{{ $guest->keperluan }}</td>
                                        <td>{{ $guest->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery dan DataTable JS -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#guests-table').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "dom": "<'dataTables_wrapper'<'top'lf>rt<'bottom'ip<'clear'>>>"
            });
        });
    </script>
@endsection

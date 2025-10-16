<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #111;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #666;
        }

        .filter-info {
            margin-bottom: 20px;
            font-size: 11px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #374151;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        table tbody tr:hover {
            background-color: #f3f4f6;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .summary {
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 4px;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Data Buku Tamu</h1>
        <p>Laporan Data Tamu Pengunjung</p>
    </div>

    <div class="filter-info">
        <strong>Tanggal Laporan:</strong> {{ now()->format('d F Y H:i') }}<br>
        <strong>Total Data:</strong> {{ count($guests) }} entri
    </div>

    @if (count($guests) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 15%;">Nama</th>
                    <th style="width: 12%;">No. Telepon</th>
                    <th style="width: 18%;">Instansi</th>
                    <th style="width: 18%;">Keperluan</th>
                    <th style="width: 25%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr>
                        <td>{{ $guest->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $guest->nama }}</td>
                        <td>{{ $guest->no_telepon }}</td>
                        <td>{{ $guest->instansi }}</td>
                        <td>{{ $guest->keperluan }}</td>
                        <td>{{ $guest->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <strong>Catatan:</strong> Laporan ini berisi data tamu yang sesuai dengan filter yang diterapkan.
            Dokumentasi ini dicetak pada {{ now()->format('d F Y pukul H:i') }}.
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #999;">
            <p>Tidak ada data tamu untuk ditampilkan.</p>
        </div>
    @endif

    <div class="footer">
        <p>© {{ date('Y') }} - Sistem Buku Tamu Digital</p>
    </div>
</body>

</html>

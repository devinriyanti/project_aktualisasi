<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buku Tamu</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size:12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <h3 style="text-align: center">Laporan Buku Tamu</h3>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Tanggal</th><th>Nama</th><th>No. Telepon</th>
                <th>Instansi</th><th>Keperluan</th><th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $i => $g)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $g->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $g->nama }}</td>
                <td>{{ $g->no_telepon }}</td>
                <td>{{ $g->instansi }}</td>
                <td>{{ $g->keperluan }}</td>
                <td>{{ $g->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

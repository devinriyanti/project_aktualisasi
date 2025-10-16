@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Buku Tamu</h3>

    <form class="row g-2 mb-3" method="GET">
        <div class="col"><input type="date" name="from" class="form-control" value="{{ request('from') }}"></div>
        <div class="col"><input type="date" name="to" class="form-control" value="{{ request('to') }}"></div>
        <div class="col">
            <select name="keperluan" class="form-control">
                <option value="">Semua Keperluan</option>
                <option>Layanan Administrasi Hukum Umum</option>
                <option>Layanan Kekayaan Intelektual</option>
                <option>Layanan Pengaduan</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary">Filter</button>
            <a href="{{ route('guests.export', request()->query()) }}" class="btn btn-success">Export PDF</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th><th>Nama</th><th>No. Telepon</th>
                <th>Instansi</th><th>Keperluan</th><th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
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
@endsection

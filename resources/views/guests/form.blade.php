@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Buku Tamu Digital</h3>
    <p>Jumlah tamu hari ini: <strong>{{ $todayCount }}</strong></p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('guests.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" required class="form-control">
        </div>
        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="no_telepon" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Instansi</label>
            <input type="text" name="instansi" class="form-control">
        </div>
        <div class="mb-3">
            <label>Keperluan</label>
            <select name="keperluan" required class="form-control">
                <option value="">-- Pilih --</option>
                <option>Layanan Administrasi Hukum Umum</option>
                <option>Layanan Kekayaan Intelektual</option>
                <option>Layanan Pengaduan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection

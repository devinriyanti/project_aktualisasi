<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah tipe kolom enum ke versi baru
        DB::statement("ALTER TABLE guests MODIFY keperluan ENUM(
            'Layanan Administrasi Hukum Umum',
            'Layanan Kekayaan Intelektual',
            'Layanan Pengaduan',
            'Layanan Harmonisasi Ranperda/Ranperkada',
            'Layanan Konsultasi Hukum',
            'JDIH',
            'Lain-lain'
        ) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke versi lama
        DB::statement("ALTER TABLE guests MODIFY keperluan ENUM(
            'Layanan Administrasi Hukum Umum',
            'Layanan Kekayaan Intelektual',
            'Layanan Pengaduan'
        ) NOT NULL");
    }
};

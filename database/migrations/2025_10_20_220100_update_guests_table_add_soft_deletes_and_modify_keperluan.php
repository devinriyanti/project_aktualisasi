<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // Ubah kolom enum ke string agar lebih fleksibel
            $table->string('keperluan')->change();

            // Tambahkan soft deletes (kolom deleted_at)
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // Balik ke enum seperti semula jika di-rollback
            $table->enum('keperluan', [
                'Layanan Administrasi Hukum Umum',
                'Layanan Kekayaan Intelektual',
                'Layanan Pengaduan',
                'Layanan Harmonisasi Ranperda/Ranperkada',
                'Layanan Konsultasi Hukum',
                'JDIH',
                'Lain-lain'
            ])->change();

            // Hapus kolom deleted_at
            $table->dropSoftDeletes();
        });
    }
};

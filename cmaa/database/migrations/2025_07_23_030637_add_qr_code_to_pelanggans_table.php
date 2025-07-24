<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambahkan kolom qr_code ke tabel pelanggans.
     */
    public function up(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->string('qr_code')->nullable()->after('kartu_id'); // Menyimpan nama file QR code
        });
    }

    /**
     * Kembalikan migrasi (rollback) dengan menghapus kolom qr_code.
     */
    public function down(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->dropColumn('qr_code');
        });
    }
};

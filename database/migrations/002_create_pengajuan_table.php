<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();

            // relasi ke users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // data pengajuan
            $table->string('asal_instansi');
            $table->string('jurusan');
            $table->string('no_hp');
            $table->string('surat_pengantar');

            // status verifikasi
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])
                  ->default('menunggu');

            // catatan admin
            $table->text('catatan_admin')->nullable();

            // otomatis tanggal pengajuan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
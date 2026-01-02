<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peserta_pengajuan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuan')
                  ->cascadeOnDelete();

            $table->string('nama_pengaju');
            $table->string('jurusan');
            $table->string('no_hp', 20);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_pengajuan');
    }
};
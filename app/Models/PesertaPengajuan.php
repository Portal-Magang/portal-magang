<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaPengajuan extends Model
{
    use HasFactory;

    protected $table = 'peserta_pengajuan';

    protected $fillable = [
        'pengajuan_id',
        'nama_pengaju',
        'jurusan',
        'no_hp',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
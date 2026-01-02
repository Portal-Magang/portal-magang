<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'user_id',
        'jenis_pengajuan',
        'asal_instansi',
        'surat_pengantar',
        'status',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peserta()
    {
        return $this->hasMany(PesertaPengajuan::class, 'pengajuan_id');
    }
}
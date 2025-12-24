<?php

namespace App\Mail;

use App\Models\Pengajuan;
use Illuminate\Mail\Mailable;

class StatusPengajuanMail extends Mailable
{
    public Pengajuan $pengajuan;

    public function __construct(Pengajuan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    public function build()
    {
        return $this
            ->subject('Status Pengajuan PKL/Magang')
            ->view('emails.status_pengajuan');
    }
}
<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\NotifMember;

class NotifikasiMember{

    public static function permohonan($per,$msg)
    {
        $notif = new NotifMember;
        $notif->jenis = 'permohonan';
        $notif->notif_id = $per->id;
        $notif->pendaftar = $per->getPendaftar->id;
        $notif->pesan = $msg;
        $notif->save();
    }

    public static function pengaduan($per,$msg)
    {
        $notif = new NotifMember;
        $notif->jenis = 'pengaduan';
        $notif->notif_id = $per->id;
        $notif->pendaftar = $per->getPendaftar->id;
        $notif->pesan = $msg;
        $notif->save();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifMember extends Model
{
    protected $table = "notif_member";

    public function getPendaftar()
    {
        return $this->belongsTo('App\Models\Pendaftar', 'pendaftar', 'id');
    } 

    public function getPermohonan()
    {
        return $this->belongsTo('App\Models\Permohonan', 'notif_id', 'id');
    }

    public function getPencabutan()
    {
        return $this->belongsTo('App\Models\Permohonan', 'notif_id', 'id');
    }
}
